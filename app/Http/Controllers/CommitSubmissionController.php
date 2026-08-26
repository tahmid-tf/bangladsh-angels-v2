<?php

namespace App\Http\Controllers;

use App\Models\CommitSubmission;
use App\Models\Deal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommitSubmissionController extends Controller
{
    public function store(Request $request, Deal $deal): RedirectResponse
    {
        abort_unless($request->user() && ! $request->user()->isFree(), 403);
        abort_if($deal->type === 'portfolio', 404);

        $validated = $request->validateWithBag('commitSubmission', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'whatsapp_number' => ['required', 'string', 'max:50', 'regex:/^[0-9+()\-\s.]+$/'],
            'amount' => ['required', 'numeric', 'min:1', 'max:999999999999.99'],
            'currency' => ['required', Rule::in(['BDT', 'USD', 'GBP', 'EUR', 'SGD', 'AED'])],
        ], [
            'whatsapp_number.regex' => 'Please enter a valid WhatsApp number.',
        ]);

        $submission = CommitSubmission::query()->updateOrCreate(
            [
                'deal_id' => $deal->id,
                'user_id' => $request->user()->id,
            ],
            [
                'name' => trim($validated['name']),
                'email' => trim($validated['email']),
                'whatsapp_number' => trim($validated['whatsapp_number']),
                'company_name' => $deal->title,
                'amount' => $validated['amount'],
                'currency' => $validated['currency'],
            ]
        );

        $message = $submission->wasRecentlyCreated
            ? 'Your commit submission has been received.'
            : 'Your commit submission has been updated.';

        return redirect()
            ->route('deal.view', $deal)
            ->with('success', $message);
    }
}
