@extends('layouts.admin')
@section('page_title', 'Investors Investments | Dashboard')
@section('page_content')
<section class="container mx-auto p-4 md:p-6">
    <div class="bg-white rounded-xl shadow p-4 md:p-5 mb-5">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
            <div>
                <h1 class="text-lg md:text-xl font-bold text-gray-900">Investors Investments</h1>
                <p class="text-sm text-gray-600 mt-1">Manage completed investments linked to existing investors and startups.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <div class="text-sm text-gray-600">Showing <span class="font-semibold text-gray-900">{{ $investments->count() }}</span> of <span class="font-semibold text-gray-900">{{ $investments->total() }}</span> records</div>
                <a href="{{ route('admin.investor-investments.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 whitespace-nowrap">+ Record Investment</a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div role="status" class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-5">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-5">
        <div class="bg-white rounded-xl shadow p-4">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Investment records</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalRecords) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Investors</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalInvestors) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Value by currency</p>
            <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1">
                @forelse ($currencyTotals as $total)
                    <span class="text-base font-bold text-gray-900">{{ $total->currency }} {{ number_format((float) $total->total, 2) }}</span>
                @empty
                    <span class="text-sm text-gray-500">No value recorded</span>
                @endforelse
            </div>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.investor-investments.index') }}" class="bg-white rounded-xl shadow p-4 md:p-5 mb-5">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-3">
            <div class="xl:col-span-2">
                <label for="q" class="block text-xs font-semibold text-gray-600 mb-1">Search</label>
                <input id="q" name="q" type="text" value="{{ $filters['q'] ?? '' }}" placeholder="Investor name, email, or startup" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200 focus:border-green-500">
            </div>
            <div>
                <label for="currency_filter" class="block text-xs font-semibold text-gray-600 mb-1">Currency</label>
                <select id="currency_filter" name="currency" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:ring focus:ring-green-200 focus:border-green-500">
                    <option value="">All currencies</option>
                    @foreach ($availableCurrencies as $currency)
                        <option value="{{ $currency }}" @selected(($filters['currency'] ?? '') === $currency)>{{ $currency }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="from" class="block text-xs font-semibold text-gray-600 mb-1">Completed from</label>
                <input id="from" type="date" name="from" value="{{ $filters['from'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200 focus:border-green-500">
            </div>
            <div>
                <label for="to" class="block text-xs font-semibold text-gray-600 mb-1">Completed to</label>
                <input id="to" type="date" name="to" value="{{ $filters['to'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200 focus:border-green-500">
            </div>
        </div>
        <div class="mt-4 flex flex-wrap gap-2">
            <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-[#0a5554] text-white text-sm font-semibold hover:bg-[#084646]">Apply filters</button>
            <a href="{{ route('admin.investor-investments.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm font-semibold hover:bg-gray-200">Reset</a>
        </div>
    </form>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto max-h-[68vh] overflow-y-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">
                    <tr>
                        <th class="px-4 py-3 font-semibold text-gray-700">Investor</th>
                        <th class="px-4 py-3 font-semibold text-gray-700">Startup</th>
                        <th class="px-4 py-3 font-semibold text-gray-700">Amount</th>
                        <th class="px-4 py-3 font-semibold text-gray-700">Completed</th>
                        <th class="px-4 py-3 font-semibold text-gray-700 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($investments as $investment)
                        <tr class="hover:bg-gray-50/80">
                            <td class="px-4 py-3 min-w-[240px]">
                                <a href="{{ route('admin.investor-investments.show', $investment) }}" class="font-semibold text-[#0a5554] hover:underline">{{ $investment->investor_name }}</a>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $investment->investor_email }}</p>
                            </td>
                            <td class="px-4 py-3 font-semibold text-gray-700 min-w-[180px]">{{ $investment->startup_name }}</td>
                            <td class="px-4 py-3 font-semibold text-gray-900 whitespace-nowrap">{{ $investment->formattedAmount() }}</td>
                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap">{{ $investment->completed_at->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-right whitespace-nowrap min-w-[220px]">
                                <div class="admin-investment-actions">
                                    <a href="{{ route('admin.investor-investments.show', $investment) }}" class="admin-investment-action admin-investment-action--primary">View</a>
                                    <a href="{{ route('admin.investor-investments.edit', $investment) }}" class="admin-investment-action admin-investment-action--edit">Edit</a>
                                    <form method="POST" action="{{ route('admin.investor-investments.destroy', $investment) }}" onsubmit="return confirm('Delete this investment record? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="admin-investment-action text-red-600 border border-red-200 bg-red-50 hover:bg-red-100">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-8 text-center text-gray-600">No completed investments matched these filters.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-t border-gray-100 bg-gray-50">{{ $investments->links() }}</div>
    </div>
</section>
@endsection
