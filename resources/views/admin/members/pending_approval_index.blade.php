@extends('layouts.admin')
@section('page_title','Pending Approval Members | Dashboard')
@section('page_content')

<!-- Header Section -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center p-4 bg-white shadow">
    <h1 class="text-lg md:text-xl font-bold mb-2 md:mb-0">Pending Approval Members ({{count($allUsers)}})</h1>
    <a href="{{route('member.add')}}" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 whitespace-nowrap">
        + Add New Member
    </a>
</div>

<!-- Filters and Search -->
<div class="p-4 md:p-6 bg-white shadow mt-4">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <!-- Tabs -->
        <div class="flex flex-wrap gap-2">
            <a href="{{route('admin.members')}}" class="px-4 py-2 text-gray-500 hover:text-green-700">All</a>
            <a href="{{route('admin.active.members')}}" class="px-4 py-2 text-gray-500 hover:text-green-700">Active</a>
            <a href="{{route('admin.inactive.members')}}" class="px-4 py-2 text-gray-500 hover:text-green-700">Inactive</a>
            <a href="{{route('admin.pending.members')}}" class="px-4 py-2 bg-green-100 text-green-700 font-semibold rounded-lg">Pending Approval</a>
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

<!-- Members Table -->
<div class="p-4 md:p-6 bg-white shadow mt-4 overflow-x-auto">
    <div class="min-w-[1024px] md:w-full">
        <table class="w-full border-collapse text-left text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="pl-4 pr-2 md:px-6 py-4 font-medium text-gray-600">Member</th>
                    <th class="hidden md:table-cell px-6 py-4 font-medium text-gray-600">Designation</th>
                    <th class="hidden lg:table-cell px-6 py-4 font-medium text-gray-600">Organization</th>
                    <th class="hidden md:table-cell px-6 py-4 font-medium text-gray-600">Phone</th>
                    <th class="pl-2 pr-4 md:px-6 py-4 font-medium text-gray-600">Registered</th>
                    <th class="px-4 md:px-6 py-4 font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="border-t hover:bg-gray-50">
                    <!-- Combined Mobile Column -->
                    <td class="pl-4 pr-2 md:px-6 py-4">
                        <div class="flex items-center gap-2 md:gap-4">
                            <img src="{{ $user->getProfilePhotoUrl() }}" alt="Profile" 
                                 class="w-8 h-8 md:w-10 md:h-10 rounded-full">
                            <div class="min-w-[120px]">
                                <p class="font-medium">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ $user->email }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    Location: {{ $user->primary_country }}
                                </p>
                            </div>
                        </div>
                    </td>

                    <!-- Hidden on Mobile -->
                    <td class="hidden md:table-cell px-6 py-4">{{ $user->designation ?? '-' }}</td>
                    <td class="hidden lg:table-cell px-6 py-4">{{ $user->company_name ?? '-' }}</td>
                    <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap">{{ $user->phone ?? '-' }}</td>

                    <!-- Registration Column -->
                    <td class="pl-2 pr-4 md:px-6 py-4">
                        <div class="flex flex-col gap-1">
                            <span class="text-xs text-gray-500">
                                {{ $user->created_at->format('M d, Y') }}
                            </span>
                            <span class="text-xs text-gray-500">
                                {{ $user->created_at->diffForHumans() }}
                            </span>
                            @if($user->approved_at)
                            <span class="text-xs text-green-600 mt-1 inline-flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Approved {{ $user->approved_at->diffForHumans() }}
                            </span>
                            @endif
                        </div>
                    </td>

                    <!-- Actions Column -->
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('member.edit', $user->id) }}" 
                               class="text-gray-600 hover:text-green-700 p-1">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 117.74 122.88">
                                    <path fill-rule="evenodd" d="M94.62,2c-1.46-1.36-3.14-2.09-5.02-1.99c-1.88,0-3.56,0.73-4.92,2.2L73.59,13.72l31.07,30.03l11.19-11.72c1.36-1.36,1.88-3.14,1.88-5.02s-0.73-3.66-2.09-4.92L94.62,2L94.62,2L94.62,2z M41.44,109.58c-4.08,1.36-8.26,2.62-12.35,3.98c-4.08,1.36-8.16,2.72-12.35,4.08c-9.73,3.14-15.07,4.92-16.22,5.23c-1.15,0.31-0.42-4.18,1.99-13.6l7.74-29.61l0.64-0.66l30.56,30.56L41.44,109.58L41.44,109.58L41.44,109.58z M22.2,67.25l42.99-44.82l31.07,29.92L52.75,97.8L22.2,67.25L22.2,67.25z"/>
                                </svg>
                            </a>
                            @if(!$user->is_approved)
                            <form method="POST" action="{{ route('member.approve', $user->id) }}">
                                @csrf
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-1 px-3 rounded text-xs">
                                    Approve
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-6 px-4 md:px-6">
            {{ $users->links() }}
        </div>
    </div>
</div>

<style>
    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 4px;
    }
</style>

@endsection