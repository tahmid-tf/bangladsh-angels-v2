<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FounderPitchSubmission;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FounderPitchSubmissionController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $submissions = FounderPitchSubmission::query()
            ->with(['user', 'media'])
            ->latest()
            ->paginate(20);

        return view('admin.founder-pitches.index', compact('submissions'));
    }

    public function show(FounderPitchSubmission $founderPitchSubmission)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $founderPitchSubmission->load(['user', 'media']);

        return view('admin.founder-pitches.show', [
            'submission' => $founderPitchSubmission,
        ]);
    }

    public function downloadDeck(FounderPitchSubmission $founderPitchSubmission): BinaryFileResponse
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $media = $founderPitchSubmission->getFirstMedia(FounderPitchSubmission::MEDIA_PITCH_DECK);
        abort_if(! $media, 404);

        return response()->download($media->getPath(), $media->file_name, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
