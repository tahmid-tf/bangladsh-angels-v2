@extends('layouts.admin')
@section('page_title','Deals | Dashboard')
@section('page_content')
<section class="container mx-auto p-6">
    <!-- Header -->
    <header class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Deals ({{count($deals)}})</h1>
            <p class="text-gray-500">Dashboard &gt; Deals</p>
        </div>
        <a href="{{route('deal.add')}}" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">
            + Add new deal
        </a>
    </header>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex flex-wrap items-center gap-4">
            <!-- Tabs -->
            <div class="flex space-x-4">
                <button class="px-4 py-2 bg-green-100 text-green-700 rounded-full">All</button>
                <button class="px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-full">Invest</button>
                <button class="px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-full">Commit</button>
                <button class="px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-full">Review</button>
            </div>

            <!-- Filters -->
            <select class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200 focus:border-green-500">
                <option>Investment stage</option>
                <option>Pre Seed</option>
                <option>Series A</option>
                <option>Growth</option>
            </select>

            <input
                type="text"
                placeholder="Search..."
                class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200 focus:border-green-500"
            />
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600 font-semibold">Name and Membership</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-semibold">Investment stage</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-semibold">Amount Seeking</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-semibold">Description</th>
                    <th class="px-4 py-2 text-center text-gray-600 font-semibold">Key Metrics</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deals as $deal)
                <tr class="border-t">
                    <td class="px-4 py-2 flex items-center space-x-4">
                        <img src="{{ $deal->getLogoUrl() }}" alt="{{ $deal->title }} Logo" class="h-[30px] rounded-full">
                        <div>
                            <p class="font-semibold">{{ $deal->title }}</p>
                            <p class="text-sm text-gray-500">{{ $deal->sector }}</p>
                        </div>
                    </td>
                    <td class="px-4 py-2">{{ $deal->investment_stage }}</td>
                    <td class="px-4 py-2">${{ number_format($deal->amount_seeking, 2) }}</td>
                    <td class="px-4 py-2">{{ $deal->description }}</td>
                    <td class="px-4 py-2 text-left">
                        @foreach($deal->getKeyMetrics() as $metric)
                            <li>
                                <strong>{{ $metric['name'] ?? 'Unnamed Metric' }}:</strong> 
                                {{ $metric['value'] ?? 'No Value Provided' }}
                            </li>
                        @endforeach
                    </td>
     
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center mt-4">
        <p class="text-sm text-gray-500">Rows per page: <span class="font-semibold">6</span></p>
        <p class="text-sm text-gray-500">6-10 of 240</p>
        <div class="flex space-x-2">
            <button class="px-2 py-1 bg-gray-200 text-gray-500 rounded hover:bg-gray-300">&lt;</button>
            <button class="px-2 py-1 bg-gray-200 text-gray-500 rounded hover:bg-gray-300">&gt;</button>
        </div>
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