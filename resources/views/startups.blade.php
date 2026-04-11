@extends('layouts.guest')
@section('page_title', 'Startups | Bangladesh Angels Network Limited')
@section('page_content')
<div class="w-full max-w-6xl mx-auto px-4 sm:px-6 py-10 md:py-14">

    <header class="mb-10 md:mb-12 text-center md:text-left">
        <h1 class="text-3xl md:text-4xl font-bold text-[#0f3d34]">Startups</h1>
        <p class="mt-3 text-gray-600 text-[0.95em] md:text-lg max-w-3xl mx-auto md:mx-0 leading-relaxed">
            Explore our portfolio, discover member-only active deals, pitch your company, and learn how BAN supports founders.
        </p>
    </header>

    {{-- Portfolio (public) --}}
    <section id="portfolio-companies" class="scroll-mt-32 mb-16 md:mb-20 pb-16 border-b border-green-100/80" aria-labelledby="portfolio-heading">
        <h2 id="portfolio-heading" class="text-xl md:text-2xl font-bold text-[#0f3d34] mb-2">Portfolio companies</h2>
        <p class="text-gray-600 mb-8 max-w-2xl">Companies BAN has backed.</p>

        @if ($portfolioDeals->isEmpty())
            <div class="mx-auto max-w-lg rounded-2xl border border-green-100/80 bg-white/90 px-8 py-10 text-center shadow-sm" role="status">
                <p class="text-lg font-semibold text-[#0f3d34]">No portfolio companies yet</p>
                <p class="mt-3 text-gray-600 leading-relaxed text-sm">We have not published portfolio listings here yet. Please check back later.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($portfolioDeals as $deal)
                    <livewire:deal-card :deal="$deal"></livewire:deal-card>
                @endforeach
            </div>
        @endif
    </section>

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
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($activeDeals as $deal)
                        <livewire:deal-card :deal="$deal"></livewire:deal-card>
                    @endforeach
                </div>
            @endif
        @else
            <div class="relative overflow-hidden rounded-2xl border border-green-100/80 bg-gradient-to-br from-green-50/90 to-white p-8 md:p-12 shadow-sm">
                <div class="absolute inset-0 pointer-events-none bg-white/40 backdrop-blur-[2px]" aria-hidden="true"></div>
                <div class="relative max-w-xl mx-auto text-center">
                    <p class="inline-flex items-center gap-2 rounded-full bg-[#0f3d34]/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-[#0f3d34]">Members only</p>
                    <h3 class="mt-4 text-lg md:text-xl font-bold text-[#0f3d34]">Unlock active deals</h3>
                    <p class="mt-3 text-gray-600 leading-relaxed text-sm md:text-base">
                        Active deal listings are available to approved members with a paid subscription, consistent with the rest of the platform.
                    </p>
                    <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                        @guest
                            <a href="{{ route('login') }}" class="inline-flex justify-center px-6 py-3 rounded-full bg-[#36b37e] font-bold text-white hover:opacity-90 transition-opacity">Log in</a>
                            <a href="{{ route('plans') }}" class="inline-flex justify-center px-6 py-3 rounded-full bg-[#eefff1] font-bold text-[#36b37e] border border-green-200 hover:bg-[#dff7e8] transition-colors">View plans</a>
                        @else
                            @if (! auth()->user()->hasVerifiedEmail())
                                <p class="text-sm text-gray-600 sm:col-span-2">Please verify your email address to continue with membership and deal access.</p>
                                <a href="{{ route('verification.notice') }}" class="inline-flex justify-center px-6 py-3 rounded-full bg-[#36b37e] font-bold text-white hover:opacity-90 transition-opacity">Email verification</a>
                            @elseif (! auth()->user()->is_approved)
                                <p class="text-sm text-gray-600 sm:col-span-2">Your profile is pending approval. We will notify you when you can access member areas.</p>
                                <a href="{{ route('approval.pending') }}" class="inline-flex justify-center px-6 py-3 rounded-full bg-[#36b37e] font-bold text-white hover:opacity-90 transition-opacity">Approval status</a>
                            @elseif (auth()->user()->isFree())
                                <a href="{{ route('plans') }}" class="inline-flex justify-center px-6 py-3 rounded-full bg-[#36b37e] font-bold text-white hover:opacity-90 transition-opacity">Upgrade to unlock</a>
                                <a href="{{ route('upgrade.page') }}" class="inline-flex justify-center px-6 py-3 rounded-full bg-[#eefff1] font-bold text-[#36b37e] border border-green-200 hover:bg-[#dff7e8] transition-colors">Why upgrade?</a>
                            @else
                                <p class="text-sm text-gray-600">Your account does not currently have access to this section.</p>
                            @endif
                        @endguest
                    </div>
                </div>
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

    {{-- Our services --}}
    <section id="our-services" class="scroll-mt-32" aria-labelledby="services-heading">
        <h2 id="services-heading" class="text-xl md:text-2xl font-bold text-[#0f3d34] mb-2">Our services</h2>
        <p class="text-gray-600 mb-8 max-w-2xl">BAN offers structured support for founders through dedicated service lines. Packages and scope can be tailored after an initial conversation.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            <article class="rounded-2xl border border-green-100/80 bg-white/90 p-6 md:p-8 shadow-sm flex flex-col h-full">
                <h3 class="text-lg font-bold text-[#36b37e]">Founder services</h3>
                <p class="mt-3 text-gray-600 text-sm leading-relaxed">Hands-on help as you prepare to fundraise and scale: narrative, materials, and investor conversations.</p>
                <ul class="mt-5 space-y-2 text-sm text-gray-700 list-disc list-inside flex-1">
                    <li>Fundraising narrative and positioning</li>
                    <li>Deck review and storytelling for investor meetings</li>
                    <li>Monthly showcase and pitch preparation</li>
                    <li>Office hours with operators and angels in the network</li>
                </ul>
                <p class="mt-6 text-xs text-gray-500">Delivered as scoped packages; contact BAN for availability and pricing.</p>
            </article>
            <article class="rounded-2xl border border-green-100/80 bg-white/90 p-6 md:p-8 shadow-sm flex flex-col h-full">
                <h3 class="text-lg font-bold text-[#36b37e]">Legal services</h3>
                <p class="mt-3 text-gray-600 text-sm leading-relaxed">Practical legal support for early-stage structures and transactions, coordinated with qualified counsel where required.</p>
                <ul class="mt-5 space-y-2 text-sm text-gray-700 list-disc list-inside flex-1">
                    <li>Company formation and cap table hygiene</li>
                    <li>Founders agreements and employment basics</li>
                    <li>Term sheet and SAFE / convertible note review</li>
                    <li>Regulatory and compliance orientation for your sector</li>
                </ul>
                <p class="mt-6 text-xs text-gray-500">Not legal advice as law firm representation; BAN can introduce counsel and structured legal packages.</p>
            </article>
        </div>
    </section>
</div>
@endsection
