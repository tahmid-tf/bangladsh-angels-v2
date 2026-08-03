<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bangladesh Angels Network connects exceptional early-stage founders with investors, expertise, and a global community.">
    <link rel="canonical" href="{{ route('home') }}">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Bangladesh Angels Network">
    <meta property="og:title" content="Bangladesh Angels Network | Capital, community and conviction">
    <meta property="og:description" content="Bangladesh's leading angel-investor network, backing ambitious founders with capital, expertise, and long-term support.">
    <meta property="og:url" content="{{ route('home') }}">
    <meta property="og:image" content="{{ url(asset('og.png')) }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bangladesh Angels Network | Capital, community and conviction">
    <meta name="twitter:description" content="Join Bangladesh's leading angel-investor community.">
    <meta name="twitter:image" content="{{ url(asset('og.png')) }}">
    <title>Bangladesh Angels Network | Capital, community and conviction</title>
    <link rel="icon" type="image/webp" href="{{ asset('icon.webp') }}">
    <link rel="preload" href="{{ asset('landing.png') }}" as="image">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <livewire:styles />
</head>

<body class="ban-home ban-home-v2">
    <livewire:navigation-bar></livewire:navigation-bar>

    <main>
        <section id="join" class="ban2-hero" aria-labelledby="ban2-hero-heading">
            <div class="ban2-shell ban2-hero__grid">
                <div class="ban2-hero__copy">
                    <p class="ban2-kicker">Bangladesh Angels Network</p>
                    <h1 id="ban2-hero-heading">Join BAN</h1>
                    <p class="ban2-hero__lede">
                        Bangladesh's first and largest angel-investment platform brings together investors, operators,
                        and entrepreneurs to build the country's next generation of enduring companies.
                    </p>
                    <div class="ban2-actions">
                        <a href="{{ route('investor.signup') }}" class="ban2-button ban2-button--primary">Join BAN</a>
                        <a href="#pitch-form" class="ban2-button ban2-button--secondary">Pitch your startup</a>
                    </div>
                    <div class="ban2-hero__proof" aria-label="BAN at a glance">
                        <div><strong>500+</strong><span>angel investors</span></div>
                        <div><strong>$12M+</strong><span>capital facilitated</span></div>
                        <div><strong>51</strong><span>portfolio companies</span></div>
                    </div>
                </div>

                <div class="ban2-hero__visual" aria-label="Bangladesh Angels investor community">
                    <div class="ban2-hero__visual-frame">
                        <div class="ban2-hero__visual-topline" aria-hidden="true">
                            <span>The BAN network</span>
                            <span>Established 2019</span>
                        </div>
                        <img src="{{ asset('landing.png') }}" alt="Members of the Bangladesh Angels investor community" width="620" height="465" loading="eager">
                    </div>
                    <p><span aria-hidden="true"></span> Investing across Bangladesh and beyond</p>
                </div>
            </div>
        </section>

        <section id="core-functions" class="ban2-section ban2-functions" aria-labelledby="ban2-functions-heading">
            <div class="ban2-shell">
                <header class="ban2-section-heading ban2-section-heading--split">
                    <div>
                        <p class="ban2-kicker">Core BAN functions</p>
                        <h2 id="ban2-functions-heading">From first conversation to long-term partnership.</h2>
                    </div>
                    <p>
                        BAN builds the connective tissue around early-stage investment. We prepare promising founders,
                        equip investors to make informed decisions, coordinate the transaction, and stay engaged after
                        the cheque is written.
                    </p>
                </header>

                <div class="ban2-functions__grid">
                    <article>
                        <span>01</span>
                        <h3>Source &amp; screen</h3>
                        <p>We identify technology-enabled startups with committed teams, early traction, and the potential to scale.</p>
                    </article>
                    <article>
                        <span>02</span>
                        <h3>Prepare founders</h3>
                        <p>We sharpen the narrative, pitch deck, data room, and fundraising strategy before a company meets members.</p>
                    </article>
                    <article>
                        <span>03</span>
                        <h3>Coordinate investment</h3>
                        <p>We convene interested angels, organise diligence, align terms, and support the documentation process.</p>
                    </article>
                    <article>
                        <span>04</span>
                        <h3>Support growth</h3>
                        <p>Our network contributes operating experience, introductions, governance support, and follow-on perspective.</p>
                    </article>
                </div>
            </div>
        </section>

        <section id="programs" class="ban2-section ban2-programs" aria-labelledby="ban2-programs-heading">
            <div class="ban2-shell">
                <header class="ban2-section-heading">
                    <p class="ban2-kicker">Our programs</p>
                    <h2 id="ban2-programs-heading">Three focused platforms. One stronger ecosystem.</h2>
                    <p>Explore the initiatives BAN has built to broaden participation, strengthen investment practice, and make startup evaluation more effective.</p>
                </header>

                <div class="ban2-programs__grid">
                    <a href="{{ route('bwin') }}" class="ban2-program-card ban2-program-card--bwin" aria-label="Learn more about BWIN">
                        <div class="ban2-program-card__mark">
                            <img src="{{ asset('bwin.png') }}" alt="BWIN — Bangladesh Women Investors Network" width="570" height="181" loading="lazy">
                        </div>
                        <div>
                            <p>Women-led investment</p>
                            <h3>BWIN</h3>
                            <span>Building a more diverse pipeline of investors and entrepreneurs across Bangladesh.</span>
                        </div>
                        <strong>Explore BWIN <span aria-hidden="true">↗</span></strong>
                    </a>

                    <a href="{{ route('angel-academy') }}" class="ban2-program-card ban2-program-card--academy" aria-label="Learn more about Angel Academy">
                        <div class="ban2-program-card__monogram" aria-hidden="true">AA</div>
                        <div>
                            <p>Investor education</p>
                            <h3>Angel Academy</h3>
                            <span>Practical learning for aspiring and active angels—from first principles to investment committee.</span>
                        </div>
                        <strong>Visit Angel Academy <span aria-hidden="true">↗</span></strong>
                    </a>

                    <a href="{{ route('resources') }}" class="ban2-program-card ban2-program-card--deckvue" aria-label="Learn more about DeckVue">
                        <div class="ban2-program-card__monogram" aria-hidden="true">DV</div>
                        <div>
                            <p>AI-powered diligence</p>
                            <h3>DeckVue</h3>
                            <span>Turn pitch decks into structured, verified investment intelligence in minutes.</span>
                        </div>
                        <strong>Open DeckVue <span aria-hidden="true">↗</span></strong>
                    </a>
                </div>
            </div>
        </section>

        <section id="featured-startups" class="ban2-section ban2-startups" aria-labelledby="ban2-startups-heading">
            <div class="ban2-shell">
                <header class="ban2-section-heading ban2-section-heading--action">
                    <div>
                        <p class="ban2-kicker">Featured startups</p>
                        <h2 id="ban2-startups-heading">The companies in the room right now.</h2>
                        <p>Meet a selection of founders currently engaging the BAN network.</p>
                    </div>
                    <a href="{{ route('startups') }}" class="ban2-text-link">View all startups <span aria-hidden="true">→</span></a>
                </header>

                @if ($featuredStartups->isEmpty())
                    <div class="ban2-empty" role="status">New startup opportunities will be featured here soon.</div>
                @else
                    <div class="ban2-startups__grid">
                        @foreach ($featuredStartups as $startup)
                            <article class="ban2-startup-card">
                                <div class="ban2-startup-card__logo">
                                    <img src="{{ $startup->getLogoUrl() }}" alt="{{ $startup->title }} logo" loading="lazy">
                                </div>
                                <div class="ban2-startup-card__meta">
                                    <span>{{ $startup->investment_stage ?: 'Early stage' }}</span>
                                    <span>{{ $startup->sector ?: 'Technology' }}</span>
                                </div>
                                <h3>{{ $startup->title }}</h3>
                                <p>{{ \Illuminate\Support\Str::limit(strip_tags((string) $startup->description), 120, '…') }}</p>
                                <a href="{{ route('startups') }}">Explore opportunity <span aria-hidden="true">→</span></a>
                            </article>
                        @endforeach
                    </div>
                @endif

                <div id="pitch-form" class="ban2-pitch" aria-labelledby="ban2-pitch-heading">
                    <div class="ban2-pitch__copy">
                        <p class="ban2-kicker">For founders</p>
                        <h2 id="ban2-pitch-heading">Think your startup belongs here?</h2>
                        <p>Send a concise one-line summary and an investor-ready PDF deck. We review each submission and follow up when there is a potential fit.</p>
                        <ul>
                            <li><span>01</span>Tell us what you are building</li>
                            <li><span>02</span>Share your pitch deck</li>
                            <li><span>03</span>Our team reviews for fit</li>
                        </ul>
                    </div>

                    <div class="ban2-pitch__form-card">
                        @if (session('pitch_submitted'))
                            <div class="ban2-form-success" role="status"><strong>Pitch received.</strong> Thank you—our team will review your submission.</div>
                        @endif

                        <form method="post" action="{{ route('home.pitch') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="ban2-field">
                                <label for="home_contact_email">Contact email</label>
                                <input type="email" name="contact_email" id="home_contact_email" required value="{{ old('contact_email', auth()->user()->email ?? '') }}" autocomplete="email" placeholder="founder@startup.com" @error('contact_email') aria-invalid="true" aria-describedby="home-contact-email-error" @enderror>
                                @error('contact_email')<p id="home-contact-email-error" class="ban2-field__error">{{ $message }}</p>@enderror
                            </div>
                            <div class="ban2-field">
                                <label for="home_one_line">One-line description of your startup</label>
                                <input type="text" name="one_line" id="home_one_line" required maxlength="280" value="{{ old('one_line') }}" placeholder="What do you build, and for whom?" @error('one_line') aria-invalid="true" aria-describedby="home-one-line-error" @enderror>
                                @error('one_line')<p id="home-one-line-error" class="ban2-field__error">{{ $message }}</p>@enderror
                            </div>
                            <div class="ban2-field">
                                <label for="home_pitch_deck">Pitch deck <span>PDF, maximum 12 MB</span></label>
                                <label for="home_pitch_deck" class="ban2-file-field">
                                    <strong>Choose PDF</strong>
                                    <span id="home_pitch_deck_name" aria-live="polite">No file selected</span>
                                </label>
                                <input class="ban2-file-input" type="file" name="pitch_deck" id="home_pitch_deck" required accept="application/pdf,.pdf" @error('pitch_deck') aria-invalid="true" aria-describedby="home-pitch-deck-error" @enderror>
                                @error('pitch_deck')<p id="home-pitch-deck-error" class="ban2-field__error">{{ $message }}</p>@enderror
                            </div>
                            <button type="submit" class="ban2-button ban2-button--light">Submit pitch <span aria-hidden="true">→</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section id="portfolio" class="ban2-section ban2-portfolio" aria-labelledby="ban2-portfolio-heading">
            <div class="ban2-shell">
                <header class="ban2-section-heading ban2-section-heading--action">
                    <div>
                        <p class="ban2-kicker">Portfolio</p>
                        <h2 id="ban2-portfolio-heading">Backed by BAN. Built to endure.</h2>
                        <p>A selection of the companies our investor community has supported.</p>
                    </div>
                    <a href="{{ route('portfolio') }}" class="ban2-text-link">See the full portfolio <span aria-hidden="true">→</span></a>
                </header>

                @if ($portfolioDeals->isEmpty())
                    <div class="ban2-empty" role="status">Published portfolio companies will appear here soon.</div>
                @else
                    <div class="ban2-portfolio__grid">
                        @foreach ($portfolioDeals as $company)
                            <a href="{{ route('portfolio') }}" class="ban2-portfolio-card" aria-label="View {{ $company->title }} in the BAN portfolio">
                                <img src="{{ $company->getLogoUrl() }}" alt="{{ $company->title }} logo" loading="lazy">
                                <div>
                                    <h3>{{ $company->title }}</h3>
                                    <p>{{ $company->sector ?: 'Portfolio company' }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section id="team" class="ban2-section ban2-team" aria-labelledby="ban2-team-heading">
            <div class="ban2-shell">
                <header class="ban2-team__heading">
                    <h2 id="ban2-team-heading">Our Team</h2>
                    <p>Meet the team behind Bangladesh Angels Network, connecting founders, investors, and partners across the entrepreneurial ecosystem.</p>
                </header>

                @if ($teamMembers->isEmpty())
                    <div class="ban2-empty" role="status">Team profiles will appear here soon.</div>
                @else
                    <div class="ban2-team__marquee" aria-label="Bangladesh Angels Network team members">
                        <div class="ban2-team__track">
                            @foreach ([false, true] as $duplicate)
                                <div class="ban2-team__group" @if ($duplicate) aria-hidden="true" @endif>
                                    @foreach ($teamMembers as $member)
                                        <article class="ban2-team-profile">
                                            <div class="ban2-team-profile__photo">
                                                @if ($member->photoUrl())
                                                    <img src="{{ $member->photoUrl() }}" alt="{{ $duplicate ? '' : $member->name }}" loading="lazy">
                                                @else
                                                    <span aria-hidden="true">{{ collect(explode(' ', $member->name))->map(fn ($part) => mb_substr($part, 0, 1))->take(2)->implode('') }}</span>
                                                @endif
                                            </div>
                                            <div class="ban2-team-profile__copy">
                                                <h3>{{ $member->name }}</h3>
                                                <p>{{ $member->title }}</p>
                                                <span>Bangladesh Angels Network</span>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="ban2-team__link-wrap">
                    <a href="{{ route('team') }}" class="ban2-text-link">Meet the full team <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </section>

        <section id="our-partners" class="ban2-section ban2-partners" aria-labelledby="ban2-partners-heading">
            <div class="ban2-shell">
                <header class="ban2-section-heading ban2-section-heading--split">
                    <div>
                        <p class="ban2-kicker">Our partners</p>
                        <h2 id="ban2-partners-heading">A stronger ecosystem is built together.</h2>
                    </div>
                    <p>We collaborate with leading institutions, investment firms, and ecosystem builders to co-invest in high-potential startups and guide founders with meaningful industry expertise.</p>
                </header>

                <div class="ban2-partners__groups">
                    <section class="ban2-partner-group" aria-labelledby="ban2-founding-partners-heading">
                        <header class="ban2-partner-group__heading">
                            <span>01</span>
                            <h3 id="ban2-founding-partners-heading">Founding Partners</h3>
                        </header>
                        <div class="ban2-partner-grid ban2-partner-grid--founding">
                            <a href="https://www.government.nl/ministries/ministry-of-foreign-affairs" target="_blank" rel="noopener noreferrer" class="ban2-partner-card" aria-label="Visit the Netherlands Ministry of Foreign Affairs website">
                                <img src="{{ asset('foreignaffairsnetherland.webp') }}" alt="Netherlands Ministry of Foreign Affairs" width="500" height="203" loading="lazy">
                                <span aria-hidden="true">↗</span>
                            </a>
                            <a href="https://aavishkaarcapital.in/" target="_blank" rel="noopener noreferrer" class="ban2-partner-card" aria-label="Visit the Aavishkaar Capital website">
                                <img src="{{ asset('capital logo.webp') }}" alt="Aavishkaar Capital" width="455" height="192" loading="lazy">
                                <span aria-hidden="true">↗</span>
                            </a>
                        </div>
                    </section>

                    <section class="ban2-partner-group" aria-labelledby="ban2-industry-partners-heading">
                        <header class="ban2-partner-group__heading">
                            <span>02</span>
                            <h3 id="ban2-industry-partners-heading">Industry Partners</h3>
                        </header>
                        <div class="ban2-partner-grid ban2-partner-grid--industry">
                            <a href="https://bida.gov.bd/" target="_blank" rel="noopener noreferrer" class="ban2-partner-card" aria-label="Visit the BIDA website">
                                <img src="{{ asset('bidalogo.webp') }}" alt="Bangladesh Investment Development Authority (BIDA)" width="310" height="255" loading="lazy">
                                <span aria-hidden="true">↗</span>
                            </a>
                            <a href="https://venture.com.bd/" target="_blank" rel="noopener noreferrer" class="ban2-partner-card" aria-label="Visit the Bangladesh Venture Capital website">
                                <img src="{{ asset('bangladesh venture capital.webp') }}" alt="Bangladesh Venture Capital" width="624" height="190" loading="lazy">
                                <span aria-hidden="true">↗</span>
                            </a>
                            <a href="https://lightcastlepartners.com/" target="_blank" rel="noopener noreferrer" class="ban2-partner-card" aria-label="Visit the LightCastle Partners website">
                                <img src="{{ asset('lcp.svg') }}" alt="LightCastle Partners" width="150" height="80" loading="lazy">
                                <span aria-hidden="true">↗</span>
                            </a>
                        </div>
                    </section>
                </div>
            </div>
        </section>

        <section id="faq" class="ban2-section ban2-faq" aria-labelledby="ban2-faq-heading">
            <div class="ban2-shell ban2-faq__layout">
                <header class="ban2-section-heading">
                    <p class="ban2-kicker">FAQ</p>
                    <h2 id="ban2-faq-heading">Questions, answered clearly.</h2>
                    <p>Start with the essentials about BAN, early-stage investing, and how transactions are coordinated.</p>
                    <a href="{{ route('faq') }}" class="ban2-text-link">Browse every question <span aria-hidden="true">→</span></a>
                </header>

                <div class="ban2-faq__list">
                    @foreach ($faqs as $faq)
                        <details class="ban2-faq-item">
                            <summary><span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>{{ $faq['question'] }}<i aria-hidden="true"></i></summary>
                            <div class="ban2-faq-item__answer">
                                @foreach ($faq['paragraphs'] as $paragraph)<p>{{ $paragraph }}</p>@endforeach
                                @isset($faq['bullets'])
                                    <ul>@foreach ($faq['bullets'] as $bullet)<li>{{ $bullet }}</li>@endforeach</ul>
                                @endisset
                                @isset($faq['note'])<p class="ban2-faq-item__note">{{ $faq['note'] }}</p>@endisset
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>

            <div class="ban2-shell">
                <div class="ban2-contact-prompt">
                    <p>Can’t find what you’re looking for?</p>
                    <a href="mailto:hello@bdangels.co">Contact us <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </section>
    </main>

    <livewire:footer></livewire:footer>
    <livewire:scripts />

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('home_pitch_deck');
            const fileName = document.getElementById('home_pitch_deck_name');
            if (input && fileName) {
                input.addEventListener('change', function () {
                    fileName.textContent = input.files && input.files[0] ? input.files[0].name : 'No file selected';
                });
            }

            const statusCode = new URLSearchParams(window.location.search).get('status_code');
            if (statusCode === '2') {
                window.location.replace('{{ auth()->check() ? route('dashboard') : route('login') }}');
            }
        });
    </script>
</body>

</html>
