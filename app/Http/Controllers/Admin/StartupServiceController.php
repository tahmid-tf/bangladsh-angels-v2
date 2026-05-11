<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StartupService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StartupServiceController extends Controller
{
    public function index(): View
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $services = StartupService::query()->ordered()->get();

        return view('admin.startup-services.index', compact('services'));
    }

    public function create(): View
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        return view('admin.startup-services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $validated = $this->validatedService($request);
        $bullets = $this->bulletsFromRequest($request);

        $nextOrder = (int) (StartupService::query()->max('sort_order') ?? 0) + 1;

        $service = StartupService::query()->create([
            'title' => $validated['title'],
            'intro' => $validated['intro'],
            'bullets' => $bullets,
            'footer_note' => $validated['footer_note'] ?: null,
            'link' => $validated['link'],
            'cta_label' => $validated['cta_label'],
            'brochure_url' => $validated['brochure_url'] ?? null,
            'show_brochure_link' => $request->boolean('show_brochure_link'),
            'sort_order' => (int) ($validated['sort_order'] ?? $nextOrder),
        ]);

        if ($request->hasFile('logo')) {
            $service->addMediaFromRequest('logo')
                ->toMediaCollection(StartupService::MEDIA_LOGO);
        }

        $this->syncBrochureUpload($service, $request);

        return redirect()
            ->route('admin.startup-services')
            ->with('success', 'Service added successfully.');
    }

    public function edit(StartupService $startupService): View
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        return view('admin.startup-services.edit', ['service' => $startupService]);
    }

    public function update(Request $request, StartupService $startupService): RedirectResponse
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $validated = $this->validatedService($request);
        $bullets = $this->bulletsFromRequest($request);

        $startupService->update([
            'title' => $validated['title'],
            'intro' => $validated['intro'],
            'bullets' => $bullets,
            'footer_note' => $validated['footer_note'] ?: null,
            'link' => $validated['link'],
            'cta_label' => $validated['cta_label'],
            'brochure_url' => $validated['brochure_url'] ?? null,
            'show_brochure_link' => $request->boolean('show_brochure_link'),
            'sort_order' => (int) ($validated['sort_order'] ?? $startupService->sort_order),
        ]);

        if ($request->hasFile('logo')) {
            $startupService->clearMediaCollection(StartupService::MEDIA_LOGO);
            $startupService->addMediaFromRequest('logo')
                ->toMediaCollection(StartupService::MEDIA_LOGO);
        }

        $this->syncBrochureUpload($startupService, $request);

        return redirect()
            ->route('admin.startup-services')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(StartupService $startupService): RedirectResponse
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $startupService->clearMediaCollection(StartupService::MEDIA_LOGO);
        $startupService->clearMediaCollection(StartupService::MEDIA_BROCHURE);
        $startupService->delete();

        return redirect()
            ->route('admin.startup-services')
            ->with('success', 'Service removed.');
    }

    /**
     * @return list<string>
     */
    private function bulletsFromRequest(Request $request): array
    {
        $raw = $request->input('bullets_text', '');

        if (! is_string($raw) || $raw === '') {
            return [];
        }

        return collect(preg_split('/\r\n|\r|\n/', $raw))
            ->map(fn (string $line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedService(Request $request): array
    {
        if ($request->input('sort_order') === '' || $request->input('sort_order') === null) {
            $request->merge(['sort_order' => null]);
        }

        if ($request->input('brochure_url') === '') {
            $request->merge(['brochure_url' => null]);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'intro' => ['required', 'string', 'max:5000'],
            'bullets_text' => ['nullable', 'string', 'max:10000'],
            'footer_note' => ['nullable', 'string', 'max:2000'],
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
            'brochure_url' => ['nullable', 'string', 'max:2048', 'url'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999999'],
            'logo' => ['nullable', 'image', 'max:4096'],
            'brochure' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'remove_brochure' => ['sometimes', 'boolean'],
            'show_brochure_link' => ['sometimes', 'boolean'],
        ]);

        $bu = $validated['brochure_url'] ?? null;
        $validated['brochure_url'] = is_string($bu) && $bu !== '' ? trim($bu) : null;

        return $validated;
    }

    private function syncBrochureUpload(StartupService $service, Request $request): void
    {
        if ($request->hasFile('brochure')) {
            $service->clearMediaCollection(StartupService::MEDIA_BROCHURE);
            $service->addMediaFromRequest('brochure')
                ->toMediaCollection(StartupService::MEDIA_BROCHURE);

            return;
        }

        if ($request->boolean('remove_brochure')) {
            $service->clearMediaCollection(StartupService::MEDIA_BROCHURE);
        }
    }
}
