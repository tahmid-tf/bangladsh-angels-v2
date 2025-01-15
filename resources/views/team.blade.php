@extends('layouts.guest')
@section('page_title','About Us')
@section('page_content')
<!-- Section: Header -->
<section class="container mx-auto mt-16 px-6 lg:flex lg:space-x-12">
    <!-- Left: Images -->
    <div class="flex lg:w-1/2 space-y-6">
        <img src="{{asset('our team/1.jpg')}}" alt="Handshake" class="rounded-xl  w-full object-cover">
        <img src="{{asset('our team/2.jpg')}}" alt="Team Photo" class="rounded-xl shadow-lg w-full object-cover">
    </div>

    <!-- Right: Text Content -->
    <div class="lg:w-1/2 flex items-center">
        <div>
            <h2 class="text-4xl font-extrabold text-gray-800 mb-6">What are Bangladesh Angels?</h2>
            <p class="text-lg leading-relaxed text-gray-600">
                Bangladesh Angels is the country’s first angel investing platform, founded with a mission to elevate the country’s startup entrepreneurs to the highest level.
                Registered as an independent, not-for-profit company, it is a collaborative endeavor led by Avashikhar & the Dutch Global Good Fund, 
                bringing together leaders in the local entrepreneurial ecosystem to share a passion to create value and growth for startups.
            </p>
        </div>
    </div>
</section>

<!-- Section: Team and Management -->
<section class="container mx-auto mt-20 px-6">
    <h2 class="text-center text-4xl font-extrabold mb-4">Team and Management</h2>
    <p class="text-center text-gray-500 mb-12">The faces behind Bangladesh Angels</p>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Team Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <img src="{{asset('our team/mustavi.png')}}" alt="Mustavi Khan" class="w-28 h-28 mx-auto rounded-full mb-4">
            <h3 class="text-lg font-bold">Mustavi Khan</h3>
            <p class="text-sm text-gray-500">Investment Analyst</p>
            <span class="inline-block bg-blue-100 text-blue-600 px-3 py-1 text-xs font-semibold rounded-full mt-3">Fintech</span>
            <br><a href="https://www.linkedin.com/in/mustavikhan05/" class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer">in</a>
        </div>

        <!-- Repeat similar cards -->
        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <img src="{{asset('our team/tazriana.png')}}" alt="Tazriana Lodhi" class="w-28 h-28 mx-auto rounded-full mb-4">
            <h3 class="text-lg font-bold">Tazriana Lodhi</h3>
            <p class="text-sm text-gray-500">Investment Analyst</p>
            <span class="inline-block bg-blue-100 text-blue-600 px-3 py-1 text-xs font-semibold rounded-full mt-3">Fintech</span>
            <br>
            <a href="https://www.linkedin.com/in/tazriana-lodhi-/" class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer">in</a>
        </div>
        <!-- Repeat similar cards -->
        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <img src="{{asset('our team/mohaimenul.png')}}" alt="Mohaimenul Islam" class="w-28 h-28 mx-auto rounded-full mb-4">
            <h3 class="text-lg font-bold">Mohaimenul Islam</h3>
            <p class="text-sm text-gray-500">Investment Analyst</p>
            <span class="inline-block bg-blue-100 text-blue-600 px-3 py-1 text-xs font-semibold rounded-full mt-3">Fintech</span>
            <br><a href="https://www.linkedin.com/in/mohaimenul8/" class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer">in</a>
        </div>
        <!-- Repeat similar cards -->
        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <img src="{{asset('our team/farin.png')}}" alt="Farin Sabrina" class="w-28 h-28 mx-auto rounded-full mb-4">
            <h3 class="text-lg font-bold">Farin Sabrina</h3>
            <p class="text-sm text-gray-500">Investment Analyst</p>
            <span class="inline-block bg-blue-100 text-blue-600 px-3 py-1 text-xs font-semibold rounded-full mt-3">Fintech</span>
            <br><a href="https://www.linkedin.com/in/farinsabrina/" class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer">in</a>
        </div>
    </div>
</section>

<!-- Section: Governing Board -->
<section class="container mx-auto mt-20 px-6">
    <h2 class="text-center text-4xl font-extrabold mb-6">Governing Board</h2>
    <p class="text-center text-gray-500 mb-12">Bangladesh Angels will provide you support if you have any problems.</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <h3 class="text-lg font-bold">Sajid Rahman</h3>
            <p class="text-sm text-gray-500">Chief Executive</p>
            <p class="text-sm text-gray-500">Telenor Health AS</p>
            <img src="{{asset('our team/sajid.png')}}" alt="Sajid Rehman" class="mt-3 w-28 h-28 mx-auto rounded-full mb-4">
            <p class="text-xs mt-3 italic text-gray-600">“Scelerisque ornare quisque magna ipsum.”</p>
            <br><a href="https://www.linkedin.com/in/rahmansajid/" class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer">in</a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <h3 class="text-lg font-bold">Samad Miraly</h3>
            <p class="text-sm text-gray-500">Co Founder</p>
            <p class="text-sm text-gray-500">Startup Dhaka</p>
            <img src="{{asset('our team/samad.png')}}" alt="samad miraly" class="mt-3 w-28 h-28 mx-auto rounded-full mb-4">
            <p class="text-xs mt-3 italic text-gray-600">“Scelerisque ornare quisque magna ipsum.”</p>
            <a href="https://www.linkedin.com/in/miraly/" class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer">in</a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <h3 class="text-lg font-bold">Minhaz Anwar</h3>
            <p class="text-sm text-gray-500">Chief Storyteller</p>
            <p class="text-sm text-gray-500">Better Stories</p>
            <img src="{{asset('our team/minhaz.png')}}" alt="Minhaz Anwar" class="mt-3 w-28 h-28 mx-auto rounded-full mb-4">
            <p class="text-xs mt-3 italic text-gray-600">“Scelerisque ornare quisque magna ipsum.”</p>
            <br><a href="https://www.linkedin.com/in/minhazanwar/" class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer">in</a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <h3 class="text-lg font-bold">Tina Jabeen</h3>
            <p class="text-sm text-gray-500">Investment Advisor</p>
            <p class="text-sm text-gray-500">Startup Bangladesh</p>
            <img src="{{asset('our team/tina.png')}}" alt="Tina Jabeen" class="mt-3 w-28 h-28 mx-auto rounded-full mb-4">
            <p class="text-xs mt-3 italic text-gray-600">“Scelerisque ornare quisque magna ipsum.”</p>
            <br><a href="https://www.linkedin.com/in/tinajabeen/" class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer">in</a>
        </div>
        <!-- Repeat other governing board cards -->
    </div>
</section>

<!-- Section: Testimonials -->
<section class="bg-green-900 text-white py-20 mt-16">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold mb-6">People who love us</h2>
        <p class="max-w-2xl mb-12 text-gray-300 leading-relaxed">
            With an aim to fill the early-stage financing gap and provide advisory support to startups, 
            the network engages in multiple activities...
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-bold">Jesmin Akhter</h3>
                <p class="text-sm italic mt-3 text-gray-300">
                    "I’m eager to learn from BAN’s expertise and leverage their network..."
                </p>
            </div>

            <div>
                <h3 class="text-lg font-bold">Zahin Rahman</h3>
                <p class="text-sm italic mt-3 text-gray-300">
                    "I feel as though Bangladesh’s startup ecosystem is on the cusp of growth..."
                </p>
            </div>
        </div>
    </div>
</section>
@endsection