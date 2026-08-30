@extends('layouts.admin')
@section('page_title', 'Investments | Dashboard')
@section('page_content')
<section class="container mx-auto p-4 md:p-6">
    <div class="bg-white rounded-xl shadow p-4 md:p-5 mb-5">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
            <div>
                <h1 class="text-lg md:text-xl font-bold text-gray-900">Investments Index</h1>
                <p class="text-sm text-gray-600 mt-1">Search and filter deal-level investment activity without overwhelming long lists.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <div class="text-sm text-gray-600">
                    Showing <span class="font-semibold text-gray-900">{{ $deals->count() }}</span> of
                    <span class="font-semibold text-gray-900">{{ $deals->total() }}</span> deals
                </div>
                <a href="{{ route('deal.add') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 whitespace-nowrap">
                    + Add New Deal
                </a>
            </div>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.investments') }}" class="bg-white rounded-xl shadow p-4 md:p-5 mb-5">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-3">
            <div class="xl:col-span-2">
                <label for="q" class="block text-xs font-semibold text-gray-600 mb-1">Search</label>
                <input
                    id="q"
                    name="q"
                    type="text"
                    value="{{ $filters['q'] }}"
                    placeholder="Deal title, sector, investor name/email"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200 focus:border-green-500"
                />
            </div>

            <div>
                <label for="type" class="block text-xs font-semibold text-gray-600 mb-1">Activity</label>
                <select id="type" name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:ring focus:ring-green-200 focus:border-green-500">
                    <option value="">All</option>
                    <option value="interested" @selected($filters['type'] === 'interested')>Interested (express interest)</option>
                    <option value="invest" @selected($filters['type'] === 'invest')>Invest (investment record)</option>
                    <option value="commit" @selected($filters['type'] === 'commit')>Recorded commitments</option>
                    <option value="review" @selected($filters['type'] === 'review')>WhatsApp / review signal</option>
                </select>
            </div>

            <div>
                <label for="status" class="block text-xs font-semibold text-gray-600 mb-1">Deal status</label>
                <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:ring focus:ring-green-200 focus:border-green-500">
                    <option value="">All</option>
                    @foreach ($availableStatuses as $status)
                        <option value="{{ $status }}" @selected($filters['status'] === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="stage" class="block text-xs font-semibold text-gray-600 mb-1">Stage</label>
                <select id="stage" name="stage" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:ring focus:ring-green-200 focus:border-green-500">
                    <option value="">All</option>
                    @foreach ($availableStages as $stage)
                        <option value="{{ $stage }}" @selected($filters['stage'] === $stage)>{{ ucfirst($stage) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="sort" class="block text-xs font-semibold text-gray-600 mb-1">Sort</label>
                <select id="sort" name="sort" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:ring focus:ring-green-200 focus:border-green-500">
                    <option value="latest_activity" @selected($filters['sort'] === 'latest_activity')>Latest activity</option>
                    <option value="most_investments" @selected($filters['sort'] === 'most_investments')>Most member activity</option>
                    <option value="title_asc" @selected($filters['sort'] === 'title_asc')>Title A-Z</option>
                    <option value="title_desc" @selected($filters['sort'] === 'title_desc')>Title Z-A</option>
                </select>
            </div>
        </div>

        <div class="mt-4 flex flex-wrap gap-2">
            <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-[#0a5554] text-white text-sm font-semibold hover:bg-[#084646]">
                Apply filters
            </button>
            <a href="{{ route('admin.investments') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm font-semibold hover:bg-gray-200">
                Reset
            </a>
        </div>
    </form>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto max-h-[68vh] overflow-y-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">
                    <tr>
                        <th class="px-4 py-3 font-semibold text-gray-700">Deal</th>
                        <th class="px-4 py-3 font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-3 font-semibold text-gray-700">Stage</th>
                        <th class="px-4 py-3 font-semibold text-gray-700">Amount Seeking</th>
                        <th class="px-4 py-3 font-semibold text-gray-700">Member activity</th>
                        <th class="px-4 py-3 font-semibold text-gray-700">Last Activity</th>
                        <th class="px-4 py-3 font-semibold text-gray-700 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($deals as $deal)
                        <tr class="hover:bg-gray-50/80 align-top">
                            <td class="px-4 py-3 min-w-[260px]">
                                <div class="flex items-start gap-3">
                                    <img src="{{ $deal->getLogoUrl() }}" alt="{{ $deal->title }} logo" class="w-10 h-10 rounded-full object-cover mt-1">
                                    <div>
                                        <a href="{{ route('deal.view', $deal) }}" class="font-semibold text-[#0a5554] hover:underline">
                                            {{ $deal->title }}
                                        </a>
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $deal->sector ?: 'Unspecified sector' }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ \Illuminate\Support\Str::limit($deal->description, 90) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                @php
                                    $statusClasses = [
                                        'active' => 'bg-green-100 text-green-700',
                                        'closed' => 'bg-red-100 text-red-700',
                                        'draft' => 'bg-gray-100 text-gray-700',
                                    ];
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $statusClasses[$deal->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($deal->status ?? 'unknown') }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-700 whitespace-nowrap">{{ ucfirst($deal->investment_stage ?? 'N/A') }}</td>
                            <td class="px-4 py-3 text-gray-800 whitespace-nowrap">
                                {{ $deal->amount_seeking ? '$'.number_format($deal->amount_seeking, 2) : 'N/A' }}
                            </td>
                            <td class="px-4 py-3 min-w-[240px]">
                                @php
                                    $activityTotal = $deal->interested_count + $deal->invest_count + $deal->review_count + $deal->commit_count;
                                @endphp
                                <p class="font-semibold text-gray-900">{{ $activityTotal }} total</p>
                                <p class="text-xs text-gray-600 mt-1">
                                    Interested: {{ $deal->interested_count }} |
                                    Invest: {{ $deal->invest_count }} |
                                    Committed: {{ $deal->commit_count }} |
                                    Review: {{ $deal->review_count }}
                                </p>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-gray-600">
                                @php
                                    $dates = array_filter([$deal->investments_max_created_at ?? null, $deal->commits_max_created_at ?? null]);
                                    $latest = count($dates) ? max($dates) : null;
                                @endphp
                                {{ $latest ? \Carbon\Carbon::parse($latest)->diffForHumans() : 'No activity yet' }}
                            </td>
                            <td class="px-4 py-3 text-right whitespace-nowrap min-w-[220px]">
                                <div class="admin-investment-actions">
                                    <a href="{{ route('deal.view', $deal) }}" class="admin-investment-action admin-investment-action--primary" title="Public deal page">
                                        View
                                    </a>
                                    <a href="{{ route('admin.deals.member-activity', $deal) }}" class="admin-investment-action admin-investment-action--activity" title="Admin-only member breakdown (interested, invest, review, commits)" aria-label="View member activity for {{ $deal->title }}">
                                        Activity
                                    </a>
                                    <a href="{{ route('edit.deal', $deal->id) }}" class="admin-investment-action admin-investment-action--edit">
                                        Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-600">
                                No investment results matched these filters.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-t border-gray-100 bg-gray-50">
            {{ $deals->links() }}
        </div>
    </div>
</section>
@endsection
