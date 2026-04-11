@extends('layouts.admin')
@section('page_title', 'Team page | Dashboard')
@section('page_content')
<div class="container w-full p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 p-4 bg-white shadow mb-6 rounded-lg">
        <div>
            <h1 class="text-lg md:text-xl font-bold">Public team page</h1>
            <p class="text-sm text-gray-600 mt-1">Manage Team &amp; Management and Governing Board. Order is controlled by the sort field (lower numbers first).</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('team') }}" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold text-[#0a5554] hover:underline">View /team →</a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="space-y-10">
        <section class="bg-white rounded-lg shadow overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 px-4 py-4 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-bold text-[#0f3d34]">Team &amp; Management</h2>
                <a href="{{ route('admin.team-members.create', ['section' => \App\Models\TeamMember::SECTION_MANAGEMENT]) }}" class="inline-flex justify-center rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700 transition">Add member</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-white border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-3 font-semibold text-gray-700">Photo</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Name</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Title</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Sort</th>
                            <th class="px-4 py-3 font-semibold text-gray-700"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($management as $member)
                            <tr class="hover:bg-gray-50/80">
                                <td class="px-4 py-3">
                                    @if ($member->photoUrl())
                                        <img src="{{ $member->photoUrl() }}" alt="" class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <span class="text-gray-400 text-xs">—</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $member->name }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $member->title }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $member->sort_order }}</td>
                                <td class="px-4 py-3 whitespace-nowrap space-x-3">
                                    <a href="{{ route('admin.team-members.edit', $member) }}" class="text-[#0a5554] font-semibold hover:underline">Edit</a>
                                    <form method="post" action="{{ route('admin.team-members.destroy', $member) }}" class="inline" onsubmit="return confirm('Remove this member from the site?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 font-semibold hover:underline">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">No members yet. Add one to get started.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 px-4 py-4 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-bold text-[#0f3d34]">Governing Board</h2>
                <a href="{{ route('admin.team-members.create', ['section' => \App\Models\TeamMember::SECTION_GOVERNING_BOARD]) }}" class="inline-flex justify-center rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700 transition">Add member</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-white border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-3 font-semibold text-gray-700">Photo</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Name</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Title / org</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Sort</th>
                            <th class="px-4 py-3 font-semibold text-gray-700"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($governingBoard as $member)
                            <tr class="hover:bg-gray-50/80">
                                <td class="px-4 py-3">
                                    @if ($member->photoUrl())
                                        <img src="{{ $member->photoUrl() }}" alt="" class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <span class="text-gray-400 text-xs">—</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $member->name }}</td>
                                <td class="px-4 py-3 text-gray-600">
                                    {{ $member->title }}
                                    @if (filled($member->subtitle))
                                        <span class="text-gray-400"> · </span>{{ $member->subtitle }}
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-600">{{ $member->sort_order }}</td>
                                <td class="px-4 py-3 whitespace-nowrap space-x-3">
                                    <a href="{{ route('admin.team-members.edit', $member) }}" class="text-[#0a5554] font-semibold hover:underline">Edit</a>
                                    <form method="post" action="{{ route('admin.team-members.destroy', $member) }}" class="inline" onsubmit="return confirm('Remove this member from the site?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 font-semibold hover:underline">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">No members yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
@endsection
