<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    public function index(): View
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $management = TeamMember::query()
            ->forSection(TeamMember::SECTION_MANAGEMENT)
            ->ordered()
            ->get();

        $governingBoard = TeamMember::query()
            ->forSection(TeamMember::SECTION_GOVERNING_BOARD)
            ->ordered()
            ->get();

        return view('admin.team-members.index', compact('management', 'governingBoard'));
    }

    public function create(Request $request): View
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $section = $request->query('section', TeamMember::SECTION_MANAGEMENT);
        abort_unless(in_array($section, [TeamMember::SECTION_MANAGEMENT, TeamMember::SECTION_GOVERNING_BOARD], true), 404);

        return view('admin.team-members.create', compact('section'));
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $validated = $this->validateMember($request, creating: true);

        $nextOrder = (int) (TeamMember::query()
            ->forSection($validated['section'])
            ->max('sort_order') ?? 0) + 1;

        $member = TeamMember::query()->create([
            'section' => $validated['section'],
            'name' => $validated['name'],
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'linkedin_url' => $validated['linkedin_url'] ?? null,
            'sort_order' => $validated['sort_order'] ?? $nextOrder,
        ]);

        if ($request->hasFile('photo')) {
            $member->addMediaFromRequest('photo')
                ->toMediaCollection(TeamMember::MEDIA_PHOTO);
        }

        return redirect()
            ->route('admin.team-members')
            ->with('success', 'Team member added.');
    }

    public function edit(TeamMember $teamMember): View
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        return view('admin.team-members.edit', ['member' => $teamMember]);
    }

    public function update(Request $request, TeamMember $teamMember): RedirectResponse
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $validated = $this->validateMember($request, creating: false);

        $teamMember->update([
            'name' => $validated['name'],
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'linkedin_url' => $validated['linkedin_url'] ?? null,
            'sort_order' => $validated['sort_order'],
        ]);

        if ($request->hasFile('photo')) {
            $teamMember->clearMediaCollection(TeamMember::MEDIA_PHOTO);
            $teamMember->addMediaFromRequest('photo')
                ->toMediaCollection(TeamMember::MEDIA_PHOTO);
        }

        return redirect()
            ->route('admin.team-members')
            ->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $teamMember): RedirectResponse
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $teamMember->delete();

        return redirect()
            ->route('admin.team-members')
            ->with('success', 'Team member removed.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validateMember(Request $request, bool $creating): array
    {
        $linkedin = ['nullable', 'string', 'max:512', function (string $attribute, mixed $value, \Closure $fail): void {
            if (! is_string($value) || trim($value) === '') {
                return;
            }
            if (filter_var($value, FILTER_VALIDATE_URL) === false) {
                $fail('The LinkedIn URL must be a valid URL.');
            }
        }];

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'linkedin_url' => $linkedin,
            'sort_order' => ['required', 'integer', 'min:0', 'max:99999'],
            'photo' => ['nullable', 'image', 'max:5120'],
        ];

        if ($creating) {
            $rules['section'] = ['required', 'string', Rule::in([TeamMember::SECTION_MANAGEMENT, TeamMember::SECTION_GOVERNING_BOARD])];
        }

        $validated = $request->validate($rules);
        $validated['subtitle'] = filled($validated['subtitle'] ?? null) ? trim((string) $validated['subtitle']) : null;
        $validated['linkedin_url'] = filled($validated['linkedin_url'] ?? null) ? trim((string) $validated['linkedin_url']) : null;

        return $validated;
    }
}
