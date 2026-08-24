<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamAboutSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamAboutSectionController extends Controller
{
    public function edit(): View
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $section = TeamAboutSection::query()->firstOrFail();

        return view('admin.team-about-section.edit', compact('section'));
    }

    public function update(Request $request): RedirectResponse
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $section = TeamAboutSection::query()->firstOrFail();
        $validated = $request->validate([
            'kicker' => ['required', 'string', 'max:160'],
            'heading' => ['required', 'string', 'max:255'],
            'body_text' => ['required', 'string', 'max:12000'],
            'image_alt' => ['required', 'string', 'max:255'],
            'image_badge' => ['required', 'string', 'max:160'],
            'image' => ['nullable', 'image', 'max:8192'],
            'remove_image' => ['sometimes', 'boolean'],
        ]);

        $paragraphs = collect(preg_split('/(?:\r\n|\r|\n){2,}/', trim($validated['body_text'])))
            ->map(fn (string $paragraph) => trim($paragraph))
            ->filter()
            ->values()
            ->all();

        $section->update([
            'kicker' => trim($validated['kicker']),
            'heading' => trim($validated['heading']),
            'body' => $paragraphs,
            'image_alt' => trim($validated['image_alt']),
            'image_badge' => trim($validated['image_badge']),
        ]);

        if ($request->boolean('remove_image')) {
            $section->clearMediaCollection(TeamAboutSection::MEDIA_IMAGE);
        }

        if ($request->hasFile('image')) {
            $section->clearMediaCollection(TeamAboutSection::MEDIA_IMAGE);
            $section->addMediaFromRequest('image')
                ->toMediaCollection(TeamAboutSection::MEDIA_IMAGE);
        }

        return redirect()
            ->route('admin.team-about-section.edit')
            ->with('success', 'Team About section updated.');
    }
}
