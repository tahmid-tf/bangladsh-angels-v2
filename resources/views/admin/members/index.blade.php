@extends('layouts.admin')
@section('page_title','Members | Dashboard')
@section('page_content')

<!-- Header Section -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center p-4 bg-white shadow gap-3">
    <h1 class="text-lg md:text-xl font-bold mb-2 md:mb-0">Members</h1>
    @php
        $accountScope = request('account_scope', 'all');
        $approvalScope = request('approval_scope', 'all');
        $exportQuery = ['account_scope' => $accountScope, 'approval_scope' => $approvalScope];
        $isSuperadmin = auth()->user()?->role === 'superadmin';
    @endphp
    <div class="flex flex-wrap gap-2">
        @if ($isSuperadmin)
            <a href="{{ route('admin.members.export', ['format' => 'pdf'] + $exportQuery) }}" class="px-3 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm font-semibold hover:bg-gray-200">PDF</a>
            <a href="{{ route('admin.members.export', ['format' => 'sql'] + $exportQuery) }}" class="px-3 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm font-semibold hover:bg-gray-200">MySQL Backup</a>
            <a href="{{ route('admin.members.export', ['format' => 'csv'] + $exportQuery) }}" class="px-3 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm font-semibold hover:bg-gray-200">CSV</a>
            <a href="{{ route('admin.members.export', ['format' => 'excel'] + $exportQuery) }}" class="px-3 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm font-semibold hover:bg-gray-200">Excel</a>
            <a href="{{ route('admin.members.export', ['format' => 'json'] + $exportQuery) }}" class="px-3 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm font-semibold hover:bg-gray-200">JSON</a>
        @endif
        <a href="{{route('member.add')}}" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 whitespace-nowrap">
            + Add New Member
        </a>
    </div>
</div>

@if ($isSuperadmin)
    <div class="mt-4 mx-4 md:mx-0 bg-white shadow rounded-lg p-4">
        <form method="GET" action="{{ route('admin.members') }}" class="flex flex-wrap gap-3 items-end">
            <div>
                <label for="account_scope" class="block text-xs font-semibold text-gray-600 mb-1">Account Scope</label>
                <select id="account_scope" name="account_scope" class="px-3 py-2 border border-gray-300 rounded-lg bg-white text-sm">
                    <option value="all" @selected($accountScope === 'all')>All</option>
                    <option value="active" @selected($accountScope === 'active')>Active only</option>
                    <option value="inactive" @selected($accountScope === 'inactive')>Inactive (free) only</option>
                </select>
            </div>
            <div>
                <label for="approval_scope" class="block text-xs font-semibold text-gray-600 mb-1">Approval Scope</label>
                <select id="approval_scope" name="approval_scope" class="px-3 py-2 border border-gray-300 rounded-lg bg-white text-sm">
                    <option value="all" @selected($approvalScope === 'all')>All</option>
                    <option value="approved" @selected($approvalScope === 'approved')>Approved only</option>
                    <option value="pending" @selected($approvalScope === 'pending')>Pending only</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 rounded-lg bg-[#0a5554] text-white text-sm font-semibold hover:bg-[#084646]">Apply export filters</button>
            <a href="{{ route('admin.members') }}" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm font-semibold hover:bg-gray-200">Reset</a>
        </form>
    </div>
@endif

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

@if (session('error'))
<div class="mt-4 mx-4 md:mx-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative flex items-center justify-between">
    <div>
        <strong class="font-bold">Error:</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    <button onclick="this.parentElement.remove()" class="ml-4">
        <svg class="fill-current h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M14.59 5.41L10 10l-4.59-4.59L4 7l6 6 6-6z"/>
        </svg>
    </button>
</div>
@endif

<livewire:members-table />

@endsection