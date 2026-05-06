<?php

namespace App\Http\Controllers;

use App\Mail\CampaignBroadcastMail;
use App\Jobs\SendCampaignEmailJob;
use App\Models\CampaignSendLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class MailController extends Controller
{
    public function __invoke(Request $request): View
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $filters = [
            'search' => trim((string) $request->string('search')),
            'account_status' => $request->string('account_status')->toString(),
            'payment_status' => $request->string('payment_status')->toString(),
            'approval' => $request->string('approval')->toString(),
            'verified' => $request->string('verified')->toString(),
        ];

        $users = User::query()
            ->when($filters['search'] !== '', function ($query) use ($filters) {
                $search = $filters['search'];
                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('company_name', 'like', "%{$search}%");
                });
            })
            ->when($filters['account_status'] !== '', fn ($query) => $query->where('account_status', $filters['account_status']))
            ->when($filters['payment_status'] !== '', fn ($query) => $query->where('payment_status', $filters['payment_status']))
            ->when($filters['approval'] === 'approved', fn ($query) => $query->where('is_approved', true))
            ->when($filters['approval'] === 'pending', fn ($query) => $query->where('is_approved', false))
            ->when($filters['verified'] === 'verified', fn ($query) => $query->whereNotNull('email_verified_at'))
            ->when($filters['verified'] === 'unverified', fn ($query) => $query->whereNull('email_verified_at'))
            ->orderBy('name')
            ->get();

        $validEmails = $users->map(function (User $user) {
            return (object) [
                'name' => $user->name,
                'emails' => $this->extractValidEmails($user->email),
                'phone' => $user->phone,
                'account_status' => $user->account_status,
                'payment_status' => $user->payment_status,
                'is_approved' => (bool) $user->is_approved,
                'is_verified' => $user->email_verified_at !== null,
            ];
        })->filter(fn (object $item) => $item->emails->isNotEmpty())->values();

        return view('admin.maillist.index', [
            'validEmails' => $validEmails,
            'filters' => $filters,
            'campaignLogs' => CampaignSendLog::query()->with('sender')->latest('sent_at')->latest()->limit(20)->get(),
            'stats' => [
                'users_considered' => $users->count(),
                'reachable_contacts' => $validEmails->count(),
                'total_addresses' => $validEmails->sum(fn (object $item) => $item->emails->count()),
            ],
        ]);
    }

    public function send(Request $request): RedirectResponse
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $validated = $request->validate([
            'emails' => ['required', 'array', 'min:1'],
            'emails.*' => ['required', 'email'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required_without:message_html', 'nullable', 'string', 'max:50000'],
            'message_html' => ['required_without:message', 'nullable', 'string', 'max:200000'],
            'preview_email' => ['nullable', 'email'],
            'send_mode' => ['nullable', 'in:test,live'],
            'campaign_images' => ['nullable', 'array'],
            'campaign_images.*' => ['image', 'max:4096'],
        ]);

        $uniqueRecipients = collect($validated['emails'])
            ->map(fn (string $email) => strtolower(trim($email)))
            ->filter(fn (string $email) => $email !== '')
            ->unique()
            ->values();

        if ($uniqueRecipients->isEmpty()) {
            return back()->withErrors(['emails' => 'Please select at least one valid recipient email.'])->withInput();
        }

        $htmlBody = $this->buildCampaignHtml($validated);

        $imageUrls = [];
        if ($request->hasFile('campaign_images')) {
            $user = auth()->user();
            $user->clearMediaCollection('mail_campaign_images');
            foreach ($request->file('campaign_images') as $uploadedImage) {
                $media = $user->addMedia($uploadedImage)->toMediaCollection('mail_campaign_images');
                $imageUrls[] = $media->getUrl();
            }
        }

        if (! empty($imageUrls)) {
            $htmlBody .= '<hr style="margin:24px 0;border:none;border-top:1px solid #e5e7eb;">';
            foreach ($imageUrls as $url) {
                $safeUrl = e($url);
                $htmlBody .= '<p style="margin:0 0 16px;"><img src="'.$safeUrl.'" alt="Campaign image" style="max-width:100%;height:auto;border-radius:8px;"></p>';
            }
        }

        $sendMode = $validated['send_mode'] ?? 'live';
        if ($sendMode === 'test') {
            $testRecipient = $validated['preview_email'] ?? auth()->user()->email;
            Mail::to($testRecipient)->send(new CampaignBroadcastMail($validated['subject'], $htmlBody));

            CampaignSendLog::query()->create([
                'sender_id' => auth()->id(),
                'subject' => $validated['subject'],
                'recipients_count' => 1,
                'recipients' => [$testRecipient],
                'send_mode' => 'test',
                'sent_at' => now(),
            ]);

            return back()->with('success', "Test campaign sent to {$testRecipient}.");
        }

        $sentCount = 0;
        foreach ($uniqueRecipients->chunk(100) as $batch) {
            foreach ($batch as $recipient) {
                SendCampaignEmailJob::dispatch(
                    recipientEmail: $recipient,
                    subject: $validated['subject'],
                    htmlBody: $htmlBody
                );
                $sentCount++;
            }
        }

        CampaignSendLog::query()->create([
            'sender_id' => auth()->id(),
            'subject' => $validated['subject'],
            'recipients_count' => $sentCount,
            'recipients' => $uniqueRecipients->all(),
            'send_mode' => 'live',
            'sent_at' => now(),
        ]);

        return back()->with('success', "Campaign queued successfully for {$sentCount} recipients.");
    }

    private function extractValidEmails(?string $rawEmails): Collection
    {
        if (! is_string($rawEmails) || trim($rawEmails) === '') {
            return collect();
        }

        return collect(preg_split('/[\s,;]+/', $rawEmails) ?: [])
            ->map(fn (string $email) => trim($email))
            ->filter(fn (string $email) => filter_var($email, FILTER_VALIDATE_EMAIL))
            ->values();
    }

    /**
     * @param  array<string, mixed>  $validated
     */
    private function buildCampaignHtml(array $validated): string
    {
        $messageHtml = trim((string) ($validated['message_html'] ?? ''));
        if ($messageHtml !== '') {
            return $messageHtml;
        }

        $plainMessage = (string) ($validated['message'] ?? '');

        return nl2br(e($plainMessage));
    }
}
