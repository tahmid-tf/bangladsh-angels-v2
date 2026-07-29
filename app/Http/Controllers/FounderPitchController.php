<?php

namespace App\Http\Controllers;

use App\Models\FounderPitchSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FounderPitchController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $redirectUrl = $request->routeIs('home.pitch')
            ? route('home').'#pitch-form'
            : route('startups').'#send-pitch';

        $validator = Validator::make($request->all(), [
            'contact_email' => ['required', 'email', 'max:255'],
            'one_line' => ['required', 'string', 'max:280'],
            'pitch_deck' => ['required', 'file', 'mimes:pdf', 'max:12288'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->to($redirectUrl)
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

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
            ->to($redirectUrl)
            ->with('pitch_submitted', true);
    }
}
