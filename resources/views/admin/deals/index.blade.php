@extends('layouts.admin')
@section('page_title','Deals | Dashboard')
@section('page_content')
<section class="container mx-auto p-6">
    <!-- Header -->
    <header class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Deals</h1>
            <p class="text-gray-500">Dashboard &gt; Deals</p>
        </div>
        <a class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">
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
                    <th class="px-4 py-2 text-center text-gray-600 font-semibold">Growth Traction</th>
                    <th class="px-4 py-2 text-center text-gray-600 font-semibold">Impact Metrics</th>
                    <th class="px-4 py-2 text-center text-gray-600 font-semibold">Future Plans</th>
                </tr>
            </thead>
            <tbody>
                <!-- Row 1 -->
                <tr class="border-t">
                    <td class="px-4 py-2 flex items-center space-x-4">
                        <img src="https://via.placeholder.com/40" alt="Jatri Logo" class="rounded-full">
                        <div>
                            <p class="font-semibold">Jatri</p>
                            <p class="text-sm text-gray-500">Transport</p>
                        </div>
                    </td>
                    <td class="px-4 py-2">Pre Seed</td>
                    <td class="px-4 py-2">$1,244,322</td>
                    <td class="px-4 py-2">One-stop travel solution for Car Rental, online Bus & Launch Tickets.</td>
                    <td class="px-4 py-2 text-center">
                        <input type="checkbox" class="toggle-checkbox" checked>
                    </td>
                    <td class="px-4 py-2 text-center">
                        <input type="checkbox" class="toggle-checkbox" checked>
                    </td>
                    <td class="px-4 py-2 text-center">
                        <input type="checkbox" class="toggle-checkbox">
                    </td>
                    <td class="px-4 py-2 text-center">
                        <input type="checkbox" class="toggle-checkbox">
                    </td>
                </tr>

                <!-- Repeat Rows as Needed -->
                <tr class="border-t">
                    <td class="px-4 py-2 flex items-center space-x-4">
                        <img src="https://via.placeholder.com/40" alt="Hishabee Logo" class="rounded-full">
                        <div>
                            <p class="font-semibold">Hishabee</p>
                            <p class="text-sm text-gray-500">Fintech</p>
                        </div>
                    </td>
                    <td class="px-4 py-2">Series A</td>
                    <td class="px-4 py-2">$1,036,648</td>
                    <td class="px-4 py-2">Empowering small businesses to access embedded financial services.</td>
                    <td class="px-4 py-2 text-center">
                        <input type="checkbox" class="toggle-checkbox" checked>
                    </td>
                    <td class="px-4 py-2 text-center">
                        <input type="checkbox" class="toggle-checkbox">
                    </td>
                    <td class="px-4 py-2 text-center">
                        <input type="checkbox" class="toggle-checkbox">
                    </td>
                    <td class="px-4 py-2 text-center">
                        <input type="checkbox" class="toggle-checkbox" checked>
                    </td>
                </tr>
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