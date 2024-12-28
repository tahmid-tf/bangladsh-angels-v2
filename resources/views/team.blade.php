@extends('layouts.guest')
@section('page_title','About Us')
@section('page_content')
<!-- Section: Header -->
<section class="container mx-auto mt-16 px-6 lg:flex lg:space-x-12">
    <!-- Left: Images -->
    <div class="lg:w-1/2 space-y-6">
        <img src="https://via.placeholder.com/500x350" alt="Handshake" class="rounded-xl shadow-lg w-full object-cover">
        <img src="https://via.placeholder.com/500x350" alt="Team Photo" class="rounded-xl shadow-lg w-full object-cover">
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
            <img src="https://via.placeholder.com/150" alt="Mustavi Khan" class="w-28 h-28 mx-auto rounded-full mb-4">
            <h3 class="text-lg font-bold">Mustavi Khan</h3>
            <p class="text-sm text-gray-500">Investment Analyst</p>
            <span class="inline-block bg-blue-100 text-blue-600 px-3 py-1 text-xs font-semibold rounded-full mt-3">Fintech</span>
            <div class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer">in</div>
        </div>

        <!-- Repeat similar cards -->
        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <img src="https://via.placeholder.com/150" alt="Tazriana Lodhi" class="w-28 h-28 mx-auto rounded-full mb-4">
            <h3 class="text-lg font-bold">Tazriana Lodhi</h3>
            <p class="text-sm text-gray-500">Investment Analyst</p>
            <span class="inline-block bg-blue-100 text-blue-600 px-3 py-1 text-xs font-semibold rounded-full mt-3">Fintech</span>
            <div class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer">in</div>
        </div>
    </div>
</section>

<!-- Section: Governing Board -->
<section class="container mx-auto mt-20 px-6">
    <h2 class="text-center text-4xl font-extrabold mb-6">Governing Board</h2>
    <p class="text-center text-gray-500 mb-12">Bangladesh Angels will provide you support if you have any problems.</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition">
            <img src="https://via.placeholder.com/150" alt="Sajid Rehman" class="w-28 h-28 mx-auto rounded-full mb-4">
            <h3 class="text-lg font-bold">Sajid Rehman</h3>
            <p class="text-sm text-gray-500">Chief Executive</p>
            <p class="text-xs mt-3 italic text-gray-600">“Scelerisque ornare quisque magna ipsum.”</p>
            <div class="mt-3 text-blue-600 font-bold text-2xl cursor-pointer">in</div>
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