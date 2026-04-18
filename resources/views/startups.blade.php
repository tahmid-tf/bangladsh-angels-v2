@extends('layouts.guest')
@section('page_title', 'Startups | Bangladesh Angels Network Limited')
@section('page_content')
@php
    $brochureUrl = asset('MoU.pdf');
    $shadowClasses = [
        'bg-[#36b37e]/22',
        'bg-[#18736a]/18',
        'bg-[#0f3d34]/14',
    ];
    $surfaceClasses = [
        'from-white via-[#f7fdf9] to-[#eefaf4] border-green-100/90',
        'from-white via-[#f3faf8] to-[#e6f4f0] border-[#18736a]/25',
        'from-white via-[#f4faf7] to-[#e8f5ef] border-[#0f3d34]/18',
    ];
@endphp
<div class="w-full max-w-6xl mx-auto px-4 sm:px-6 py-10 md:py-14">

    <header class="mb-10 md:mb-12 text-center md:text-left">
        <h1 class="text-3xl md:text-4xl font-bold text-[#0f3d34]">Startups</h1>
        <p class="mt-3 text-gray-600 text-[0.95em] md:text-lg max-w-3xl mx-auto md:mx-0 leading-relaxed">
            Discover member-only active deals, send your pitch, explore BAN services for founders, and browse companies we have backed.
        </p>
    </header>

    {{-- Active deals (paywalled) --}}
    <section id="active-deals" class="scroll-mt-32 mb-16 md:mb-20 pb-16 border-b border-green-100/80" aria-labelledby="active-deals-heading">
        <h2 id="active-deals-heading" class="text-xl md:text-2xl font-bold text-[#0f3d34] mb-2">Active deals</h2>
        <p class="text-gray-600 mb-8 max-w-2xl">Live investment opportunities for approved members on a paid plan.</p>

        @if ($canViewActiveDeals)
            <p class="text-sm text-gray-600 mb-6">
                For invest, commit, and review categories, use the
                <a href="{{ route('deals') }}" class="font-semibold text-[#18736a] hover:underline">full deals workspace</a>.
            </p>
            @if ($activeDeals->isEmpty())
                <div class="rounded-2xl border border-green-100/80 bg-white/90 px-8 py-10 text-center shadow-sm text-gray-600" role="status">
                    There are no active deals listed right now. Check back soon.
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach ($activeDeals as $deal)
                        <x-portfolio-showcase-card :deal="$deal" />
                    @endforeach
                </div>
            @endif
        @else
            <div class="relative overflow-hidden rounded-3xl border border-green-100/80 bg-gradient-to-br from-emerald-50/90 to-white min-h-[260px] sm:min-h-[280px]">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-6 p-6 md:p-8 blur-md opacity-[0.55] pointer-events-none select-none" aria-hidden="true">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="rounded-xl bg-white shadow-md overflow-hidden border border-gray-100">
                            <div class="aspect-[16/9] bg-gradient-to-br from-emerald-200/90 to-emerald-700/50"></div>
                            <div class="p-4 space-y-3">
                                <div class="h-5 w-3/4 max-w-[12rem] rounded-md bg-gray-200"></div>
                                <div class="h-3 w-full rounded bg-gray-100"></div>
                                <div class="h-3 w-11/12 rounded bg-gray-100"></div>
                                <div class="flex gap-3 pt-2">
                                    <div class="h-9 flex-1 rounded-lg bg-emerald-100/80"></div>
                                    <div class="h-9 w-20 rounded-lg bg-gray-100"></div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                <a href="{{ route('plans') }}"
                   class="absolute inset-0 z-10 flex flex-col items-center justify-center gap-2 bg-white/25 backdrop-blur-[3px] px-5 text-center transition hover:bg-white/35 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#0f3d34]">
                    <span class="text-lg md:text-2xl font-bold text-[#0f3d34]">Click to unlock active deals</span>
                    <span class="text-sm md:text-base text-[#0f3d34]/85 max-w-md leading-relaxed">Membership packages unlock full deal details and the investor workspace.</span>
                    <span class="mt-3 inline-flex items-center rounded-full bg-[#0f3d34] px-6 py-2.5 text-sm font-semibold text-white shadow-md">View membership packages</span>
                </a>
            </div>
        @endif
    </section>

    {{-- Send us your pitch --}}
    <section id="send-pitch" class="scroll-mt-32 mb-16 md:mb-20 pb-16 border-b border-green-100/80" aria-labelledby="pitch-heading">
        <h2 id="pitch-heading" class="text-xl md:text-2xl font-bold text-[#0f3d34] mb-2">Send us your pitch</h2>
        <p class="text-gray-600 mb-8 max-w-2xl">Share a one-line summary and your deck in PDF format. Our team will review submissions and follow up where there is a fit.</p>

        @if (session('pitch_submitted'))
            <div class="mb-8 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-900 text-sm font-medium" role="status">
                Thank you—your pitch was submitted successfully.
            </div>
        @endif

        <form method="post" action="{{ route('startups.pitch') }}" enctype="multipart/form-data" class="max-w-xl rounded-2xl border border-green-100/80 bg-white/90 p-6 md:p-8 shadow-sm space-y-6">
            @csrf
            <div>
                <label for="contact_email" class="block text-sm font-semibold text-[#0f3d34] mb-1">Contact email</label>
                <input type="email" name="contact_email" id="contact_email" required value="{{ old('contact_email', auth()->user()->email ?? '') }}"
                    class="w-full rounded-lg border border-gray-200 px-3 py-2 text-gray-900 shadow-sm focus:border-[#36b37e] focus:ring-[#36b37e]"
                    autocomplete="email">
                @error('contact_email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="one_line" class="block text-sm font-semibold text-[#0f3d34] mb-1">One-line description of your startup</label>
                <input type="text" name="one_line" id="one_line" required maxlength="280" value="{{ old('one_line') }}"
                    placeholder="e.g. AI-powered logistics visibility for SMEs in South Asia"
                    class="w-full rounded-lg border border-gray-200 px-3 py-2 text-gray-900 shadow-sm focus:border-[#36b37e] focus:ring-[#36b37e]">
                @error('one_line')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="pitch_deck" class="block text-sm font-semibold text-[#0f3d34] mb-1">Pitch deck (PDF only, max 12&nbsp;MB)</label>
                <input type="file" name="pitch_deck" id="pitch_deck" required accept="application/pdf,.pdf"
                    class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-[#eefff1] file:px-4 file:py-2 file:font-semibold file:text-[#36b37e] hover:file:bg-[#dff7e8]">
                @error('pitch_deck')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full sm:w-auto inline-flex justify-center px-8 py-3 rounded-full bg-[#36b37e] font-bold text-white hover:opacity-90 transition-opacity">
                Submit pitch
            </button>
        </form>
    </section>

    {{-- Our services (admin-managed, resources-style cards) --}}
    <section id="our-services" class="scroll-mt-32 mb-16 md:mb-20 pb-16 border-b border-green-100/80" aria-labelledby="services-heading">
        <h2 id="services-heading" class="text-xl md:text-2xl font-bold text-[#0f3d34] mb-2">Our services</h2>
        <p class="text-gray-600 mb-8 max-w-2xl">BAN offers structured support for founders through dedicated service lines. Packages and scope can be tailored after an initial conversation.</p>

        @if ($startupServices->isEmpty())
            <p class="rounded-xl border border-green-100/80 bg-white px-5 py-6 text-sm text-gray-600 shadow-sm max-w-2xl" role="status">
                Service listings are not configured yet. Please check back later.
            </p>
        @else
            <div class="flex flex-col gap-10 md:gap-12">
                @foreach ($startupServices as $svc)
                    @php
                        $i = $loop->index % 3;
                        $isExternal = str_starts_with(strtolower(trim($svc->link)), 'http');
                    @endphp
                    <div class="relative">
                        <div class="absolute inset-0 translate-x-2 translate-y-2 rounded-3xl {{ $shadowClasses[$i] }}" aria-hidden="true"></div>
                        <article class="relative overflow-hidden rounded-3xl border bg-gradient-to-br {{ $surfaceClasses[$i] }} shadow-md">
                            <div class="flex flex-col lg:flex-row lg:items-center gap-8 lg:gap-10 p-8 md:p-10">
                                <div class="lg:flex-1 text-center lg:text-left min-w-0">
                                    <h3 class="text-2xl md:text-3xl font-bold text-[#0f3d34]">{{ $svc->title }}</h3>
                                    <p class="mt-2 text-sm md:text-base text-gray-600 leading-relaxed">{{ $svc->intro }}</p>
                                    @if ($svc->bulletList() !== [])
                                        <ul class="mt-5 space-y-2 text-sm text-gray-700 list-disc list-inside text-left max-w-xl mx-auto lg:mx-0">
                                            @foreach ($svc->bulletList() as $bullet)
                                                <li>{{ $bullet }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    @if (filled($svc->footer_note))
                                        <p class="mt-5 text-xs text-gray-500">{{ $svc->footer_note }}</p>
                                    @endif
                                </div>
                                <div class="flex justify-center shrink-0">
                                    <div class="h-28 w-28 md:h-32 md:w-32 shrink-0 overflow-hidden rounded-full border-2 border-white shadow-md ring-2 ring-[#36b37e]/20 bg-gray-50">
                                        @if ($svc->logoUrl())
                                            <img src="{{ $svc->logoUrl() }}" alt="" class="h-full w-full object-cover object-center">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[#36b37e]/15 to-[#0f3d34]/10 text-lg font-bold text-[#0f3d34]/60 tracking-wide" aria-hidden="true">
                                                {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(preg_replace('/\s+/', '', $svc->title), 0, 2)) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex flex-col items-center lg:items-end shrink-0 w-full lg:w-auto">
                                    <a href="{{ $svc->link }}"
                                       @if ($isExternal) target="_blank" rel="noopener noreferrer" @endif
                                       class="inline-flex items-center justify-center gap-2 rounded-full bg-[#0f3d34] px-6 py-3 text-sm md:text-base font-semibold text-white shadow-sm hover:bg-[#156755] transition-colors w-full sm:w-auto">
                                        <span>{{ $svc->cta_label }}</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                        @if ($svc->show_brochure_link)
                            <p class="mt-4 text-center">
                                <a href="{{ $brochureUrl }}" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold text-[#36b37e] hover:text-[#18736a] underline underline-offset-4">
                                    Click here to see our brochure
                                </a>
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    {{-- Portfolio (public) --}}
    <section id="portfolio-companies" class="scroll-mt-32 bg-white" aria-labelledby="portfolio-heading">
        <div class="mb-10 md:mb-12 text-center">
            <p class="inline-flex items-center justify-center gap-2 text-base md:text-lg font-semibold text-[#0f6a4b] mb-3">
                <span aria-hidden="true">✽</span>
                <span>What we do</span>
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
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach ($portfolioDeals as $deal)
                    <x-portfolio-showcase-card :deal="$deal" :hide-amount-seeking="true" />
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection
