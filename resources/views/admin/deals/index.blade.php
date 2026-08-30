@extends('layouts.admin')
@section('page_title', 'Deals | Dashboard')
@section('page_content')
<section class="container w-full p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-4 bg-white shadow">
        <h1 class="text-lg md:text-xl font-bold mb-2 md:mb-0">Deals &amp; Portfolios ({{ count($deals) }})</h1>
        <a href="{{ route('deal.add') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 whitespace-nowrap">
            + Add New Deal
        </a>
    </div>

    <div class="bg-white rounded-lg mt-6 shadow p-4 mb-6">
        @include('admin.deals.partials.tabs', ['activeDealTab' => 'all'])
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-4">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <livewire:deals-table filter="all" />
</section>
@endsection
