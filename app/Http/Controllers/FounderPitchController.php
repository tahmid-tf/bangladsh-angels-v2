<?php

namespace App\Http\Controllers;

use App\Models\FounderPitchSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FounderPitchController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'contact_email' => ['required', 'email', 'max:255'],
            'one_line' => ['required', 'string', 'max:280'],
            'pitch_deck' => ['required', 'file', 'mimes:pdf', 'max:12288'],
        ]);

        DB::transaction(function () use ($request, $validated) {
            $submission = FounderPitchSubmission::create([
                'user_id' => $request->user()?->id,
                'contact_email' => $validated['contact_email'],
                'one_line' => $validated['one_line'],
            ]);

            $submission->addMediaFromRequest('pitch_deck')
                ->toMediaCollection(FounderPitchSubmission::MEDIA_PITCH_DECK);
        });

        return redirect()
            ->to(route('startups').'#send-pitch')
            ->with('pitch_submitted', true);
    }
}
