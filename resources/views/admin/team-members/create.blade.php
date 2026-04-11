@extends('layouts.admin')
@section('page_title', 'Add team member | Dashboard')
@section('page_content')
<div class="container w-full p-6 max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('admin.team-members') }}" class="text-sm font-semibold text-[#0a5554] hover:underline">← Back</a>
        <h1 class="text-2xl font-bold mt-4 text-gray-900">Add team member</h1>
        <p class="text-sm text-gray-600 mt-2">
            Section:
            @if ($section === \App\Models\TeamMember::SECTION_MANAGEMENT)
                Team &amp; Management
            @else
                Governing Board
            @endif
        </p>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $nextSort = (\App\Models\TeamMember::query()->forSection($section)->max('sort_order') ?? 0) + 1;
    @endphp

    <form method="post" action="{{ route('admin.team-members.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 space-y-6">
        @csrf
        <input type="hidden" name="section" value="{{ $section }}">

        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required maxlength="255"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
        </div>

        <div>
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Title / role</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required maxlength="255"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
        </div>

        <div>
            <label for="subtitle" class="block text-sm font-semibold text-gray-700 mb-1">Organization (optional)</label>
            <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle') }}" maxlength="255"
                placeholder="e.g. company name for governing board"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
        </div>

        <div>
            <label for="linkedin_url" class="block text-sm font-semibold text-gray-700 mb-1">LinkedIn URL (optional)</label>
            <input type="text" name="linkedin_url" id="linkedin_url" value="{{ old('linkedin_url') }}" maxlength="512"
                placeholder="https://www.linkedin.com/in/…"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
        </div>

        <div>
            <label for="sort_order" class="block text-sm font-semibold text-gray-700 mb-1">Sort order</label>
            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $nextSort) }}" required min="0" max="99999"
                class="w-full max-w-xs rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
        </div>

        <div>
            <label for="photo" class="block text-sm font-semibold text-gray-700 mb-1">Photo (optional)</label>
            <input type="file" name="photo" id="photo" accept="image/*"
                class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-green-50 file:px-4 file:py-2 file:font-semibold file:text-[#0a5554]">
            <p class="mt-1 text-xs text-gray-500">Shown in a circle on the public page (cropped to fit). Max 5&nbsp;MB.</p>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">Save</button>
            <a href="{{ route('admin.team-members') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
