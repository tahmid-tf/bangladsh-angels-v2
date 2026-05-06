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
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
            'isSuperadmin' => auth()->user()?->role === 'superadmin',
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

        $sendMode = $request->input('send_mode', 'live');
        $isTestMode = $sendMode === 'test';
        $user = auth()->user();

        $draftImageIds = collect($request->input('draft_image_ids', []))
            ->map(fn ($id) => (int) $id)
            ->filter(fn ($id) => $id > 0)
            ->values();

        if ($request->hasFile('campaign_images')) {
            $request->validate([
                'campaign_images' => ['array'],
                'campaign_images.*' => ['file', 'mimetypes:image/jpeg,image/png,image/gif,image/webp,application/pdf', 'max:10240'],
            ]);

            foreach ($request->file('campaign_images') as $uploadedImage) {
                $media = $user->addMedia($uploadedImage)->toMediaCollection('mail_campaign_images_draft');
                $draftImageIds->push((int) $media->id);
            }
        }

        $request->merge([
            'draft_image_ids' => $draftImageIds->unique()->values()->all(),
        ]);

        $validated = $request->validate([
            'emails' => [$isTestMode ? 'nullable' : 'required', 'array', 'min:1'],
            'emails.*' => ['email'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required_without:message_html', 'nullable', 'string', 'max:50000'],
            'message_html' => ['required_without:message', 'nullable', 'string', 'max:2000000'],
            'preview_email' => ['nullable', 'email'],
            'send_mode' => ['nullable', 'in:test,live'],
            'draft_image_ids' => ['nullable', 'array'],
            'draft_image_ids.*' => ['integer'],
        ]);

        $uniqueRecipients = collect($validated['emails'] ?? [])
            ->map(fn (string $email) => strtolower(trim($email)))
            ->filter(fn (string $email) => $email !== '')
            ->unique()
            ->values();

        if (! $isTestMode && $uniqueRecipients->isEmpty()) {
            return back()->withErrors(['emails' => 'Please select at least one valid recipient email.'])->withInput();
        }

        $htmlBody = $this->buildCampaignHtml($validated);
        [$htmlBody, $inlineConvertedAttachments] = $this->extractInlineImageAttachments($htmlBody);
        $draftMedia = $user->getMedia('mail_campaign_images_draft')
            ->whereIn('id', $draftImageIds->all())
            ->values();
        $attachmentPayload = array_merge(
            $this->buildAttachmentPayload($draftMedia),
            $inlineConvertedAttachments
        );
        $attachmentLogPayload = $this->buildAttachmentLogPayload($attachmentPayload);

        if ($isTestMode) {
            $testRecipient = $validated['preview_email'] ?? auth()->user()->email;
            Mail::to($testRecipient)->send(new CampaignBroadcastMail($validated['subject'], $htmlBody, $attachmentPayload));

            CampaignSendLog::query()->create([
                'sender_id' => auth()->id(),
                'subject' => $validated['subject'],
                'recipients_count' => 1,
                'recipients' => [$testRecipient],
                'attachments' => $attachmentLogPayload,
                'send_mode' => 'test',
                'sent_at' => now(),
            ]);

            $user->clearMediaCollection('mail_campaign_images_draft');

            return back()->with('success', "Test campaign sent to {$testRecipient}.");
        }

        $sentCount = 0;
        foreach ($uniqueRecipients->chunk(100) as $batch) {
            foreach ($batch as $recipient) {
                SendCampaignEmailJob::dispatch(
                    recipientEmail: $recipient,
                    subject: $validated['subject'],
                    htmlBody: $htmlBody,
                    attachments: $attachmentPayload
                );
                $sentCount++;
            }
        }

        CampaignSendLog::query()->create([
            'sender_id' => auth()->id(),
            'subject' => $validated['subject'],
            'recipients_count' => $sentCount,
            'recipients' => $uniqueRecipients->all(),
            'attachments' => $attachmentLogPayload,
            'send_mode' => 'live',
            'sent_at' => now(),
        ]);

        $user->clearMediaCollection('mail_campaign_images_draft');

        return back()->with('success', "Campaign queued successfully for {$sentCount} recipients.");
    }

    public function destroyLog(CampaignSendLog $campaignSendLog): RedirectResponse
    {
        abort_unless(auth()->user()?->role === 'superadmin', 403);

        $campaignSendLog->delete();

        return back()->with('success', 'Campaign log entry deleted.');
    }

    public function destroyAllLogs(): RedirectResponse
    {
        abort_unless(auth()->user()?->role === 'superadmin', 403);

        CampaignSendLog::query()->delete();

        return back()->with('success', 'All campaign log history has been cleared.');
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

    /**
     * @param  Collection<int, Media>  $mediaItems
     * @return array<int, array{filename:string,mime:string,data:string}>
     */
    private function buildAttachmentPayload(Collection $mediaItems): array
    {
        return $mediaItems->map(function (Media $media): ?array {
            $path = $media->getPath();
            if (! is_string($path) || $path === '' || ! is_file($path) || ! is_readable($path)) {
                return null;
            }

            $binary = file_get_contents($path);
            if ($binary === false) {
                return null;
            }

            return [
                'filename' => $media->file_name ?: 'attachment',
                'mime' => (string) ($media->mime_type ?: mime_content_type($path) ?: 'application/octet-stream'),
                'data' => base64_encode($binary),
            ];
        })->filter()->values()->all();
    }

    /**
     * @param  array<int, array{filename:string,mime:string,data:string}>  $attachments
     * @return array<int, array{filename:string,mime:string,size_kb:int}>
     */
    private function buildAttachmentLogPayload(array $attachments): array
    {
        return collect($attachments)->map(function (array $attachment): array {
            $decoded = base64_decode((string) ($attachment['data'] ?? ''), true);
            $bytes = is_string($decoded) ? strlen($decoded) : 0;

            return [
                'filename' => (string) ($attachment['filename'] ?? 'attachment'),
                'mime' => (string) ($attachment['mime'] ?? 'application/octet-stream'),
                'size_kb' => (int) ceil($bytes / 1024),
            ];
        })->values()->all();
    }

    /**
     * Convert inline data-image tags to regular attachments and
     * replace body images with a plain placeholder for email-client safety.
     *
     * @return array{0:string,1:array<int, array{filename:string,mime:string,data:string}>}
     */
    private function extractInlineImageAttachments(string $html): array
    {
        $attachments = [];
        $counter = 1;

        $updatedHtml = preg_replace_callback(
            '/<img\b[^>]*\bsrc=(["\'])(data:image\/[^"\']+)\1[^>]*>/i',
            function (array $matches) use (&$attachments, &$counter): string {
                $dataUri = (string) ($matches[2] ?? '');
                if (! str_contains($dataUri, ';base64,')) {
                    return $matches[0];
                }

                [$meta, $encoded] = explode(';base64,', $dataUri, 2);
                $mime = strtolower(str_replace('data:', '', $meta));
                $binary = base64_decode($encoded, true);
                if ($binary === false) {
                    return $matches[0];
                }

                $extension = match ($mime) {
                    'image/jpeg', 'image/jpg' => 'jpg',
                    'image/png' => 'png',
                    'image/gif' => 'gif',
                    'image/webp' => 'webp',
                    default => 'img',
                };

                $filename = 'inline-image-'.$counter.'.'.$extension;
                $counter++;

                $attachments[] = [
                    'filename' => $filename,
                    'mime' => $mime,
                    'data' => base64_encode($binary),
                ];

                return '<p style="margin:12px 0;color:#6b7280;font-size:13px;">[Inline image converted to attachment: '.e($filename).']</p>';
            },
            $html
        );

        return [$updatedHtml ?? $html, $attachments];
    }
}
