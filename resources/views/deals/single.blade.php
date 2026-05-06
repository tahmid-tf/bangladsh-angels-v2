@extends('layouts.investor')
@section('page_title','Deals | Bangladesh Angels Network Limited')
@section('page_content')
@php
    $memberDealLinks = auth()->check() && auth()->user() && !auth()->user()->isFree();
@endphp
<section class="bg-[#0a5554] py-12 rounded-3xl border-box w-[95%]">
    @if ($errors->any())
        <div class="mx-6 mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-800 shadow-sm">
            <p class="font-bold">Whoops! Something went wrong.</p>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('error'))
        <div class="mx-6 mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-800 shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="mx-6 mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-900 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mx-auto px-6 lg:flex lg:items-center text-white">
        <div class="lg:w-full">
            <h1 class="text-4xl font-extrabold mb-4">{{ $deal->title }}</h1>
            <p class="text-lg mb-6 text-white/95">
                {{ $deal->description }}
            </p>
            <div class="flex flex-wrap items-center gap-8 mb-6">
                @if ($deal->investment_stage)
                    <div>
                        <p class="text-sm text-white/80">Investment Stage</p>
                        <p class="text-lg font-semibold">{{ $deal->investment_stage }}</p>
                    </div>
                @endif
                @if ($deal->amount_seeking)
                    <div>
                        <p class="text-sm text-white/80">Amount Seeking</p>
                        <p class="text-lg font-semibold">$ {{ $deal->amountSeeking() }}</p>
                    </div>
                @endif
            </div>
            <div class="flex flex-wrap items-center gap-3 mb-6">
                @if (filled($deal->commit_link))
                    <a href="{{ $memberDealLinks ? $deal->commit_link : route('plans') }}"
                       @if ($memberDealLinks) target="_blank" rel="noopener noreferrer" @endif
                       class="inline-flex h-11 items-center justify-center rounded-full bg-[#36b37e] px-5 text-sm font-bold text-white shadow-md transition-colors hover:bg-[#2f9e6f]">
                        Commit Link
                    </a>
                @endif
                <a href="{{ $memberDealLinks ? $deal->pitch_deck_url : route('plans')}}"
                   @if ($memberDealLinks && $deal->pitch_deck_url) target="_blank" rel="noopener noreferrer" @endif
                   class="inline-flex h-11 items-center justify-center rounded-full bg-gray-200 px-5 text-sm font-semibold text-gray-800 shadow hover:bg-gray-300">
                    View
                </a>
                @if ($deal->substack_link)
                    <a href="{{ $memberDealLinks ? $deal->substack_link : route('plans')}}"
                       @if ($memberDealLinks) target="_blank" rel="noopener noreferrer" @endif
                       class="inline-flex h-11 items-center justify-center rounded-full bg-gray-200 px-5 text-sm font-semibold text-gray-800 shadow hover:bg-gray-300">
                        View on Substack
                    </a>
                @endif
            </div>
            @if ($deal->type !== 'review' && $deal->groupchat_invite_link && auth()->check())
                <form action="{{ route('deal.invest', $deal->id) }}" method="POST" class="mt-6 max-w-md">
                    @csrf
                    <input type="text" hidden name="user_id" value="{{ auth()->user()->id }}">
                    <input type="text" hidden name="deal_id" value="{{ $deal->id }}">
                    <input type="text" hidden name="type" value="review">
                    <button type="submit" class="inline-flex h-11 w-full cursor-pointer items-center justify-center rounded-full bg-[#36b37e] px-6 text-sm font-bold text-white shadow-md transition-colors hover:bg-[#2f9e6f]">
                        Join WhatsApp Group
                    </button>
                </form>
            @endif
            @if ($deal->type !== 'portfolio' && auth()->check())
                <div class="mt-6 max-w-md">
                    <livewire:deal-action-button :deal="$deal" />
                </div>
            @endif
        </div>

        <div class="lg:w-1/2 mt-6 lg:mt-0 lg:pl-8">
            <img src="{{ $deal->getCoverUrl() }}" alt="{{ $deal->title }}" class="w-full h-auto rounded-lg shadow-md ring-1 ring-white/10">
        </div>
    </div>
</section>

<!-- Company Bio Section -->
<section class="container mx-auto px-6 py-12">
    <h2 class="text-2xl md:text-3xl font-bold mb-4 text-[#0f3d34]">Company Bio</h2>
    <p class="text-gray-700 leading-relaxed">
        {{$deal->description}}
    </p>
</section>
@if ($deal->hasKeyMetric())
    <section class="container mx-auto px-6 py-12">
        <h2 class="text-2xl md:text-3xl font-bold mb-8 text-center text-[#0f3d34]">Key Metrics</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($deal->getKeyMetrics() as $metric)
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-lg font-bold mb-3 text-gray-900">{{ $metric['name'] }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    {{ $metric['value'] }}
                </p>
            </div>
            @empty
            <div class="col-span-full text-center text-gray-500">
                <p>No Key Metrics available for this deal.</p>
            </div>
            @endforelse
        </div>
    </section>    
@endif


@if (count($otherDeals)>0)
    <!-- More Live Deals Section -->
    <section class="container mx-auto px-6 py-12">
        @if (auth()->check() && auth()->user() && auth()->user()->isFree())
            <h2 class="text-2xl md:text-3xl font-bold mb-8 text-[#0f3d34]">More Portfolios</h2>
        @else
            <h2 class="text-2xl md:text-3xl font-bold mb-8 text-[#0f3d34]">More Live Deals</h2>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($otherDeals as $otherDeal)
                <livewire:deal-card :deal="$otherDeal"></livewire:deal-card>
            @empty
                
            @endforelse
            
        </div>
    </section>
@endif

@endsection