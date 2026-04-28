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
    <link rel="preload" as="style" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap">
    
    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    
    @vite('resources/css/app.css')
    <livewire:styles />
    
    <style>
        /* Critical CSS for initial render */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Figtree', sans-serif;
        }
        
        /* Loading Screen */
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.3s ease-in-out;
            z-index: 9999;
        }
        
        #loading-screen.fade-out {
            opacity: 0;
            pointer-events: none;
        }
        
        .loading-icon {
            height: 4rem;
            width: auto;
            object-fit: contain;
        }
        
        @media (min-width: 768px) {
            .loading-icon {
                height: 6rem;
            }
        }
        
        @media (min-width: 1024px) {
            .loading-icon {
                height: 8rem;
            }
        }

        /* Hero CTA — vertical word swap (fundraise / invest) */
        .hero-cta-pill {
            gap: 0.15em 0.35em;
            max-width: 100%;
            text-align: center;
        }

        .hero-cta-rotator {
            display: inline-block;
            height: 1.3em;
            overflow: hidden;
            vertical-align: bottom;
            min-width: 6.25rem;
            text-align: left;
        }

        .hero-cta-rotator-track {
            display: flex;
            flex-direction: column;
            animation: hero-cta-word-slide 6s ease-in-out infinite;
        }

        .hero-cta-rotator-item {
            display: block;
            line-height: 1.3;
            height: 1.3em;
            white-space: nowrap;
        }

        /* End each cycle on the duplicate 'fundraise' so the loop reset is invisible */
        @keyframes hero-cta-word-slide {
            0%, 28% { transform: translateY(0); }
            33%, 61% { transform: translateY(-1.3em); }
            66%, 100% { transform: translateY(-2.6em); }
        }

        @media (prefers-reduced-motion: reduce) {
            .hero-cta-rotator-track {
                animation: none;
                transform: translateY(0);
            }
        }

        .ban-stats-grid .ban-stat-value {
            font-variant-numeric: tabular-nums;
        }

        .what-we-do-card {
            background: radial-gradient(circle at 50% 60%, #0f8b63 0%, #076847 55%, #045538 100%);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 8px 24px rgba(4, 85, 56, 0.22);
        }

        .what-we-do-badge {
            background: linear-gradient(180deg, rgba(236, 242, 239, 0.95) 0%, rgba(200, 218, 208, 0.92) 100%);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            border: 1px solid rgba(255, 255, 255, 0.45);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.65), 0 2px 10px rgba(0, 0, 0, 0.08);
            clip-path: polygon(9% 0%, 100% 0%, 91% 100%, 0% 100%);
            color: #053728;
        }

        /* Copy sits on the card — no white “sticker” panel */
        .what-we-do-card-body {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.14);
            flex: 1 1 auto;
            min-height: 0;
        }

        .what-we-do-card-body p {
            margin: 0;
            padding: 0 0.15rem;
            text-align: left;
            font-size: 0.9375rem;
            line-height: 1.68;
            color: rgba(248, 253, 250, 0.94);
            letter-spacing: 0.012em;
            font-weight: 400;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.22);
        }

        @media (min-width: 768px) {
            .what-we-do-card-body p {
                font-size: 0.96rem;
                line-height: 1.7;
            }
        }
    </style>
</head>

<body class="flex flex-col items-center mt-[150px] w-full justify-center">
  <!-- Loading Screen -->
  <div id="loading-screen">
    <img src="{{ asset('icon.webp') }}" alt="Bangladesh Angels Logo" class="loading-icon">
  </div>

  {{-- Navigation --}}
  <livewire:navigation-bar></livewire:navigation-bar>
  
  <section class="flex justify-center">
    <div class="flex flex-col md:flex-row w-full h-auto md:h-[70vh] py-[60px] md:py-[120px] justify-center items-center bg-cover bg-center" style="background-image: url('{{ asset('world_map_4x.webp') }}');">
        <img src="{{ asset('landing.png') }}" alt="coverphoto" draggable="false" class="w-3/4 md:w-auto mb-6 md:mb-0" width="500" height="375" loading="eager">
        <div class="p-3 md:ml-6 w-full md:w-1/3 text-center md:text-left">
            <h1 class="text-[2em] md:text-[3em] leading-none font-bold mt-5">
                Join BAN
            </h1>
            <p class="my-6 text-[1em] md:text-[1.1em]">
                Bangladesh's first and largest angel investment platform, BAN connects early-stage startups with investors who bring capital, expertise, and a global network. We back founders solving real challenges, turning ambition into action.
            </p>
            <div class="flex flex-col items-center gap-4 md:items-start">
                <a href="{{ route('investor.signup') }}"
                   class="inline-flex items-center justify-center rounded-full bg-[#0f3d34] px-7 py-3.5 text-base font-bold text-white shadow-lg hover:bg-[#156755] transition-colors w-full max-w-xs sm:max-w-none sm:w-auto"
                   title="Apply to become an angel investor with Bangladesh Angels Network">
                    Become an Investor
                </a>
                <a href="{{ route('startups') }}"
                   class="hero-cta-pill inline-flex flex-wrap items-baseline justify-center md:justify-start p-3 px-5 sm:px-6 rounded-full bg-[#eefff1] font-bold text-[#36b37e] text-[0.9rem] sm:text-base leading-snug"
                   aria-label="I'm looking to fundraise or invest">
                    <span class="whitespace-nowrap">I'm looking to</span>
                    <span class="hero-cta-rotator" aria-hidden="true">
                        <span class="hero-cta-rotator-track">
                            <span class="hero-cta-rotator-item">fundraise</span>
                            <span class="hero-cta-rotator-item">invest</span>
                            <span class="hero-cta-rotator-item">fundraise</span>
                        </span>
                    </span>
                </a>
            </div>
        </div>
    </div>
  </section>

  <section id="ban-impact" class="w-full px-4 py-12 md:py-16 bg-gradient-to-b from-white to-green-50/80 border-b border-green-100/80" aria-labelledby="ban-impact-heading">
    <div class="mx-auto max-w-4xl text-center">
      <h2 id="ban-impact-heading" class="text-xl md:text-2xl font-bold text-[#0f3d34] mb-5 md:mb-6 leading-snug">
        From 2019 to today
      </h2>
      <p class="text-[0.95em] md:text-[1.1em] text-gray-700 leading-relaxed">
        Bangladesh Angels Network (BAN), since its inception in 2019, has facilitated investments amounting to $12M across 51 portfolio companies, including Pathao, Chaldal, Shajgoj, Chhaya, PulseTech, etc. BAN has a global investor network with 500+ angel investors.
      </p>
    </div>

    <div id="ban-stats" class="ban-stats-grid mx-auto mt-10 md:mt-12 max-w-6xl grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-8 md:gap-6 px-2">
      <div class="flex flex-col items-center text-center p-3 rounded-xl bg-white/70 shadow-sm border border-green-100/60">
        <p class="text-2xl sm:text-3xl font-bold text-[#36b37e] leading-tight">
          <span class="ban-stat-value" data-ban-stat="500">0</span><span class="ban-stat-suffix" aria-hidden="true">+</span>
        </p>
        <p class="mt-2 text-sm sm:text-base text-gray-600 font-medium">Angel Investors</p>
      </div>
      <div class="flex flex-col items-center text-center p-3 rounded-xl bg-white/70 shadow-sm border border-green-100/60">
        <p class="text-2xl sm:text-3xl font-bold text-[#36b37e] leading-tight">
          <span class="ban-stat-prefix" aria-hidden="true">$</span><span class="ban-stat-value" data-ban-stat="12">0</span><span class="ban-stat-suffix" aria-hidden="true">m+</span>
        </p>
        <p class="mt-2 text-sm sm:text-base text-gray-600 font-medium">Invested</p>
      </div>
      <div class="flex flex-col items-center text-center p-3 rounded-xl bg-white/70 shadow-sm border border-green-100/60">
        <p class="text-2xl sm:text-3xl font-bold text-[#36b37e] leading-tight">
          <span class="ban-stat-value" data-ban-stat="51">0</span>
        </p>
        <p class="mt-2 text-sm sm:text-base text-gray-600 font-medium">Startups Funded</p>
      </div>
      <div class="flex flex-col items-center text-center p-3 rounded-xl bg-white/70 shadow-sm border border-green-100/60">
        <p class="text-2xl sm:text-3xl font-bold text-[#36b37e] leading-tight">
          <span class="ban-stat-value" data-ban-stat="84">0</span>
        </p>
        <p class="mt-2 text-sm sm:text-base text-gray-600 font-medium">Deals executed</p>
      </div>
      <div class="col-span-2 sm:col-span-1 lg:col-span-1 flex flex-col items-center text-center p-3 rounded-xl bg-white/70 shadow-sm border border-green-100/60 max-w-md mx-auto w-full sm:max-w-none sm:mx-0 sm:w-auto">
        <p class="text-2xl sm:text-3xl font-bold text-[#36b37e] leading-tight">
          <span class="ban-stat-value" data-ban-stat="6">0</span>
        </p>
        <p class="mt-2 text-sm sm:text-base text-gray-600 font-medium">Years of investing</p>
      </div>
    </div>
  </section>

  <section id="what-we-do" class="w-full px-4 py-12 md:py-16 bg-gradient-to-b from-white to-green-50/60 border-b border-green-100/80" aria-labelledby="what-we-do-heading">
    <div class="mx-auto max-w-6xl">
      <h2 id="what-we-do-heading" class="text-center text-2xl md:text-4xl font-bold text-[#0f6a4b] mb-10 md:mb-12 leading-snug">
        <span class="inline-flex items-center gap-2 md:gap-3">
          <span aria-hidden="true" class="text-3xl md:text-4xl leading-none">✽</span>
          <span>What We Do</span>
        </span>
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
        @forelse ($whatWeDoCards as $card)
          <article class="what-we-do-card rounded-3xl p-5 md:p-6 flex flex-col h-full">
            <h3 class="what-we-do-badge mx-auto text-center font-bold text-lg md:text-xl px-8 py-2.5 mb-5 w-fit min-w-[170px]">
              {{ $card->title }}
            </h3>

            <figure class="m-0 rounded-lg overflow-hidden border border-white/20 bg-black/10 shrink-0 ring-1 ring-black/5">
              <img src="{{ $card->coverImageUrl() }}" alt="{{ $card->title }} — cover image" class="w-full h-[150px] sm:h-[164px] object-contain object-center bg-[#0a5c45]" width="480" height="260" loading="lazy" decoding="async">
            </figure>

            <div class="what-we-do-card-body">
              <p>{{ $card->description }}</p>
              @if (filled($card->cta_link))
                <a href="{{ $card->cta_link }}" class="mt-5 inline-flex items-center justify-center px-4 py-2 rounded-full bg-[#eefff1] text-[#0f6a4b] font-semibold text-sm border border-green-100/70 hover:bg-[#dff7e8] transition-colors">
                  Learn More
                </a>
              @endif
            </div>
          </article>
        @empty
          <p class="col-span-full text-center text-gray-600 text-sm">What We Do content is not configured yet.</p>
        @endforelse
      </div>
    </div>
  </section>

  {{-- Pitch your Startup --}}
  <section id="pitch-startup" class="w-full px-4 py-12 md:py-16 bg-gradient-to-b from-white to-green-50/60 border-b border-green-100/80" aria-labelledby="pitch-heading">
    <div class="mx-auto max-w-6xl flex flex-col-reverse md:flex-row md:items-center gap-10 md:gap-14 justify-between">
      <div class="flex flex-col w-full md:w-1/2 text-center md:text-left">
        <h2 id="pitch-heading" class="text-xl md:text-2xl font-bold text-[#0f3d34] leading-snug">Pitch your Startup</h2>
        <p class="mt-4 md:mt-5 text-[0.95em] md:text-[1.1em] text-gray-700 leading-relaxed">
          Qualify for our monthly showcase to pitch in front of prospective investors.<br>
          We are a network of 500+ members always looking for startups to invest in.
        </p>
        <a target="_blank" rel="noopener noreferrer" href="https://forms.gle/Pr5KdwuZyeiTbq6P7" class="mt-6 md:mt-8 inline-flex self-center md:self-start px-6 py-3 rounded-full bg-[#eefff1] font-bold text-[#36b37e] border border-green-100/80 shadow-sm hover:bg-[#dff7e8] transition-colors">Send Your Pitch</a>
      </div>
      <div class="w-full md:w-1/2">
        <img src="{{ asset('IMG_0944.jpg') }}" alt="Bangladesh Angels team" class="w-full h-auto max-h-[280px] sm:max-h-[360px] md:max-h-[420px] object-cover rounded-xl border border-green-100/60 shadow-sm" width="500" height="300" loading="lazy">
      </div>
    </div>
  </section>

  <section id="ban-resources" class="w-full px-4 py-12 md:py-16 bg-gradient-to-b from-white to-green-50/60 border-b border-green-100/80" aria-labelledby="ban-events-heading">
    <div class="mx-auto max-w-6xl">
      <h3 id="ban-events-heading" class="text-center text-lg md:text-2xl font-bold text-[#0f6a4b] leading-snug">
        <span class="inline-flex items-center justify-center gap-2 md:gap-3">
          <span aria-hidden="true" class="text-xl md:text-2xl leading-none text-[#0f6a4b]/90">✽</span>
          <span>BAN Events</span>
        </span>
      </h3>

      <div class="mx-auto mt-8 flex max-w-4xl flex-col gap-6 md:mt-10 md:gap-8">
        @forelse ($landingResourceEvents as $event)
          <x-ban-event-card :resource="$event" />
        @empty
          <p class="rounded-xl border border-green-100/80 bg-white/70 px-5 py-6 text-center text-sm text-gray-600 shadow-sm">
            New events will be announced here soon. Please check back shortly.
          </p>
        @endforelse
      </div>

      <div class="mt-8 flex justify-center md:mt-10">
        <a href="{{ route('resources') }}" class="inline-flex px-6 py-3 rounded-full bg-[#eefff1] font-bold text-[#36b37e] border border-green-100/80 shadow-sm hover:bg-[#dff7e8] transition-colors">Discover BAN Resources</a>
      </div>
    </div>
  </section>
  
  <section id="our-partners" class="w-full px-4 py-12 md:py-16 bg-gradient-to-b from-green-50/60 to-white border-b border-green-100/80" aria-labelledby="partners-heading">
    <div class="mx-auto max-w-6xl text-center">
      <h2 id="partners-heading" class="text-xl md:text-2xl font-bold text-[#0f3d34] leading-snug">Our Partners</h2>
      <p class="mt-3 mx-auto max-w-3xl text-[0.95em] md:text-[1.1em] text-gray-700 leading-relaxed">
        We collaborate with leading investment firms and accelerator programs across the region,<br class="hidden md:block">
        co-investing in high-potential startups and guiding founders with industry expertise. Some of our key partners are showcased here.
      </p>
      <div class="w-full mt-10 md:mt-12">
        <div class="mb-12 md:mb-14">
          <h3 class="text-lg md:text-xl font-bold text-[#36b37e] mb-6">Founding Partners</h3>
          <div class="flex flex-wrap justify-center gap-6 md:gap-8">
            <a href="https://www.government.nl/ministries/ministry-of-foreign-affairs" target="_blank" rel="noopener noreferrer" class="flex justify-center items-center p-5 min-w-[140px] border border-green-100/60 rounded-xl shadow-sm hover:shadow-md hover:border-green-200/80 transition-all bg-white/90">
              <img src="{{ asset('foreignaffairsnetherland.webp') }}" alt="Netherlands Ministry of Foreign Affairs" class="h-16 md:h-20 w-auto object-contain" width="150" height="80" loading="lazy">
            </a>
            <a href="https://aavishkaarcapital.in/" target="_blank" rel="noopener noreferrer" class="flex justify-center items-center p-5 min-w-[140px] border border-green-100/60 rounded-xl shadow-sm hover:shadow-md hover:border-green-200/80 transition-all bg-white/90">
              <img src="{{ asset('capital logo.webp') }}" alt="Aavishkaar Capital" class="h-16 md:h-20 w-auto object-contain" width="150" height="80" loading="lazy">
            </a>
          </div>
        </div>
        <div>
          <h3 class="text-lg md:text-xl font-bold text-[#36b37e] mb-6">Industry Partners</h3>
          <div class="flex flex-wrap justify-center gap-6 md:gap-8">
            <a href="https://bida.gov.bd/" target="_blank" rel="noopener noreferrer" class="flex justify-center items-center p-5 min-w-[140px] border border-green-100/60 rounded-xl shadow-sm hover:shadow-md hover:border-green-200/80 transition-all bg-white/90">
              <img src="{{ asset('bidalogo.webp') }}" alt="BIDA" class="h-16 md:h-20 w-auto object-contain" width="150" height="80" loading="lazy">
            </a>
            <a target="_blank" rel="noopener noreferrer" href="https://venture.com.bd/" class="flex justify-center items-center p-5 min-w-[140px] border border-green-100/60 rounded-xl shadow-sm hover:shadow-md hover:border-green-200/80 transition-all bg-white/90">
              <img src="{{ asset('bangladesh venture capital.webp') }}" alt="Bangladesh Venture Capital" class="h-16 md:h-20 w-auto object-contain" width="150" height="80" loading="lazy">
            </a>
            <div class="flex justify-center">
              <a target="_blank" rel="noopener noreferrer" href="https://sajidafoundation.org/" class="flex justify-center items-center p-5 min-w-[140px] max-w-xs border border-green-100/60 rounded-xl shadow-sm hover:shadow-md hover:border-green-200/80 transition-all bg-white/90">
                <img src="{{ asset('sajidafoundation.webp') }}" alt="Sajida Foundation" class="h-16 md:h-20 w-auto object-contain" width="150" height="80" loading="lazy">
              </a>
            </div>
            <div class="flex justify-center">
              <a target="_blank" rel="noopener noreferrer" href="https://lightcastlepartners.com/" class="flex justify-center items-center p-5 min-w-[140px] max-w-xs border border-green-100/60 rounded-xl shadow-sm hover:shadow-md hover:border-green-200/80 transition-all bg-white/90">
                <img src="{{ asset('lcp.svg') }}" alt="LightCastle Partners" class="h-16 md:h-20 w-auto object-contain" width="150" height="80" loading="lazy">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
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