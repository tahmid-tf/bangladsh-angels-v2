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
    </style>
</head>

<body class="flex flex-col items-center mt-[150px] w-full justify-center">
  <!-- Loading Screen -->
  <div id="loading-screen">
    <img src="{{ asset('icon.webp') }}" alt="Bangladesh Angels Logo" class="h-16 md:h-24 lg:h-32" width="128" height="128">
  </div>

  {{-- Navigation --}}
  <livewire:navigation-bar></livewire:navigation-bar>
  
  <section class="flex justify-center">
    <div class="flex flex-col md:flex-row w-full h-auto md:h-[70vh] py-[60px] md:py-[120px] justify-center items-center bg-cover bg-center" style="background-image: url('{{ asset('world_map_4x.webp') }}');">
        <img src="{{ asset('landing.png') }}" alt="coverphoto" draggable="false" class="w-3/4 md:w-auto mb-6 md:mb-0" width="500" height="375" loading="eager">
        <div class="p-3 md:ml-6 w-full md:w-1/3 text-center md:text-left">
            <h1 class="text-[2em] md:text-[3em] leading-none font-bold mt-5">
                Accelerate Your Startup
            </h1>
            <p class="my-6 text-[1em] md:text-[1.1em]">
                Bangladesh's first and largest angel investment platform, BAN connects early-stage startups with investors who bring capital, expertise, and a global network. We back founders solving real challenges, turning ambition into action.
            </p>
            <a href="{{ route('deals') }}" class="p-3 px-6 rounded-full bg-[#eefff1] font-bold text-[#36b37e]">
                Invest in Startups
            </a>
        </div>
    </div>
  </section>

   
  <div class="flex w-full flex-col justify-center items-center p-6 bg-gradient-to-b from-green-50 pt-[100px] md:pt-[200px] border-box to-white">
    <h1 class="text-[2em] md:text-[3em] font-bold text-center">
        Meet the Investors
    </h1>
    <p class="mt-3 text-center text-[1em] md:text-[1.5em]">
        Join a Global network of over 450 executives and operators<br class="hidden md:block">who have built and expanded companies in all parts of the world.
    </p>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6 p-3 mt-6">
            <div class="flex flex-col items-center">
                <img src="{{ asset('investors/1.png') }}" class="rounded-lg h-auto max-h-[200px] w-auto shadow-md" alt="Investor 1" loading="lazy" width="150" height="150">
                <img src="{{ asset('investors/2.png') }}" class="rounded-lg h-auto max-h-[200px] w-auto shadow-md mt-4" alt="Investor 2" loading="lazy" width="150" height="150">
            </div>

            <div class="flex flex-col items-center mt-0 md:mt-16">
                <img src="{{ asset('investors/3.png') }}" class="rounded-lg h-auto max-h-[200px] w-auto shadow-md" alt="Investor 3" loading="lazy" width="150" height="150">
                <img src="{{ asset('investors/4.png') }}" class="rounded-lg h-auto max-h-[200px] w-auto shadow-md mt-4" alt="Investor 4" loading="lazy" width="150" height="150">
            </div>

            <div class="flex flex-col items-center">
                <img src="{{ asset('investors/5.png') }}" class="rounded-lg h-auto max-h-[200px] w-auto shadow-md" alt="Investor 5" loading="lazy" width="150" height="150">
                <img src="{{ asset('investors/6.png') }}" class="rounded-lg h-auto max-h-[200px] w-auto shadow-md mt-4" alt="Investor 6" loading="lazy" width="150" height="150">
            </div>

            <div class="flex flex-col items-center mt-0 md:mt-16">
                <img src="{{ asset('investors/7.png') }}" class="rounded-lg h-auto max-h-[200px] w-auto shadow-md" alt="Investor 7" loading="lazy" width="150" height="150">
                <img src="{{ asset('investors/8.png') }}" class="rounded-lg h-auto max-h-[200px] w-auto shadow-md mt-4" alt="Investor 8" loading="lazy" width="150" height="150">
            </div>

            <div class="flex flex-col items-center">
                <img src="{{ asset('investors/9.png') }}" class="rounded-lg h-auto max-h-[200px] w-auto shadow-md" alt="Investor 9" loading="lazy" width="150" height="150">
                <img src="{{ asset('investors/10.png') }}" class="md:block hidden rounded-lg h-auto max-h-[200px] w-auto shadow-md mt-4" alt="Investor 10" loading="lazy" width="150" height="150">
            </div>
            <div class="flex flex-col items-center">
              <img src="{{ asset('investors/10.png') }}" class="md:hidden rounded-lg h-auto max-h-[200px] w-auto shadow-md mt-4" alt="Investor 10" loading="lazy" width="150" height="150">
            </div>
        </div>
    </div>


    {{-- Portfolio Companies --}}
    <section class="flex mt-[6em] flex-col w-full justify-center items-center px-4">
      <!-- Header Section -->
      <div class="flex flex-col md:flex-row w-full md:w-[68vw] justify-between items-center">
          <div class="flex flex-col justify-start mb-4 md:mb-0 text-center md:text-left">
              <h1 class="text-[2em] md:text-[3em] font-bold leading-none">Portfolio Companies</h1>
              <p class="text-[1em] md:text-[1.7em] text-[#777] mt-3">
                  Take a look at our portfolio companies
              </p>
          </div>
          <div>
              <a href="{{route('portfolio')}}" class="p-3 px-6 rounded-full bg-[#36b37e] font-bold text-white">
                  View All Portfolios
              </a>
          </div>
      </div>
  
      <!-- Portfolio Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 w-[90%] md:w-[70vw] mt-6">
        @foreach ($portfolioDeals as $deal)
            <livewire:portfolio-company :deal="$deal"></livewire:portfolio-company>
        @endforeach  
      </div>
    </section>
  
  
    {{-- Pitch your Startup --}}
    <section class="flex flex-col-reverse md:flex-row mt-[6em] w-full p-6 md:p-[100px] border-box justify-between items-center">
      <!-- Text Content -->
      <div class="flex flex-col justify-between w-full md:w-[1/2] h-full text-center md:text-left">
          <span class="flex flex-col">
              <h1 class="text-[2em] md:text-[3em] font-bold leading-none">Pitch your Startup</h1>
              <p class="mt-6 text-[1em] md:text-[1.2em]">
                Qualify for our monthly showcase to pitch in front of prospective investors.<br>We are a network of 500+ members always looking for startups to invest in.
              </p>
          </span>
          <a target="_blank" href="https://forms.gle/Pr5KdwuZyeiTbq6P7" class="p-3 px-6 shadow-md shadow-gray-200 mt-6 md:mt-10 rounded-full bg-[#eefff1] font-bold text-[#36b37e] self-center md:self-start">
              Send Your Pitch
          </a>
      </div>
  
      <!-- Image Section -->
      <div class="flex flex-col w-full md:w-[1/2] mb-6 md:mb-0">
          <img src="{{ asset('IMG_0944.jpg') }}" alt="team photo" class="w-full h-auto max-h-[300px] md:max-h-[500px] object-cover rounded-lg" width="500" height="300" loading="lazy">
      </div>
    </section>
  
    @auth
      {{-- Deal Listings --}}
      <section class="flex flex-col mt-[6em] w-full bg-[#00877a] py-[100px] md:py-[200px] text-white justify-center items-center">
        <h1 class="text-[2em] md:text-[3em] font-bold text-center">
            Deal Listings
        </h1>
        <p class="my-6 text-[1em] md:text-[1.5em] text-center">
            Live Details to review and invest today!
        </p>
    
        <div class="flex flex-wrap items-center justify-between w-full max-w-[90%] md:max-w-[70vw] mt-6 gap-6">
           
    
            <!-- Deal Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full">
                @foreach ($deals as $deal)
                    <livewire:deal-card :deal="$deal"></livewire:deal-card>
                @endforeach
            </div>
        </div>
    
        <a href="{{route('deals')}}" class="p-3 px-6 mt-8 rounded-full bg-white font-bold text-[#00877a]">
            Explore All Deals
        </a>
    </section>
    
    @endauth
    
    <section class="flex flex-col justify-center text-center w-full py-[50px] md:py-[100px] border-box">
      <h1 class="text-[2em] md:text-[3em] font-bold">
          BAN Resources
      </h1>
      <p class="mt-3 text-[1em] md:text-[1.5em]">
          Bangladesh Angels Hosts events for start-ups and Angel Investors.<br class="hidden md:block">
          Join any of our events to connect with people today!
      </p>
      <div class="bg-white py-6 sm:py-8 lg:py-[20px]">
          <div class="mx-auto max-w-screen-xl px-4 md:px-8">
              <div class="flex flex-col sm:flex-row overflow-hidden text-white justify-start rounded-lg bg-gradient-to-br to-[#022e2e] from-[#156755]">
                  <!-- Image Section -->
                  <div class="h-48 sm:h-auto sm:w-1/2 lg:w-2/5 bg-gray-300">
                      <img src="{{asset('resourcesCover.webp')}}" loading="lazy" alt="BAN Event" class="h-full w-full object-cover" width="400" height="300">
                  </div>
                  <!-- Content Section -->
                  <div class="flex flex-col justify-between p-4 sm:w-1/2 lg:w-3/5 sm:p-8 items-start">
                      <h2 class="mb-4 text-xl md:text-2xl lg:text-3xl font-bold text-left">Networking Event<br>hosted by ShopUp</h2>
                      <div class="flex items-center my-2">
                          <div class="bg-white rounded-full p-3">
                              <img src="{{asset('dateicon.webp')}}" alt="Date Icon" class="h-[20px]" draggable="false" width="20" height="20">
                          </div>
                          <p class="text-left ml-3 text-sm md:text-base">
                              16 - 22 December, 2023<br>
                              08:00 AM to 06:00 PM
                          </p>
                      </div>
                      <div class="flex items-center my-2">
                          <div class="bg-white rounded-full p-3">
                              <img src="{{asset('locationicon.webp')}}" alt="Location Icon" class="h-[20px]" draggable="false" width="20" height="20">
                          </div>
                          <p class="text-left ml-3 text-sm md:text-base">
                              64–65, Kazi Nazrul Islam Avenue,<br>Dhaka-1215
                          </p>
                      </div>
                      
                  </div>
              </div><br><br>
              <a href="{{route('resources')}}" class="px-6 py-3 rounded-full bg-[#eefff1] font-bold text-[#36b37e]">
                  Discover BAN Resources
              </a>
          </div>
      </div>
  </section>
  
  <section class="flex flex-col justify-center items-center py-[50px] md:py-[100px] text-center w-full">
    <h1 class="text-[2em] md:text-[3em] font-bold">
        Our Partners
    </h1>
    <p class="mt-3 text-[1em] md:text-[1.5em]">
        We collaborate with leading investment firms and accelerator programs across the region,<br>co-investing in high-potential startups and guiding founders with industry expertise. Some of our key partners are showcased here.
    </p>
      
    <div class="w-[90%] md:w-[80%] mx-auto mt-8">
        <!-- Founding Partners -->
        <div class="mb-12">
            <h3 class="text-xl font-bold text-[#00877a] mb-6 text-center">Founding Partners</h3>
            <div class="flex flex-wrap justify-center gap-8">
                <a href="https://www.government.nl/ministries/ministry-of-foreign-affairs" target="_blank" class="flex justify-center items-center p-5 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-all bg-white">
                    <img src="{{asset('foreignaffairsnetherland.webp')}}" alt="Foreign Affairs Logo" class="h-16 md:h-20 w-auto object-contain" width="150" height="80" loading="lazy">
                </a>
                <a href="https://aavishkaarcapital.in/" target="_blank" class="flex justify-center items-center p-5 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-all bg-white">
                    <img src="{{asset('capital logo.webp')}}" alt="Capital Logo" class="h-16 md:h-20 w-auto object-contain" width="150" height="80" loading="lazy">
                </a>
            </div>
        </div>
        
        <!-- Industry Partners -->
        <div>
            <h3 class="text-xl font-bold text-[#00877a] mb-6 text-center">Industry Partners</h3>
            <div class="flex flex-wrap justify-center gap-8">
                <a href="https://bida.gov.bd/" target="_blank" class="flex justify-center items-center p-5 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-all bg-white">
                    <img src="{{asset('bidalogo.webp')}}" alt="BIDA Logo" class="h-16 md:h-20 w-auto object-contain" width="150" height="80" loading="lazy">
                </a>
                <a target="_blank" href="https://venture.com.bd/" class="flex justify-center items-center p-5 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-all bg-white">
                    <img src="{{asset('bangladesh venture capital.webp')}}" alt="BCV Logo" class="h-16 md:h-20 w-auto object-contain" width="150" height="80" loading="lazy">
                </a>
                <div class="flex justify-center">
                    <a target="_blank" href="https://sajidafoundation.org/" class="flex justify-center items-center p-5 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-all bg-white max-w-xs">
                        <img src="{{asset('sajidafoundation.webp')}}" alt="Sajida Foundation Logo" class="h-16 md:h-20 w-auto object-contain" width="150" height="80" loading="lazy">
                    </a>
                </div>
                <div class="flex justify-center">
                    <a target="_blank" href="https://lightcastlepartners.com/" class="flex justify-center items-center p-5 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-all bg-white max-w-xs">
                        <img src="{{asset('lcp.svg')}}" alt="LightCastle Partners Logo" class="h-16 md:h-20 w-auto object-contain" width="150" height="80" loading="lazy">
                    </a>
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