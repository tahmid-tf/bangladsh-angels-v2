<footer class="flex w-full mt-[100px]">
  <div class="flex w-full sm:w-1/4 justify-center py-[10vw] px-[5vw] items-center border-box shadow-inner">
    <img src="{{ asset('logo.webp') }}" class="h-[50px] w-auto max-w-[150px] sm:max-w-[200px] object-contain" alt="Logo">
  </div>

    <section class="flex flex-col pt-[100px] px-[50px] border-box bg-[#1b7f69] w-full">
      <div class="flex flex-row justify-between w-full">
        {{-- Row 1 --}}
        <div class="flex flex-col text-white">
          <h1 class="font-bold">
            Bangladesh Angels
          </h1>
          <ul class="flex flex-col">
            
            <li>
              <a href="mailto:hello@bdangels.co">Contact Us</a>
            </li>
            <li>
              <a href="{{route('faq')}}">FAQ</a>
            </li>
          </ul>
        </div>
        
        {{-- Socials --}}
        <div class="flex flex-col h-full  justify-between text-white ml-6">
            <span class="flex justify-end cursor-pointer" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });">
                <img src="{{ asset('up_arrow.webp') }}" alt="up_arrow" class="h-[50px]">
            </span>
            
            <span class="flex flex-row flex-wrap w-full justify-center sm:justify-between gap-4">
              <a target="_blank" href="https://www.linkedin.com/company/bangladesh-angels/">
                  <div class="flex items-center justify-center w-[40px] h-[40px]">
                      <img src="{{asset('linkedIn.webp')}}" class="w-auto h-full" alt="linkedIn">
                  </div>
              </a>
              <a target="_blank" href="https://www.facebook.com/bdangels.co">
                  <div class="flex items-center justify-center w-[40px] h-[40px]">
                      <img src="{{asset('fb_icon.webp')}}" class="w-auto h-full" alt="facebook">
                  </div>
              </a>
              <a target="_blank" href="https://x.com/BDAngelsNetwork?t=XxABWIT-yVk-X8ujKnYorA&s=09">
                  <div class="flex items-center justify-center w-[40px] h-[40px]">
                      <img src="{{asset('twitter.webp')}}" class="w-auto h-full" alt="twitter">
                  </div>
              </a>
          </span>
          
        </div>
      </div>
      <div class="flex flex-row my-6 justify-between text-white">
        <small>© Bangladesh Angels. All rights reserved.</small>
        <div class="flex flex-row justify-between">
          <a href="{{asset('MoU.pdf')}}" class="underline mx-2">Terms & Conditions</a>
        </div>
      </div>
    </section>
  </footer>