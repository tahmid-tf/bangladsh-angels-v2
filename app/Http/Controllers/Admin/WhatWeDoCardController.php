<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatWeDoCard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WhatWeDoCardController extends Controller
{
    public function index(): View
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $cards = WhatWeDoCard::query()->ordered()->get();

        return view('admin.what-we-do-cards.index', compact('cards'));
    }

    public function edit(WhatWeDoCard $whatWeDoCard): View
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        return view('admin.what-we-do-cards.edit', ['card' => $whatWeDoCard]);
    }

    public function update(Request $request, WhatWeDoCard $whatWeDoCard): RedirectResponse
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:8000'],
            'cta_link' => [
                'nullable',
                'string',
                'max:2048',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    if (! filled($value)) {
                        return;
                    }

                    $isAbsoluteUrl = filter_var($value, FILTER_VALIDATE_URL) !== false;
                    $isRelativePath = str_starts_with($value, '/');
                    $isAnchor = str_starts_with($value, '#');

                    if (! $isAbsoluteUrl && ! $isRelativePath && ! $isAnchor) {
                        $fail('The CTA link must be a valid URL, a relative path starting with "/", or an anchor starting with "#".');
                    }
                },
            ],
            'cover' => ['nullable', 'image', 'max:5120'],
        ]);

        $whatWeDoCard->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'cta_link' => filled($validated['cta_link'] ?? null) ? $validated['cta_link'] : null,
        ]);

        if ($request->boolean('remove_cover')) {
            $whatWeDoCard->clearMediaCollection(WhatWeDoCard::MEDIA_COVER);
        }

        if ($request->hasFile('cover')) {
            $whatWeDoCard->clearMediaCollection(WhatWeDoCard::MEDIA_COVER);
            $whatWeDoCard->addMediaFromRequest('cover')
                ->toMediaCollection(WhatWeDoCard::MEDIA_COVER);
        }

        return redirect()
            ->route('admin.what-we-do-cards')
            ->with('success', 'What We Do card updated.');
    }
}
