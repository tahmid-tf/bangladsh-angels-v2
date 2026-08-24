<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPageStat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LandingPageStatController extends Controller
{
    public function index(): View
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $stats = LandingPageStat::query()->ordered()->get();

        return view('admin.landing-page-stats.index', compact('stats'));
    }

    public function update(Request $request): RedirectResponse
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $validated = $request->validate([
            'stats' => ['required', 'array', 'size:3'],
            'stats.*.value' => ['required', 'string', 'max:40'],
            'stats.*.label' => ['required', 'string', 'max:120'],
        ]);

        $stats = LandingPageStat::query()
            ->whereKey(array_keys($validated['stats']))
            ->get()
            ->keyBy('id');

        if ($stats->count() !== 3) {
            throw ValidationException::withMessages([
                'stats' => 'The homepage statistics could not be matched. Please refresh and try again.',
            ]);
        }

        DB::transaction(function () use ($validated, $stats): void {
            foreach ($validated['stats'] as $id => $input) {
                $stats->get((int) $id)->update([
                    'value' => trim($input['value']),
                    'label' => trim($input['label']),
                ]);
            }
        });

        return redirect()
            ->route('admin.landing-page-stats')
            ->with('success', 'Homepage statistics updated.');
    }
}
