@extends('layouts.admin')
@section('page_title', 'Deals | Dashboard')
@section('page_content')
<section class="container mx-auto p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-4 bg-white shadow">
        <h1 class="text-lg md:text-xl font-bold mb-2 md:mb-0">{{ ($isDualListing ?? false) ? 'Investment & Portfolio' : 'Portfolios' }} ({{ count($deals) }})</h1>
        <a href="{{ route('deal.add') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 whitespace-nowrap">
            + Add New Deal
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-4 my-6">
        @include('admin.deals.partials.tabs', ['activeDealTab' => ($isDualListing ?? false) ? 'invest-portfolio' : 'portfolio'])
    </div>

    <livewire:deals-table filter="{{ ($isDualListing ?? false) ? 'invest-portfolio' : 'portfolio' }}" />
</section>
@endsection
