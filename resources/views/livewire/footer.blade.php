<footer class="flex w-full mt-[100px]">
    <div class="flex w-1/4 justify-center py-[100px] px-[50px] border-box items-center" style="box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);">
      <img src="{{asset('logo.webp')}}" class="h-[50px]" alt="">
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
              <a href="#">About Us</a>
            </li>
            <li>
              <a href="#">Contact Us</a>
            </li>
            <li>
              <a href="#">Angel Academy</a>
            </li>
            <li>
              <a href="#">FAQ</a>
            </li>
          </ul>
        </div>
        {{-- Row 2 --}}
        <div class="flex flex-col text-white ml-6">
          <h1 class="font-bold">
            For Startups
          </h1>
          <ul class="flex flex-col">
            <li>
              <a href="#">About Us</a>
            </li>
            <li>
              <a href="#">Contact Us</a>
            </li>
            <li>
              <a href="#">Angel Academy</a>
            </li>
            <li>
              <a href="#">FAQ</a>
            </li>
          </ul>
        </div>
        {{-- Row 3 --}}
        <div class="flex flex-col text-white ml-6">
          <h1 class="font-bold">
            For Angels
          </h1>
          <ul class="flex flex-col">
            <li>
              <a href="#">About Us</a>
            </li>
            <li>
              <a href="#">Contact Us</a>
            </li>
            <li>
              <a href="#">Angel Academy</a>
            </li>
            <li>
              <a href="#">FAQ</a>
            </li>
          </ul>
        </div>
        {{-- Socials --}}
        <div class="flex flex-col h-full  justify-between text-white ml-6">
            <span class="flex justify-end cursor-pointer" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });">
                <img src="{{ asset('up_arrow.webp') }}" alt="up_arrow" class="h-[50px]">
            </span>
            
          <span class="flex flex-row w-full justify-between">
            <img src="{{asset('ig_icon.webp')}}" class="h-[40px]" alt="instagram">
            <img src="{{asset('linkedIn.webp')}}" class="h-[40px]" alt="linkedIn">
            <img src="{{asset('fb_icon.webp')}}" class="h-[40px]" alt="facebook">
            <img src="{{asset('twitter.webp')}}" class="h-[40px]" alt="twitter">
          </span>
        </div>
      </div>
      <div class="flex flex-row my-6 justify-between text-white">
        <small>© Bangladesh Angels. All rights reserved.</small>
        <div class="flex flex-row justify-between">
          <a href="#" class="underline mx-2">Refund Policy</a>
          <a href="#" class="underline mx-2">Terms & Conditions</a>
          <a href="#" class="underline mx-2">Privacy Policy</a>
        </div>
      </div>
    </section>
  </footer>