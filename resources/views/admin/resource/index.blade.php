@extends('layouts.admin')
@section('page_title','Events | Dashboard')
@section('page_content')
<section class="container w-full p-6">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-4 bg-white shadow">
        <h1 class="text-lg md:text-xl font-bold mb-2 md:mb-0">
            Events ({{ count($resources) }})
        </h1>

        <!-- Button to add a new event -->
        <a href="{{ route('admin.events.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 whitespace-nowrap">
            + Add New Event
        </a>
    </div>

    <!-- Filters (Optional) -->
    <div class="bg-white rounded-lg mt-6 shadow p-4 mb-6">
        <div class="flex flex-wrap items-center gap-4">
            <!-- Example Tabs -->
            <div class="flex space-x-4">
                <a href="{{ route('admin.events') }}"
                   class="px-4 py-2 bg-green-100 text-green-700 rounded-full">
                    All
                </a>
                <a href="#"
                   class="px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-full">
                    Upcoming
                </a>
                <a href="#"
                   class="px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-full">
                    Past
                </a>
                <a href="#"
                   class="px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-full">
                    Archived
                </a>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-4">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Resource Listing -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-4">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Title
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Date
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Time
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Location
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Home
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        CTA
                    </th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($resources as $resource)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">
                            {{ $resource->title }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ ucfirst($resource->type) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            @if($resource->date)
                                {{ $resource->date->format('M d, Y') }}
                            @else
                                —
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            @if($resource->start_time && $resource->end_time)
                                {{ $resource->start_time->format('g:i A') }} - {{ $resource->end_time->format('g:i A') }}
                            @elseif($resource->start_time)
                                {{ $resource->start_time->format('g:i A') }}
                            @else
                                —
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $resource->location ?: '—' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            @if ($resource->show_on_landing)
                                <span class="inline-flex rounded-full bg-emerald-100 px-2 py-0.5 text-xs font-semibold text-emerald-800">Yes</span>
                            @else
                                —
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-[10rem] truncate" title="{{ $resource->cta_link }}">
                            {{ $resource->cta_link ? 'Yes' : '—' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.events.edit', $resource->id) }}"
                               class="text-blue-600 hover:text-blue-900">
                                Edit
                            </a>
                            {{-- Optionally add a Delete button or a Show link here --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            No events found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</section>

<style>
    .toggle-checkbox {
        width: 1.5rem;
        height: 0.75rem;
        appearance: none;
        background: #d1d5db;
        border-radius: 9999px;
        position: relative;
        cursor: pointer;
        transition: background 0.3s;
    }
    .toggle-checkbox:checked {
        background: #34d399;
    }
</style>
@endsection
