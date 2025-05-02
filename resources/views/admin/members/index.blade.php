@extends('layouts.admin')
@section('page_title','Members | Dashboard')
@section('page_content')

<!-- Header Section -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center p-4 bg-white shadow">
    <h1 class="text-lg md:text-xl font-bold mb-2 md:mb-0">Members ({{count($allUsers)}})</h1>
    <a href="{{route('member.add')}}" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 whitespace-nowrap">
        + Add New Member
    </a>
</div>

<!-- Filters and Search -->
<div class="p-4 md:p-6 bg-white shadow mt-4">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <!-- Tabs -->
        <div class="flex flex-wrap gap-2">
            <a href="{{route('admin.members')}}" class="px-4 py-2 bg-green-100 text-green-700 font-semibold rounded-lg">All</a>
            <a href="{{route('admin.active.members')}}" class="px-4 py-2 text-gray-500 hover:text-green-700">Active</a>
            <a href="{{route('admin.inactive.members')}}" class="px-4 py-2 text-gray-500 hover:text-green-700">Inactive</a>
            <a href="{{route('admin.pending.members')}}" class="px-4 py-2 text-gray-500 hover:text-green-700">Pending Approval</a>
        </div>

        <!-- Role Filter and Search -->
        <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
            <input type="text" placeholder="Search..." class="border-gray-300 rounded-lg shadow-sm px-4 py-2">
        </div>
    </div>
</div>

@if (session('success'))
<div class="mt-4 mx-4 md:mx-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex items-center justify-between">
    <div>
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    <button onclick="this.parentElement.remove()" class="ml-4">
        <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M14.59 5.41L10 10l-4.59-4.59L4 7l6 6 6-6z"/>
        </svg>
    </button>
</div>
@endif

<livewire:members-table />

@endsection