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
<main class="ban-subpage ban-portfolio-page">
    <section class="ban-listing-hero ban-listing-hero--portfolio" aria-labelledby="ban-portfolio-title">
        <div class="ban-page-shell">
            <div class="ban-listing-hero__grid">
                <div class="ban-listing-hero__copy">
                    <p class="ban-page-kicker">BAN portfolio</p>
                    <h1 id="ban-portfolio-title">Backed by BAN. Built to endure.</h1>
                </div>

                <div class="ban-listing-hero__summary">
                    <p>Meet the companies our network has backed&mdash;ambitious teams building practical solutions with the potential to scale.</p>
                </div>
            </div>

            <nav class="ban-listing-hero__nav" aria-label="Portfolio page links">
                <a href="#portfolio-companies">Portfolio companies <span aria-hidden="true">&darr;</span></a>
                <a href="{{ route('startups') }}#send-pitch">Pitch your startup <span aria-hidden="true">&nearr;</span></a>
            </nav>
        </div>
    </section>

    <div class="ban-page-shell ban-portfolio-page__content">
        <section id="portfolio-companies" class="ban-portfolio-listing scroll-mt-32" aria-labelledby="portfolio-heading">
            <header class="ban-portfolio-listing__heading">
                <div>
                    <p class="ban-page-kicker">Companies we back</p>
                    <h2 id="portfolio-heading">Our portfolio</h2>
                </div>
                <p>Founders applying technology, insight, and conviction to meaningful opportunities in Bangladesh and beyond.</p>
            </header>

            @if ($portfolioDeals->isEmpty())
                <div class="mx-auto max-w-lg rounded-2xl border border-green-100/80 bg-white px-8 py-10 text-center shadow-sm" role="status">
                    <p class="text-lg font-semibold text-[#0f3d34]">No portfolio companies yet</p>
                    <p class="mt-3 text-gray-600 leading-relaxed text-sm">We have not published portfolio listings here yet. Please check back later.</p>
                </div>
            @else
                <div class="ban2-portfolio__grid">
                    @foreach ($portfolioDeals as $company)
                        <x-ban-portfolio-card :company="$company" :href="route('deal.view', $company)" />
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</main>
@endsection
