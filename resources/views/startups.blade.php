@extends('layouts.guest')
@section('page_title', 'Startups | Bangladesh Angels Network Limited')

@push('head_meta')
    <x-seo-meta
        title="Startups | Bangladesh Angels Network Limited"
        description="Explore BAN member-only active deals, founder pitch submissions, tailored services, and how Bangladesh Angels backs early-stage startups."
        :canonical="route('startups')"
        :image="asset('icon.webp')"
    />
@endpush

@section('page_content')
<main class="ban-subpage ban-startups-page">
    <section class="ban-listing-hero ban-listing-hero--startups" aria-labelledby="ban-startups-title">
        <div class="ban-page-shell">
            <div class="ban-listing-hero__grid">
                <div class="ban-listing-hero__copy">
                    <p class="ban-page-kicker">For founders</p>
                    <h1 id="ban-startups-title">Built for founders ready to move.</h1>
                </div>

                <div class="ban-listing-hero__summary">
                    <p>Discover live investment opportunities, share your pitch, and access focused support designed to help promising companies become investment-ready.</p>
                </div>
            </div>

            <nav class="ban-listing-hero__nav" aria-label="Startups page sections">
                <a href="#active-deals">Active deals <span aria-hidden="true">&darr;</span></a>
                <a href="#send-pitch">Send your pitch <span aria-hidden="true">&darr;</span></a>
                <a href="#our-services">Our services <span aria-hidden="true">&darr;</span></a>
            </nav>
        </div>
    </section>

    <div class="ban-page-shell ban-startups-page__content">

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
                <div class="ban2-startups__grid">
                    @foreach ($activeDeals as $deal)
                        @php
                            $dealHref = $deal->type === 'review' && filled($deal->groupchat_invite_link)
                                ? $deal->groupchat_invite_link
                                : route('deal.view', $deal);
                        @endphp
                        <x-ban-startup-card
                            :startup="$deal"
                            :href="$dealHref"
                            :show-investment-details="true"
                            class="ban2-startup-card--listing"
                        />
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
    <section id="send-pitch" class="ban-startup-pitch scroll-mt-32" aria-labelledby="pitch-heading">
        <div class="ban-startup-pitch__copy">
            <p class="ban-page-kicker">For founders</p>
            <h2 id="pitch-heading">Send us your pitch</h2>
            <p>Share a sharp one-line summary and an investor-ready PDF deck. Our team reviews every submission and follows up when there is a potential fit.</p>

            <ol class="ban-startup-pitch__steps" aria-label="Pitch review process">
                <li><span>01</span><strong>Make the opportunity clear</strong></li>
                <li><span>02</span><strong>Attach your investor deck</strong></li>
                <li><span>03</span><strong>Our team reviews for fit</strong></li>
            </ol>
        </div>

        <div class="ban-startup-pitch__form-wrap">
            @if (session('pitch_submitted'))
                <div class="ban-startup-pitch__success" role="status">
                    Thank you—your pitch was submitted successfully.
                </div>
            @endif

            <form method="post" action="{{ route('startups.pitch') }}" enctype="multipart/form-data" class="ban-startup-pitch__form">
                @csrf
                <div class="ban-startup-pitch__field">
                    <label for="contact_email">Contact email</label>
                    <input type="email" name="contact_email" id="contact_email" required value="{{ old('contact_email', auth()->user()->email ?? '') }}" autocomplete="email" placeholder="founder@company.com">
                    @error('contact_email')
                        <p class="ban-startup-pitch__error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="ban-startup-pitch__field">
                    <label for="one_line">One-line description of your startup</label>
                    <input type="text" name="one_line" id="one_line" required maxlength="280" value="{{ old('one_line') }}" placeholder="e.g. AI-powered logistics visibility for SMEs in South Asia">
                    @error('one_line')
                        <p class="ban-startup-pitch__error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="ban-startup-pitch__field">
                    <label for="pitch_deck">Pitch deck <span>PDF only · Maximum 12 MB</span></label>
                    <input type="file" name="pitch_deck" id="pitch_deck" required accept="application/pdf,.pdf">
                    @error('pitch_deck')
                        <p class="ban-startup-pitch__error">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="ban-startup-pitch__submit">Submit pitch <span aria-hidden="true">→</span></button>
            </form>
        </div>
    </section>

    {{-- Our services (admin-managed, resources-style cards) --}}
    <section id="our-services" class="ban-startup-services scroll-mt-32" aria-labelledby="services-heading">
        <header class="ban-startup-services__heading">
            <div>
                <p class="ban-page-kicker">Founder support</p>
                <h2 id="services-heading">Our services</h2>
            </div>
            <p>BAN offers structured support through dedicated service lines. Packages and scope are tailored after an initial conversation.</p>
        </header>

        @if ($startupServices->isEmpty())
            <p class="ban-startup-services__empty" role="status">
                Service listings are not configured yet. Please check back later.
            </p>
        @else
            <div class="ban-startup-services__grid">
                @foreach ($startupServices as $svc)
                    @php
                        $isExternal = str_starts_with(strtolower(trim($svc->link)), 'http');
                    @endphp
                    <article class="ban-startup-service-card">
                        <div class="ban-startup-service-card__topline">
                            <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="ban-startup-service-card__logo">
                                @if ($svc->logoUrl())
                                    <img src="{{ $svc->logoUrl() }}" alt="" loading="lazy">
                                @else
                                    <span aria-hidden="true">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(preg_replace('/\s+/', '', $svc->title), 0, 2)) }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="ban-startup-service-card__content">
                            <h3>{{ $svc->title }}</h3>
                            <p>{{ $svc->intro }}</p>
                            @if ($svc->bulletList() !== [])
                                <ul>
                                    @foreach ($svc->bulletList() as $bullet)
                                        <li><span aria-hidden="true"></span>{{ $bullet }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            @if (filled($svc->footer_note))
                                <p class="ban-startup-service-card__note">{{ $svc->footer_note }}</p>
                            @endif
                        </div>

                        <footer class="ban-startup-service-card__footer">
                            <a href="{{ $svc->link }}" @if ($isExternal) target="_blank" rel="noopener noreferrer" @endif>
                                {{ $svc->cta_label }} <span aria-hidden="true">→</span>
                            </a>
                            @if ($svc->show_brochure_link)
                                <a href="{{ $svc->brochurePublicHref() }}" target="_blank" rel="noopener noreferrer" class="ban-startup-service-card__brochure">
                                    View brochure <span aria-hidden="true">↗</span>
                                </a>
                            @endif
                        </footer>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    </div>
</main>
@endsection
