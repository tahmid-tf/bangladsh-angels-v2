@extends('layouts.admin')
@section('page_title','Deals | Dashboard')
@section('page_content')
<section class="container w-full p-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-4 bg-white shadow">
        <h1 class="text-lg md:text-xl font-bold mb-2 md:mb-0">Deals & Portfolios ({{count($deals)}})</h1>

        <a href="{{route('deal.add')}}" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 whitespace-nowrap">
            + Add New Deal
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg mt-6 shadow p-4 mb-6">
        <div class="flex flex-wrap items-center gap-4">
            <!-- Tabs -->
            <div class="flex space-x-4">
                <a href="{{route('admin.deals')}}" class="px-4 py-2 bg-green-100 text-green-700 rounded-full">All</a>
                <a href="{{route('admin.deals.invest')}}" class="px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-full">Invest</a>
                <a href="{{route('admin.deals.commit')}}" class="px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-full">Commit</a>
                <a href="{{route('admin.deals.review')}}" class="px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-full">Review</a>
                <a href="{{route('admin.deals.portfolio')}}" class="px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-full">Portfolio</a>
                <a href="{{route('admin.deals.invest-portfolio')}}" class="px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-full">Invest &amp; Portfolio</a>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-4">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <livewire:deals-table />


   
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
