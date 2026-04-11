<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResourceHubCard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResourceHubCardController extends Controller
{
    public function index(): View
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $cards = ResourceHubCard::query()->ordered()->get();

        return view('admin.resource-hub.index', compact('cards'));
    }

    public function create(): View
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        return view('admin.resource-hub.create');
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $validated = $this->validatedHubCard($request);

        $nextOrder = (int) (ResourceHubCard::query()->max('sort_order') ?? 0) + 1;

        $card = ResourceHubCard::query()->create([
            'title' => $validated['title'],
            'one_liner' => $validated['one_liner'],
            'link' => $validated['link'],
            'cta_label' => $validated['cta_label'],
            'sort_order' => $nextOrder,
        ]);

        if ($request->hasFile('logo')) {
            $card->addMediaFromRequest('logo')
                ->toMediaCollection(ResourceHubCard::MEDIA_LOGO);
        }

        return redirect()
            ->route('admin.resource-hub')
            ->with('success', 'Card added successfully.');
    }

    public function edit(ResourceHubCard $resourceHubCard): View
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        return view('admin.resource-hub.edit', ['card' => $resourceHubCard]);
    }

    public function update(Request $request, ResourceHubCard $resourceHubCard): RedirectResponse
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $validated = $this->validatedHubCard($request);

        $resourceHubCard->update([
            'title' => $validated['title'],
            'one_liner' => $validated['one_liner'],
            'link' => $validated['link'],
            'cta_label' => $validated['cta_label'],
        ]);

        if ($request->hasFile('logo')) {
            $resourceHubCard->clearMediaCollection(ResourceHubCard::MEDIA_LOGO);
            $resourceHubCard->addMediaFromRequest('logo')
                ->toMediaCollection(ResourceHubCard::MEDIA_LOGO);
        }

        return redirect()
            ->route('admin.resource-hub')
            ->with('success', 'Card updated successfully.');
    }

    public function destroy(ResourceHubCard $resourceHubCard): RedirectResponse
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $resourceHubCard->clearMediaCollection(ResourceHubCard::MEDIA_LOGO);
        $resourceHubCard->delete();

        return redirect()
            ->route('admin.resource-hub')
            ->with('success', 'Card removed.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedHubCard(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'one_liner' => ['required', 'string', 'max:2000'],
            'link' => ['required', 'string', 'max:2048', function (string $attribute, mixed $value, \Closure $fail): void {
                if (! is_string($value) || $value === '') {
                    $fail('The '.$attribute.' field is required.');

                    return;
                }
                if (preg_match('#^mailto:#i', $value)) {
                    if (! str_contains($value, '@')) {
                        $fail('The '.$attribute.' must be a valid mailto link.');
                    }

                    return;
                }
                if (filter_var($value, FILTER_VALIDATE_URL) === false) {
                    $fail('The '.$attribute.' must be a valid URL (https://, http://, or mailto:).');
                }
            }],
            'cta_label' => ['required', 'string', 'max:120'],
            'logo' => ['nullable', 'image', 'max:4096'],
        ]);
    }
}
