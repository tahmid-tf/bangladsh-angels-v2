<?php

namespace App\Http\Controllers;

use App\Models\AngelAcademyNetworkApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AngelAcademyNetworkApplicationController extends Controller
{
    public function create(Request $request): View
    {
        return view('angel-academy-apply');
    }

    public function store(Request $request): RedirectResponse
    {
        $investedKeys = array_keys(AngelAcademyNetworkApplication::INVESTED_BEFORE);
        $motivationKeys = array_keys(AngelAcademyNetworkApplication::PRIMARY_MOTIVATION);
        $stageKeys = array_keys(AngelAcademyNetworkApplication::STARTUP_STAGES);
        $sectorKeys = array_keys(AngelAcademyNetworkApplication::SECTORS);
        $chequeKeys = array_keys(AngelAcademyNetworkApplication::CHEQUE_SIZE);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'contact_number' => ['required', 'string', 'max:64'],
            'linkedin_url' => ['required', 'string', 'max:512'],
            'invested_before' => ['required', 'string', Rule::in($investedKeys)],
            'primary_motivation' => ['required', 'string', Rule::in($motivationKeys)],
            'startup_stages' => ['required', 'array', 'min:1'],
            'startup_stages.*' => ['string', Rule::in($stageKeys)],
            'sectors' => ['required', 'array', 'min:1'],
            'sectors.*' => ['string', Rule::in($sectorKeys)],
            'sectors_other' => [
                'nullable',
                'string',
                'max:500',
                Rule::requiredIf(fn () => in_array('other', (array) $request->input('sectors', []), true)),
            ],
            'cheque_size' => ['required', 'string', Rule::in($chequeKeys)],
        ]);

        AngelAcademyNetworkApplication::query()->create([
            'user_id' => $request->user()?->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'contact_number' => $validated['contact_number'],
            'linkedin_url' => $validated['linkedin_url'],
            'invested_before' => $validated['invested_before'],
            'primary_motivation' => $validated['primary_motivation'],
            'startup_stages' => array_values(array_unique($validated['startup_stages'])),
            'sectors' => array_values(array_unique($validated['sectors'])),
            'sectors_other' => in_array('other', $validated['sectors'], true)
                ? ($validated['sectors_other'] ?? null)
                : null,
            'cheque_size' => $validated['cheque_size'],
        ]);

        return redirect()
            ->route('angel-academy.apply')
            ->with('angel_academy_apply_success', true);
    }
}
