@extends('layouts.admin')
@section('page_title','Resources | Dashboard')
@section('page_content')
<section class="container w-full p-6">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-4 bg-white shadow">
        <h1 class="text-lg md:text-xl font-bold mb-2 md:mb-0">
            Resources ({{ count($resources) }})
        </h1>

        <!-- Button to add a new resource -->
        <a href="{{ route('resource.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 whitespace-nowrap">
            + Add New Resource
        </a>
    </div>

    <!-- Filters (Optional) -->
    <div class="bg-white rounded-lg mt-6 shadow p-4 mb-6">
        <div class="flex flex-wrap items-center gap-4">
            <!-- Example Tabs -->
            <div class="flex space-x-4">
                <a href="{{ route('admin.resources') }}"
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

    <!-- Resource Listing (Livewire or standard table) -->
    <!-- Example using Livewire: -->
    {{-- <livewire:resources-table /> --}}


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
