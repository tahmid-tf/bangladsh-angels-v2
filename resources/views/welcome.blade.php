<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Bangladesh's first and largest angel investment platform connecting early-stage startups with investors.">
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
            <a href="{{ route('deals') }}"
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

  <section class="w-full px-4 py-12 md:py-16 bg-gradient-to-b from-green-50/80 to-white border-b border-green-100/80" aria-labelledby="meet-investors-heading">
    <div class="mx-auto max-w-4xl text-center">
      <h2 id="meet-investors-heading" class="text-xl md:text-2xl font-bold text-[#0f3d34] mb-5 md:mb-6 leading-snug">
        Meet the Investors
      </h2>
      <p class="text-[0.95em] md:text-[1.1em] text-gray-700 leading-relaxed">
        Join a global network of over 450 executives and operators<br class="hidden md:block"> who have built and expanded companies in all parts of the world.
      </p>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6 md:gap-8 mt-10 md:mt-12 max-w-6xl mx-auto w-full px-2">
      <div class="flex flex-col items-center">
        <img src="{{ asset('investors/1.png') }}" class="rounded-xl h-auto max-h-[200px] w-auto shadow-sm border border-green-100/60" alt="Investor 1" loading="lazy" width="150" height="150">
        <img src="{{ asset('investors/2.png') }}" class="rounded-xl h-auto max-h-[200px] w-auto shadow-sm border border-green-100/60 mt-4" alt="Investor 2" loading="lazy" width="150" height="150">
      </div>
      <div class="flex flex-col items-center mt-0 md:mt-16">
        <img src="{{ asset('investors/3.png') }}" class="rounded-xl h-auto max-h-[200px] w-auto shadow-sm border border-green-100/60" alt="Investor 3" loading="lazy" width="150" height="150">
        <img src="{{ asset('investors/4.png') }}" class="rounded-xl h-auto max-h-[200px] w-auto shadow-sm border border-green-100/60 mt-4" alt="Investor 4" loading="lazy" width="150" height="150">
      </div>
      <div class="flex flex-col items-center">
        <img src="{{ asset('investors/5.png') }}" class="rounded-xl h-auto max-h-[200px] w-auto shadow-sm border border-green-100/60" alt="Investor 5" loading="lazy" width="150" height="150">
        <img src="{{ asset('investors/6.png') }}" class="rounded-xl h-auto max-h-[200px] w-auto shadow-sm border border-green-100/60 mt-4" alt="Investor 6" loading="lazy" width="150" height="150">
      </div>
      <div class="flex flex-col items-center mt-0 md:mt-16">
        <img src="{{ asset('investors/7.png') }}" class="rounded-xl h-auto max-h-[200px] w-auto shadow-sm border border-green-100/60" alt="Investor 7" loading="lazy" width="150" height="150">
        <img src="{{ asset('investors/8.png') }}" class="rounded-xl h-auto max-h-[200px] w-auto shadow-sm border border-green-100/60 mt-4" alt="Investor 8" loading="lazy" width="150" height="150">
      </div>
      <div class="flex flex-col items-center">
        <img src="{{ asset('investors/9.png') }}" class="rounded-xl h-auto max-h-[200px] w-auto shadow-sm border border-green-100/60" alt="Investor 9" loading="lazy" width="150" height="150">
        <img src="{{ asset('investors/10.png') }}" class="md:block hidden rounded-xl h-auto max-h-[200px] w-auto shadow-sm border border-green-100/60 mt-4" alt="Investor 10" loading="lazy" width="150" height="150">
      </div>
      <div class="flex flex-col items-center">
        <img src="{{ asset('investors/10.png') }}" class="md:hidden rounded-xl h-auto max-h-[200px] w-auto shadow-sm border border-green-100/60 mt-4" alt="Investor 10" loading="lazy" width="150" height="150">
      </div>
    </div>
  </section>

  <section id="what-we-do" class="w-full px-4 py-12 md:py-16 bg-gradient-to-b from-white to-green-50/60 border-b border-green-100/80" aria-labelledby="what-we-do-heading">
    <div class="mx-auto max-w-6xl">
      <h2 id="what-we-do-heading" class="text-center text-xl md:text-2xl font-bold text-[#0f3d34] mb-10 md:mb-12 leading-snug">
        What We Do
      </h2>

      <article class="rounded-2xl border border-green-100/70 bg-white/80 p-6 md:p-10 shadow-sm" aria-labelledby="bwin-heading">
        <h3 id="bwin-heading" class="text-lg sm:text-xl md:text-2xl font-bold text-[#36b37e] text-center md:text-left leading-snug mb-4 md:mb-5">
          Bangladesh Women Investors Network (BWIN)
        </h3>
        <p class="text-[0.95em] md:text-[1.1em] text-gray-700 leading-relaxed text-center md:text-left max-w-3xl md:max-w-none mx-auto md:mx-0 mb-8 md:mb-10">
          Bangladesh Women Investors Network (BWIN) is Bangladesh's first women-led angel investing network, operating as a sister chapter of BAN. With a gender-lens approach, BWIN supports pre-seed to seed-stage startups while actively growing a diverse pipeline of women investors and entrepreneurs.
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8 items-start max-w-5xl mx-auto">
          <figure class="m-0 w-full">
            <img src="{{ asset('bwin.png') }}" alt="Bangladesh Women Investors Network (BWIN)" class="w-full rounded-xl border border-green-100/60 shadow-sm h-auto object-contain max-h-72 sm:max-h-80 md:max-h-96" width="600" height="400" loading="lazy" decoding="async">
          </figure>
          <figure class="m-0 w-full">
            <img src="{{ asset('bwin2.png') }}" alt="Bangladesh Women Investors Network (BWIN)" class="w-full rounded-xl border border-green-100/60 shadow-sm h-auto object-contain max-h-72 sm:max-h-80 md:max-h-96" width="600" height="400" loading="lazy" decoding="async">
          </figure>
        </div>
      </article>
    </div>
  </section>

  {{-- Portfolio Companies --}}
  <section id="portfolio-companies" class="w-full px-4 py-12 md:py-16 bg-gradient-to-b from-green-50/60 to-white border-b border-green-100/80" aria-labelledby="portfolio-heading">
    <div class="mx-auto max-w-6xl">
      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10 md:mb-12 text-center md:text-left">
        <div class="max-w-2xl mx-auto md:mx-0">
          <h2 id="portfolio-heading" class="text-xl md:text-2xl font-bold text-[#0f3d34] leading-snug">Portfolio Companies</h2>
          <p class="mt-3 text-[0.95em] md:text-[1.1em] text-gray-700 leading-relaxed">Take a look at our portfolio companies</p>
        </div>
        <div class="shrink-0 flex justify-center md:justify-end">
          <a href="{{ route('portfolio') }}" class="inline-flex px-6 py-3 rounded-full bg-[#36b37e] font-bold text-white hover:opacity-90 transition-opacity">View All Portfolios</a>
        </div>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 w-full">
        @foreach ($portfolioDeals as $deal)
          <livewire:portfolio-company :deal="$deal"></livewire:portfolio-company>
        @endforeach
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
  
    @auth
      {{-- Deal Listings --}}
      <section id="deal-listings" class="w-full px-4 py-12 md:py-16 bg-gradient-to-b from-green-50/80 to-white border-b border-green-100/80" aria-labelledby="deals-heading">
        <div class="mx-auto max-w-6xl flex flex-col items-center text-center">
          <h2 id="deals-heading" class="text-xl md:text-2xl font-bold text-[#0f3d34] leading-snug">Deal Listings</h2>
          <p class="mt-3 max-w-2xl text-[0.95em] md:text-[1.1em] text-gray-700 leading-relaxed">Live details to review and invest today.</p>
          <div class="w-full mt-10 md:mt-12 rounded-2xl border border-green-100/70 bg-white/90 p-4 md:p-8 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full">
              @foreach ($deals as $deal)
                <livewire:deal-card :deal="$deal"></livewire:deal-card>
              @endforeach
            </div>
          </div>
          <a href="{{ route('deals') }}" class="mt-8 md:mt-10 inline-flex px-6 py-3 rounded-full bg-[#36b37e] font-bold text-white hover:opacity-90 transition-opacity">Explore All Deals</a>
        </div>
      </section>
    @endauth
    
  <section id="ban-resources" class="w-full px-4 py-12 md:py-16 bg-gradient-to-b from-white to-green-50/60 border-b border-green-100/80" aria-labelledby="resources-heading">
    <div class="mx-auto max-w-6xl text-center">
      <h2 id="resources-heading" class="text-xl md:text-2xl font-bold text-[#0f3d34] leading-snug">BAN Resources</h2>
      <p class="mt-3 mx-auto max-w-3xl text-[0.95em] md:text-[1.1em] text-gray-700 leading-relaxed">
        Bangladesh Angels hosts events for start-ups and angel investors.<br class="hidden md:block">
        Join any of our events to connect with people today!
      </p>
      <div class="mt-10 md:mt-12 mx-auto max-w-4xl rounded-2xl overflow-hidden border border-green-100/70 shadow-sm">
        <div class="flex flex-col sm:flex-row overflow-hidden text-white text-left bg-gradient-to-br to-[#022e2e] from-[#156755]">
          <div class="h-48 sm:h-auto sm:w-1/2 lg:w-2/5 bg-gray-200 shrink-0">
            <img src="{{ asset('resourcesCover.webp') }}" loading="lazy" alt="BAN event" class="h-full w-full object-cover min-h-[12rem] sm:min-h-0" width="400" height="300">
          </div>
          <div class="flex flex-col justify-between p-4 sm:w-1/2 lg:w-3/5 sm:p-8 items-start">
            <h3 class="mb-4 text-lg md:text-xl lg:text-2xl font-bold text-left leading-snug">Networking Event<br>hosted by ShopUp</h3>
            <div class="flex items-center my-2">
              <div class="bg-white rounded-full p-3 shrink-0">
                <img src="{{ asset('dateicon.webp') }}" alt="" class="h-5 w-5" draggable="false" width="20" height="20">
              </div>
              <p class="text-left ml-3 text-sm md:text-base text-white/95">
                16 - 22 December, 2023<br>
                08:00 AM to 06:00 PM
              </p>
            </div>
            <div class="flex items-center my-2">
              <div class="bg-white rounded-full p-3 shrink-0">
                <img src="{{ asset('locationicon.webp') }}" alt="" class="h-5 w-5" draggable="false" width="20" height="20">
              </div>
              <p class="text-left ml-3 text-sm md:text-base text-white/95">
                64–65, Kazi Nazrul Islam Avenue,<br>Dhaka-1215
              </p>
            </div>
          </div>
        </div>
      </div>
      <a href="{{ route('resources') }}" class="inline-flex mt-8 md:mt-10 px-6 py-3 rounded-full bg-[#eefff1] font-bold text-[#36b37e] border border-green-100/80 shadow-sm hover:bg-[#dff7e8] transition-colors">Discover BAN Resources</a>
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
      
      // If status_code is 2, redirect to success page
      if (statusCode === '2') {
        window.location.href = '{{ route("payment.complete") }}';
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