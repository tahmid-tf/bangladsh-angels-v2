@extends('layouts.guest')
@section('page_title', 'Resources | Bangladesh Angels Network Limited')
@section('page_content')
@php
    $brochureUrl = asset('MoU.pdf');
    $resourceCards = [
        [
            'title' => 'Angel Academy',
            'one_liner' => 'Structured investor education for people who want to back early-stage companies with confidence.',
            'shadow' => 'bg-[#36b37e]/20',
            'surface' => 'from-white via-[#f7fdf9] to-[#eefaf4]',
            'border' => 'border-green-100/90',
            'cta' => 'Book a call with us to know more',
            'cta_url' => 'mailto:hello@bdangels.co?subject=Angel%20Academy%20%E2%80%94%20call%20request',
            'cta_external' => false,
            'footnote' => null,
        ],
        [
            'title' => 'BWIN',
            'one_liner' => 'Bangladesh Women Investors Network — our sister chapter growing women investors and gender-lens deal flow.',
            'shadow' => 'bg-[#18736a]/18',
            'surface' => 'from-white via-[#f3faf8] to-[#e6f4f0]',
            'border' => 'border-[#18736a]/20',
            'cta' => 'Fill up this form to join us',
            'cta_url' => 'mailto:hello@bdangels.co?subject=BWIN%20%E2%80%94%20join%20form%20request',
            'cta_external' => false,
            'footnote' => 'We will email you the Google Form link.',
        ],
        [
            'title' => 'DeckVue',
            'one_liner' => 'AI-assisted deck feedback so founders can sharpen their story before investors see it.',
            'shadow' => 'bg-[#0f3d34]/15',
            'surface' => 'from-white via-[#f4faf7] to-[#e8f5ef]',
            'border' => 'border-[#0f3d34]/15',
            'cta' => 'Click here to know more',
            'cta_url' => 'https://deckvue.ai',
            'cta_external' => true,
            'footnote' => 'Opens deckvue.ai in a new tab.',
        ],
    ];
@endphp

<section class="w-full max-w-5xl mx-auto px-4 sm:px-6 py-10 md:py-14">
    <header class="mb-10 md:mb-14">
        <h1 class="text-3xl md:text-4xl font-bold text-[#0f3d34] tracking-tight">Resources</h1>
        <p class="mt-3 text-gray-600 max-w-2xl leading-relaxed">
            Programs and tools we work with to support angels and founders across the network.
        </p>
    </header>

    <div class="flex flex-col gap-12 md:gap-16">
        @foreach ($resourceCards as $card)
            <div class="relative">
                <div class="absolute inset-0 translate-x-2 translate-y-2 rounded-3xl {{ $card['shadow'] }}" aria-hidden="true"></div>
                <article class="relative overflow-hidden rounded-3xl border {{ $card['border'] }} bg-gradient-to-br {{ $card['surface'] }} shadow-md">
                    <div class="flex flex-col lg:flex-row lg:items-center gap-8 lg:gap-10 p-8 md:p-10">
                        <div class="lg:flex-1 text-center lg:text-left min-w-0">
                            <h2 class="text-2xl md:text-3xl font-bold text-[#0f3d34]">{{ $card['title'] }}</h2>
                            <p class="mt-2 text-sm md:text-base text-gray-600 leading-relaxed">{{ $card['one_liner'] }}</p>
                        </div>
                        <div class="flex justify-center shrink-0">
                            <div class="h-28 w-28 md:h-32 md:w-32 rounded-full bg-white/95 border-2 border-[#36b37e]/25 shadow-inner flex items-center justify-center text-xs font-medium text-gray-400 tracking-wide" aria-hidden="true">
                                Logo
                            </div>
                        </div>
                        <div class="flex flex-col items-center lg:items-end gap-2 shrink-0 w-full lg:w-auto">
                            <a href="{{ $card['cta_url'] }}"
                               @if (! empty($card['cta_external'])) target="_blank" rel="noopener noreferrer" @endif
                               class="inline-flex items-center justify-center gap-2 rounded-full bg-[#0f3d34] px-6 py-3 text-sm md:text-base font-semibold text-white shadow-sm hover:bg-[#156755] transition-colors w-full sm:w-auto">
                                <span>{{ $card['cta'] }}</span>
                                <span aria-hidden="true">→</span>
                            </a>
                            @if (! empty($card['footnote']))
                                <p class="text-xs text-[#18736a] text-center lg:text-right max-w-xs">{{ $card['footnote'] }}</p>
                            @endif
                        </div>
                    </div>
                </article>
                <p class="mt-4 text-center">
                    <a href="{{ $brochureUrl }}" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold text-[#36b37e] hover:text-[#18736a] underline underline-offset-4">
                        Click here to see our brochure
                    </a>
                </p>
            </div>
        @endforeach
    </div>
</section>
@endsection
