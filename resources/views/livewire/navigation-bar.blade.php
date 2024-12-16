<section class="fixed flex z-10 top-0 text-center justify-center items-center w-full">
    <div class="align-self-center w-[70vw] bg-gray-100/30 backdrop-blur-lg z-50 shadow-md align-center items-center flex flex-row justify-between  rounded-full mt-6">
        <a href="{{route('home')}}">
            <img src="{{asset('logo.webp')}}" class="h-[40px] mx-[40px] my-[20px]" alt="Bangladesh Angels Network Logo">
        </a>
        <div>
            <ul class="flex font-bold">
                <li class="m-3"><a href="{{route('deals')}}">Deals</a></li>
                <li class="m-3">BAN Investors</li>
                <li class="m-3">Portfolio</li>
                <li class="m-3">BAN Resources</li>
                <li class="m-3">Our Team</li>
            </ul>
        </div>
        <div class="mr-6">
            @guest
            <a href="{{route('login')}}" class="p-3 pl-4 pr-4 rounded-full bg-[#36b37e] font-bold text-white">
                Login
            </a>    
            @endguest
            
        </div>
    </div>
</section>