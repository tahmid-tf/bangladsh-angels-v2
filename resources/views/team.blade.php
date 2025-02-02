@extends('layouts.guest')
@section('page_title','About Us')
@section('page_content')
<!-- Section: Header -->
<section class="container mx-auto mt-16 px-6 lg:flex lg:space-x-12">
    <!-- Left: Images -->
    <div class="lg:w-1/2 grid grid-cols-1 lg:grid-cols-2 gap-6 items-center justify-center">
        <img src="{{asset('DI4A6345.jpg')}}" alt="Handshake" class="rounded-xl w-full h-auto object-cover">
        <img src="{{asset('DSC00467.jpg')}}" alt="Team Photo" class="rounded-xl w-full h-auto object-cover shadow-lg">
    </div>

    <!-- Right: Text Content -->
    <div class="mt-12 lg:mt-0 lg:w-1/2 flex items-center">
        <div>
            <h2 class="text-4xl font-extrabold text-gray-800 mb-6 leading-tight">
                What is Bangladesh Angels Network?
            </h2>
            <p class="text-lg leading-relaxed text-gray-600">
                Bangladesh Angels Network (BAN) is the country’s largest and first angel investing platform, connecting visionary entrepreneurs with a diverse collective of seasoned investors, fostering an ecosystem that drives innovation and economic growth.
With $21.7M+ USD invested across 50+ startups, we provide capital, mentorship, and strategic backing to early-stage companies that are solving real problems and scaling fast. Our network is a dynamic mix of local and global investors, business leaders, and founders who collaborate to unlock market-changing opportunities. We don’t just invest, we build, nurture, and accelerate ventures that have the potential to reshape industries. Whether you're looking to back or build the next industry-defining company, BAN is where it happens.

            </p>
        </div>
    </div>
</section>



<!-- Section: Team and Management -->
<section class="container mx-auto mt-20 px-6">
    <h2 class="text-center text-4xl font-extrabold mb-10">Team and Management</h2>

    <!-- CEO Section (Centered) -->
    <div class="flex justify-center mb-10">
        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition w-80">
            <img src="{{asset('our team/ivy.png')}}" alt="Ivy Huq Russell" class="w-32 h-32 mx-auto rounded-full mb-4">
            <h3 class="text-xl font-bold">Ivy Huq Russell</h3>
            <p class="text-sm text-gray-500">CEO</p>
            <a href="https://www.linkedin.com/in/ivy-huq-russell-417487/" class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer block">in</a>
        </div>
    </div>

    <!-- Other Team Members (Grid Layout) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 justify-center items-center">
        <!-- Team Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <img src="{{asset('our team/mustavi.png')}}" alt="Mustavi Khan" class="w-28 h-28 mx-auto rounded-full mb-4">
            <h3 class="text-lg font-bold">Mustavi Khan</h3>
            <p class="text-sm text-gray-500">Investment Analyst</p>
            <a href="https://www.linkedin.com/in/mustavikhan05/" class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer block">in</a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <img src="{{asset('our team/mohaimenul.png')}}" alt="Mohaimenul Islam" class="w-28 h-28 mx-auto rounded-full mb-4">
            <h3 class="text-lg font-bold">Mohaimenul Islam</h3>
            <p class="text-sm text-gray-500">Investment Analyst</p>
            <a href="https://www.linkedin.com/in/mohaimenul8/" class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer block">in</a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <img src="{{asset('our team/farin.png')}}" alt="Farin Sabrina" class="w-28 h-28 mx-auto rounded-full mb-4">
            <h3 class="text-lg font-bold">Farin Sabrina</h3>
            <p class="text-sm text-gray-500">Investment Analyst</p>
            <a href="https://www.linkedin.com/in/farinsabrina/" class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer block">in</a>
        </div>
    </div>
</section>


<!-- Section: Governing Board -->
<section class="container mx-auto mt-20 px-6">
    <h2 class="text-center text-4xl font-extrabold mb-6">Governing Board</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <h3 class="text-lg font-bold">Sajid Rahman</h3>
            <p class="text-sm text-gray-500">Chief Executive</p>
            <p class="text-sm text-gray-500">Telenor Health AS</p>
            <img src="{{asset('our team/sajid.png')}}" alt="Sajid Rehman" class="mt-3 w-28 h-28 mx-auto rounded-full mb-4">
           
            <br><a href="https://www.linkedin.com/in/rahmansajid/" class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer">in</a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <h3 class="text-lg font-bold">Samad Miraly</h3>
            <p class="text-sm text-gray-500">Co Founder</p>
            <p class="text-sm text-gray-500">Startup Dhaka</p>
            <img src="{{asset('our team/samad.png')}}" alt="samad miraly" class="mt-3 w-28 h-28 mx-auto rounded-full mb-4">
   
            <a href="https://www.linkedin.com/in/miraly/" class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer">in</a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <h3 class="text-lg font-bold">Minhaz Anwar</h3>
            <p class="text-sm text-gray-500">Chief Storyteller</p>
            <p class="text-sm text-gray-500">Better Stories</p>
            <img src="{{asset('our team/minhaz.png')}}" alt="Minhaz Anwar" class="mt-3 w-28 h-28 mx-auto rounded-full mb-4">
            
            <br><a href="https://www.linkedin.com/in/minhazanwar/" class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer">in</a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <h3 class="text-lg font-bold">Tina Jabeen</h3>
            <p class="text-sm text-gray-500">Investment Advisor</p>
            <p class="text-sm text-gray-500">Startup Bangladesh</p>
            <img src="{{asset('our team/tina.png')}}" alt="Tina Jabeen" class="mt-3 w-28 h-28 mx-auto rounded-full mb-4">
            
            <br><a href="https://www.linkedin.com/in/tinajabeen/" class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer">in</a>
        </div>
        <!-- Repeat other governing board cards -->
    </div>
</section>

@endsection