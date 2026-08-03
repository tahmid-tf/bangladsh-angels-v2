@extends('layouts.guest')
@section('page_title', 'Portfolio | Bangladesh Angels Network Limited')

@push('head_meta')
    <x-seo-meta
        title="Portfolio | Bangladesh Angels Network Limited"
        description="Explore BAN portfolio companies and discover the companies Bangladesh Angels has backed."
        :canonical="route('portfolio')"
        :image="asset('icon.webp')"
    />
@endpush

@section('page_content')
<div class="w-full max-w-6xl mx-auto px-4 sm:px-6 py-10 md:py-14">
    <header class="mb-10 md:mb-12 text-center md:text-left">
        <h1 class="text-3xl md:text-4xl font-bold text-[#0f3d34]">Portfolio</h1>
        <p class="mt-3 text-gray-600 text-[0.95em] md:text-lg max-w-3xl mx-auto md:mx-0 leading-relaxed">
            Discover the companies BAN has backed.
        </p>
    </header>

    <section id="portfolio-companies" class="scroll-mt-32 bg-white" aria-labelledby="portfolio-heading">
        <div class="mb-10 md:mb-12 text-center">
            <p class="inline-flex items-center justify-center gap-2 text-base md:text-lg font-semibold text-[#0f6a4b] mb-3">
                <span aria-hidden="true">*</span>
                <span>Portfolio</span>
            </p>
            <h2 id="portfolio-heading" class="text-3xl md:text-4xl font-bold text-[#0f3d34] tracking-tight">Our Portfolio</h2>
            <p class="mt-3 text-gray-600 max-w-2xl mx-auto leading-relaxed">Companies BAN has backed.</p>
        </div>

        @if ($portfolioDeals->isEmpty())
            <div class="mx-auto max-w-lg rounded-2xl border border-green-100/80 bg-white px-8 py-10 text-center shadow-sm" role="status">
                <p class="text-lg font-semibold text-[#0f3d34]">No portfolio companies yet</p>
                <p class="mt-3 text-gray-600 leading-relaxed text-sm">We have not published portfolio listings here yet. Please check back later.</p>
            </div>
        @else
            <div class="ban2-startups__grid">
                @foreach ($portfolioDeals as $deal)
                    <x-ban-startup-card
                        :startup="$deal"
                        :href="route('deal.view', $deal)"
                        link-label="View company"
                        :show-investment-details="true"
                        class="ban2-startup-card--listing"
                    />
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection
