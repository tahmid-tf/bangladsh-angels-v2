<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Bangladesh's first and largest angel investment platform connecting early-stage startups with investors.">
    <link rel="canonical" href="{{ route('home') }}">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Bangladesh Angels Network Limited">
    <meta property="og:title" content="Bangladesh Angels Network Limited">
    <meta property="og:description" content="Bangladesh's first and largest angel investment platform connecting early-stage startups with investors.">
    <meta property="og:url" content="{{ route('home') }}">
    <meta property="og:image" content="{{ url(asset('landing.png')) }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bangladesh Angels Network Limited">
    <meta name="twitter:description" content="Bangladesh's first and largest angel investment platform connecting early-stage startups with investors.">
    <meta name="twitter:image" content="{{ url(asset('landing.png')) }}">
    <title>Bangladesh Angels Network Limited</title>
    <link rel="icon" type="image/webp" href="{{asset('icon.webp')}}">
    <!-- Preload critical resources -->
    <link rel="preload" href="{{asset('world_map_4x.webp')}}" as="image">
    <link rel="preload" href="{{asset('landing.png')}}" as="image">
    <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800&display=swap" rel="stylesheet">
    
    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    
    @vite('resources/css/app.css')
    <livewire:styles />
    
    <style>
        body { margin: 0; padding: 0; }

        #loading-screen {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f4ed;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
            z-index: 9999;
        }

        #loading-screen.fade-out {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .loading-icon {
            height: clamp(4rem, 9vw, 7rem);
            width: auto;
            object-fit: contain;
            animation: loading-pulse 1.25s ease-in-out infinite alternate;
        }

        @keyframes loading-pulse { to { opacity: 0.58; transform: scale(0.96); } }
    </style>
</head>

<body class="ban-home">
  <!-- Loading Screen -->
  <div id="loading-screen">
    <img src="{{ asset('icon.webp') }}" alt="Bangladesh Angels Logo" class="loading-icon">
  </div>

  {{-- Navigation --}}
  <livewire:navigation-bar></livewire:navigation-bar>
  
  <main class="w-full">
  <section class="ban-hero" style="--ban-map-image: url('{{ asset('world_map_4x.webp') }}');">
    <div class="ban-hero__inner">
        <div class="ban-hero__visual">
            <img src="{{ asset('landing.png') }}" alt="coverphoto" draggable="false" width="620" height="465" loading="eager">
        </div>
        <div class="ban-hero__copy">
            <h1>
                Join BAN
            </h1>
            <p>
                Bangladesh's first and largest angel investment platform, BAN connects early-stage startups with investors who bring capital, expertise, and a global network. We back founders solving real challenges, turning ambition into action.
            </p>
            <div class="ban-hero__actions">
                <a href="{{ route('investor.signup') }}"
                   class="ban-primary-cta"
                   title="Apply to become an angel investor with Bangladesh Angels Network">
                    Become an Investor
                </a>
                <div class="ban-intent" aria-label="I'm looking to fundraise or invest">
                    <p>I'm looking to</p>
                    <div class="ban-intent__options">
                        <a href="{{ route('startups').'#send-pitch' }}">
                            Fundraise
                        </a>
                        <a href="{{ route('investor.signup') }}"
                           title="Apply to invest with Bangladesh Angels Network">
                            Invest
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>

  <section id="ban-impact" class="ban-impact" aria-labelledby="ban-impact-heading">
    <div class="ban-impact__intro">
      <h2 id="ban-impact-heading">
        From 2019 to today
      </h2>
      <p>
        Bangladesh Angels Network (BAN), since its inception in 2019, has facilitated investments amounting to $12M across 51 portfolio companies, including Pathao, Chaldal, Shajgoj, Chhaya, PulseTech, etc. BAN has a global investor network with 500+ angel investors.
      </p>
    </div>

    <div id="ban-stats" class="ban-stats-grid">
      <div class="ban-stat-card">
        <p>
          <span class="ban-stat-value" data-ban-stat="500">0</span><span class="ban-stat-suffix" aria-hidden="true">+</span>
        </p>
        <p>Angel Investors</p>
      </div>
      <div class="ban-stat-card">
        <p>
          <span class="ban-stat-prefix" aria-hidden="true">$</span><span class="ban-stat-value" data-ban-stat="12">0</span><span class="ban-stat-suffix" aria-hidden="true">m+</span>
        </p>
        <p>Invested</p>
      </div>
      <div class="ban-stat-card">
        <p>
          <span class="ban-stat-value" data-ban-stat="51">0</span>
        </p>
        <p>Startups Funded</p>
      </div>
      <div class="ban-stat-card">
        <p>
          <span class="ban-stat-value" data-ban-stat="84">0</span>
        </p>
        <p>Deals executed</p>
      </div>
      <div class="ban-stat-card">
        <p>
          <span class="ban-stat-value" data-ban-stat="6">0</span>
        </p>
        <p>Years of investing</p>
      </div>
    </div>
  </section>

  <section id="what-we-do" class="ban-content-section ban-what-we-do" aria-labelledby="what-we-do-heading">
    <div class="ban-content-section__inner ban-what-we-do__layout">
      <header class="ban-what-we-do__intro">
        <span class="ban-what-we-do__eyebrow">How we create value</span>
        <h2 id="what-we-do-heading">What We Do</h2>
        <p>
          Focused platforms that turn investor knowledge, founder access, and meaningful connections into real opportunities.
        </p>
      </header>

      <div class="ban-what-we-do__index">
        @forelse ($whatWeDoCards as $card)
          @php
            $learnMoreLabel = filled($card->learn_more_label) ? $card->learn_more_label : 'Learn more';
            $learnMoreLink = filled($card->learn_more_link) ? $card->learn_more_link : $card->cta_link;
            if (! filled($learnMoreLink) && $card->slug === 'angel-academy') {
              $learnMoreLink = '/angel-academy';
            } elseif (! filled($learnMoreLink) && $card->slug === 'bwin') {
              $learnMoreLink = '/deckvue#bwin';
            }
            $fallbackActionLabel = $card->slug === 'angel-academy' ? 'Book a demo' : ($card->slug === 'bwin' ? 'Book a call' : null);
            $fallbackActionLink = in_array($card->slug, ['angel-academy', 'bwin'], true)
              ? 'https://calendar.google.com/calendar/u/0/appointments/schedules/AcZssZ1oFoHy0m9As4PtSfm4Ee-nVyoZRNNyZ38doHCWpVwDfo5u3qxnesRT_LqD_Fv5nUlbE3EvxyYN'
              : null;
            $actionLabel = filled($card->action_label) ? $card->action_label : $fallbackActionLabel;
            $actionLink = filled($card->action_link) ? $card->action_link : $fallbackActionLink;
            $hasLearnMore = filled($learnMoreLink);
            $hasAction = filled($actionLabel) && filled($actionLink);
            $learnMoreExternal = $hasLearnMore && str_starts_with(strtolower(trim((string) $learnMoreLink)), 'http');
            $actionExternal = $hasAction && str_starts_with(strtolower(trim((string) $actionLink)), 'http');
          @endphp
          <article class="ban-service-row">
            <span class="ban-service-row__number" aria-hidden="true">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

            <figure class="ban-service-row__visual">
              <img src="{{ $card->coverImageUrl() }}" alt="" width="180" height="120" loading="lazy" decoding="async">
            </figure>

            <div class="ban-service-row__content">
              <h3>{{ $card->title }}</h3>
              <p>{{ $card->description }}</p>

              @if ($hasLearnMore || $hasAction)
                <div class="ban-service-row__actions">
                  @if ($hasLearnMore)
                    <a href="{{ $learnMoreLink }}"
                       @if ($learnMoreExternal) target="_blank" rel="noopener noreferrer" @endif>
                      <span>{{ $learnMoreLabel }}</span>
                      <span aria-hidden="true">↗</span>
                    </a>
                  @endif
                  @if ($hasAction)
                    <a href="{{ $actionLink }}"
                       @if ($actionExternal) target="_blank" rel="noopener noreferrer" @endif>
                      <span>{{ $actionLabel }}</span>
                      <span aria-hidden="true">↗</span>
                    </a>
                  @endif
                </div>
              @endif
            </div>
          </article>
        @empty
          <p class="ban-what-we-do__empty">What We Do content is not configured yet.</p>
        @endforelse
      </div>
    </div>
  </section>

  {{-- Pitch your Startup --}}
  <section id="pitch-startup" class="ban-content-section ban-pitch" aria-labelledby="pitch-heading">
    <div class="ban-pitch__inner">
      <div class="ban-pitch__copy">
        <h2 id="pitch-heading">Pitch your Startup</h2>
        <p>
          Qualify for our monthly showcase to pitch in front of prospective investors.<br>
          We are a network of 500+ members always looking for startups to invest in.
        </p>
        <a target="_blank" rel="noopener noreferrer" href="https://forms.gle/Pr5KdwuZyeiTbq6P7">Send Your Pitch</a>
      </div>
      <div class="ban-pitch__visual">
        <img src="{{ asset('IMG_0944.jpg') }}" alt="Bangladesh Angels team" width="700" height="520" loading="lazy">
      </div>
    </div>
  </section>

  {{-- Founder pitch form --}}
  <section id="pitch-form" class="ban-content-section ban-pitch-form" aria-labelledby="pitch-form-heading">
    <div class="ban-pitch-form__inner">
      <div class="ban-pitch-form__intro">
        <span class="ban-pitch-form__eyebrow">For founders</span>
        <h2 id="pitch-form-heading">Send us your pitch</h2>
        <p>
          Share a one-line summary and your deck in PDF format. Our team will review submissions and follow up where there is a fit.
        </p>

        <div class="ban-pitch-form__notes" aria-label="What happens after you submit">
          <div class="ban-pitch-form__note">
            <span aria-hidden="true">01</span>
            <p><strong>Submit your essentials</strong>A clear summary and a focused pitch deck are all we need.</p>
          </div>
          <div class="ban-pitch-form__note">
            <span aria-hidden="true">02</span>
            <p><strong>Reviewed by our team</strong>We assess every submission for fit with the BAN investor network.</p>
          </div>
        </div>
      </div>

      <div class="ban-pitch-form__card">
        @if (session('pitch_submitted'))
          <div class="ban-pitch-form__success" role="status">
            <span aria-hidden="true">✓</span>
            <p><strong>Pitch received</strong>Thank you—your pitch was submitted successfully.</p>
          </div>
        @endif

        <form method="post" action="{{ route('home.pitch') }}" enctype="multipart/form-data">
          @csrf

          <div class="ban-pitch-form__field">
            <label for="home_contact_email">Contact email</label>
            <input
              type="email"
              name="contact_email"
              id="home_contact_email"
              required
              value="{{ old('contact_email', auth()->user()->email ?? '') }}"
              autocomplete="email"
              placeholder="founder@startup.com"
              @error('contact_email') aria-invalid="true" aria-describedby="home-contact-email-error" @enderror
            >
            @error('contact_email')
              <p id="home-contact-email-error" class="ban-pitch-form__error">{{ $message }}</p>
            @enderror
          </div>

          <div class="ban-pitch-form__field">
            <label for="home_one_line">One-line description of your startup</label>
            <input
              type="text"
              name="one_line"
              id="home_one_line"
              required
              maxlength="280"
              value="{{ old('one_line') }}"
              placeholder="e.g. AI-powered logistics visibility for SMEs in South Asia"
              @error('one_line') aria-invalid="true" aria-describedby="home-one-line-error" @enderror
            >
            @error('one_line')
              <p id="home-one-line-error" class="ban-pitch-form__error">{{ $message }}</p>
            @enderror
          </div>

          <div class="ban-pitch-form__field">
            <label for="home_pitch_deck">Pitch deck <span>(PDF only, max 12&nbsp;MB)</span></label>
            <div class="ban-pitch-form__file">
              <span class="ban-pitch-form__file-mark" aria-hidden="true">PDF</span>
              <div>
                <strong>Choose your pitch deck</strong>
                <span id="home_pitch_deck_name" aria-live="polite">A concise, investor-ready deck works best.</span>
              </div>
              <input
                type="file"
                name="pitch_deck"
                id="home_pitch_deck"
                required
                accept="application/pdf,.pdf"
                @error('pitch_deck') aria-invalid="true" aria-describedby="home-pitch-deck-error" @enderror
              >
            </div>
            @error('pitch_deck')
              <p id="home-pitch-deck-error" class="ban-pitch-form__error">{{ $message }}</p>
            @enderror
          </div>

          <button type="submit" class="ban-pitch-form__submit">
            <span>Submit pitch</span>
            <span aria-hidden="true">→</span>
          </button>
        </form>
      </div>
    </div>
  </section>

  <section id="ban-resources" class="ban-content-section ban-resources" aria-labelledby="ban-events-heading">
    <div class="ban-content-section__inner">
      <h3 id="ban-events-heading" class="ban-section-heading ban-section-heading--center">
        <span class="ban-section-heading__ornament">
          <span aria-hidden="true">✽</span>
          <span>BAN Events</span>
        </span>
      </h3>

      <div class="ban-resources__list">
        @forelse ($landingResourceEvents as $event)
          <x-ban-event-card :resource="$event" />
        @empty
          <p class="rounded-2xl border border-emerald-950/10 bg-white px-5 py-8 text-center text-sm text-gray-600 shadow-sm">
            New events will be announced here soon. Please check back shortly.
          </p>
        @endforelse
      </div>

      <div class="ban-section-cta">
        <a href="{{ route('resources') }}">Discover BAN Resources</a>
      </div>
    </div>
  </section>
  
  <section id="our-partners" class="ban-content-section ban-partners" aria-labelledby="partners-heading">
    <div class="ban-content-section__inner">
      <h2 id="partners-heading" class="ban-section-heading ban-section-heading--center">Our Partners</h2>
      <p class="ban-partners__intro">
        We collaborate with leading investment firms and accelerator programs across the region,<br class="hidden md:block">
        co-investing in high-potential startups and guiding founders with industry expertise. Some of our key partners are showcased here.
      </p>
      <div class="ban-partners__groups">
        <div class="ban-partner-group">
          <h3>Founding Partners</h3>
          <div class="ban-partner-grid">
            <a href="https://www.government.nl/ministries/ministry-of-foreign-affairs" target="_blank" rel="noopener noreferrer" class="ban-partner-card">
              <img src="{{ asset('foreignaffairsnetherland.webp') }}" alt="Netherlands Ministry of Foreign Affairs" width="150" height="80" loading="lazy">
            </a>
            <a href="https://aavishkaarcapital.in/" target="_blank" rel="noopener noreferrer" class="ban-partner-card">
              <img src="{{ asset('capital logo.webp') }}" alt="Aavishkaar Capital" width="150" height="80" loading="lazy">
            </a>
          </div>
        </div>
        <div class="ban-partner-group">
          <h3>Industry Partners</h3>
          <div class="ban-partner-grid">
            <a href="https://bida.gov.bd/" target="_blank" rel="noopener noreferrer" class="ban-partner-card">
              <img src="{{ asset('bidalogo.webp') }}" alt="BIDA" width="150" height="80" loading="lazy">
            </a>
            <a target="_blank" rel="noopener noreferrer" href="https://venture.com.bd/" class="ban-partner-card">
              <img src="{{ asset('bangladesh venture capital.webp') }}" alt="Bangladesh Venture Capital" width="150" height="80" loading="lazy">
            </a>
            <a target="_blank" rel="noopener noreferrer" href="https://lightcastlepartners.com/" class="ban-partner-card">
              <img src="{{ asset('lcp.svg') }}" alt="LightCastle Partners" width="150" height="80" loading="lazy">
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  </main>
  
  <livewire:footer></livewire:footer>
  <livewire:scripts />
    
  <script>
    // Loading screen handler
    document.addEventListener('DOMContentLoaded', function() {
      // Handle loading screen
      setTimeout(() => {
        document.getElementById("loading-screen").classList.add("fade-out");
        setTimeout(() => {
            document.getElementById("loading-screen").style.display = "none";
        }, 300);
      }, 300);
      
      // Check for payment status in URL parameters
      const urlParams = new URLSearchParams(window.location.search);
      const statusCode = urlParams.get('status_code');
      
      // Legacy: some gateways once landed on home with ?status_code=2. Receipts now use signed /payment/complete URLs.
      if (statusCode === '2') {
        window.location.replace('{{ auth()->check() ? route("dashboard") : route("login") }}');
      }

      // BAN stats — count up when section enters view
      (function initBanStats() {
        const root = document.getElementById('ban-stats');
        if (!root) return;
        const valueEls = root.querySelectorAll('.ban-stat-value');
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        function setFinalValues() {
          valueEls.forEach((el) => {
            el.textContent = el.getAttribute('data-ban-stat') || '0';
          });
        }

        if (reduceMotion) {
          setFinalValues();
          return;
        }

        let started = false;
        function runCountUp() {
          if (started) return;
          started = true;
          const duration = 2000;
          const start = performance.now();
          const targets = Array.from(valueEls).map((el) => ({
            el,
            end: parseInt(el.getAttribute('data-ban-stat'), 10) || 0,
          }));

          function easeOutCubic(t) {
            return 1 - Math.pow(1 - t, 3);
          }

          function tick(now) {
            const t = Math.min(1, (now - start) / duration);
            const e = easeOutCubic(t);
            targets.forEach(({ el, end }) => {
              el.textContent = String(Math.round(e * end));
            });
            if (t < 1) {
              requestAnimationFrame(tick);
            } else {
              setFinalValues();
            }
          }
          requestAnimationFrame(tick);
        }

        const io = new IntersectionObserver(
          (entries) => {
            entries.forEach((entry) => {
              if (entry.isIntersecting) {
                runCountUp();
                io.disconnect();
              }
            });
          },
          { threshold: 0.2, rootMargin: '0px 0px -24px 0px' }
        );
        io.observe(root);
      })();

      (function initPitchDeckInput() {
        const input = document.getElementById('home_pitch_deck');
        const fileName = document.getElementById('home_pitch_deck_name');
        const fileBox = input?.closest('.ban-pitch-form__file');
        if (!input || !fileName || !fileBox) return;

        input.addEventListener('change', function() {
          const selectedFile = input.files && input.files[0];
          fileName.textContent = selectedFile
            ? selectedFile.name
            : 'A concise, investor-ready deck works best.';
          fileBox.classList.toggle('is-selected', Boolean(selectedFile));
        });
      })();
    });
    
    // Lazy load images that are far below the fold
    document.addEventListener('scroll', function() {
      if ('loading' in HTMLImageElement.prototype) {
        const images = document.querySelectorAll('img[loading="lazy"]');
        images.forEach(img => {
          // If image is in viewport or about to be, load it
          const rect = img.getBoundingClientRect();
          if (rect.top <= window.innerHeight + 500) {
            img.setAttribute('loading', 'eager');
          }
        });
      }
    }, { passive: true });
  </script>
</body>
</html>
