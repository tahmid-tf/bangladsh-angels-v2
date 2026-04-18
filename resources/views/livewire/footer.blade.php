<footer class="flex flex-col md:flex-row w-full mt-[100px]">
  <div class="flex w-full md:w-1/4 justify-center py-[5vw] md:py-[3vw] px-[5vw] items-center border-box shadow-inner">
    <img src="{{ asset('logo.webp') }}" class="h-[50px] w-auto max-w-[150px] sm:max-w-[200px] object-contain" alt="Logo">
  </div>

  <section class="flex flex-col pt-[30px] md:pt-[100px] px-[20px] md:px-[50px] border-box bg-[#1b7f69] w-full">
    <div class="flex flex-col md:flex-row justify-between w-full">
      {{-- Row 1 --}}
      <div class="flex flex-col text-white mb-6 md:mb-0">
        <h1 class="font-bold text-xl md:text-base text-center md:text-left">
          Bangladesh Angels
        </h1>
        <ul class="flex flex-col mt-2 items-center md:items-start">
          <li class="mb-2">
            <a href="mailto:hello@bdangels.co" class="hover:underline" title="Email Bangladesh Angels Network">Contact Us</a>
          </li>
          <li>
            <a href="{{ route('faq') }}" class="hover:underline" title="Frequently asked questions about BAN">FAQ</a>
          </li>
        </ul>
      </div>
      
      {{-- Socials --}}
      <div class="flex flex-col h-full justify-between text-white md:ml-6">
        <span class="hidden md:flex justify-end cursor-pointer mb-[100px]" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });">
          <img src="{{ asset('up_arrow.webp') }}" alt="up_arrow" class="h-[50px]">
        </span>
        
        <span class="flex flex-row w-full justify-center md:justify-between gap-4 mb-6 md:mb-0">
          <a target="_blank" href="https://www.linkedin.com/company/bangladesh-angels/" aria-label="LinkedIn">
            <div class="flex items-center justify-center w-[40px] h-[40px] hover:opacity-80 transition-opacity">
              <img src="{{asset('linkedIn.webp')}}" class="w-auto h-full" alt="linkedIn">
            </div>
          </a>
          <a target="_blank" href="https://www.facebook.com/bdangels.co" aria-label="Facebook">
            <div class="flex items-center justify-center w-[40px] h-[40px] hover:opacity-80 transition-opacity">
              <img src="{{asset('fb_icon.webp')}}" class="w-auto h-full" alt="facebook">
            </div>
          </a>
          <a target="_blank" href="https://x.com/BDAngelsNetwork?t=XxABWIT-yVk-X8ujKnYorA&s=09" aria-label="Twitter">
            <div class="flex items-center justify-center w-[40px] h-[40px] hover:opacity-80 transition-opacity">
              <img src="{{asset('twitter.webp')}}" class="w-auto h-full" alt="twitter">
            </div>
          </a>
        </span>
      </div>
    </div>

    <div class="flex flex-col md:flex-row my-6 justify-between text-white">
      <small class="text-center md:text-left mb-4 md:mb-0">© Bangladesh Angels. All rights reserved.</small>
      <div class="flex flex-row justify-center md:justify-between">
        <a href="{{asset('MoU.pdf')}}" class="underline hover:text-gray-200 transition-colors">Terms & Conditions</a>
      </div>
    </div>

    <span class="flex md:hidden justify-center cursor-pointer mt-2 mb-6" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });">
      <div class="bg-white rounded-full p-2 shadow-md hover:bg-gray-100 transition-colors">
        <img src="{{ asset('up_arrow.webp') }}" alt="up_arrow" class="h-[25px]">
      </div>
    </span>
  </section>
</footer>