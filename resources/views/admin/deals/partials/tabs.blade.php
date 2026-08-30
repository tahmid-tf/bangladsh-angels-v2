@php
    $activeDealTab = $activeDealTab ?? 'all';
    $dealTabs = [
        ['all', route('admin.deals'), 'All'],
        ['invest', route('admin.deals.invest'), 'Invest'],
        ['commit', route('admin.deals.commit'), 'Commit'],
        ['review', route('admin.deals.review'), 'Review'],
        ['portfolio', route('admin.deals.portfolio'), 'Portfolio'],
        ['invest-portfolio', route('admin.deals.invest-portfolio'), 'Investment &amp; Portfolio'],
    ];
@endphp

<div class="flex flex-wrap items-center gap-4">
    <div class="flex flex-wrap gap-2">
        @foreach ($dealTabs as [$key, $url, $label])
            <a href="{{ $url }}" class="px-4 py-2 {{ $activeDealTab === $key ? 'bg-green-100 text-green-700' : 'text-gray-600 hover:bg-gray-200' }} rounded-full">{!! $label !!}</a>
        @endforeach
    </div>
</div>
