@extends('layouts.investor')
@section('page_title','Deals | Bangladesh Angels Network Limited')
@section('page_content')
<section class="bg-[#0a5554] py-12">
    <!-- Hero Section -->
    <div class="container mx-auto px-6 lg:flex lg:items-center text-white">
        <!-- Left Content -->
        <div class="lg:w-full">
            <h1 class="text-4xl font-extrabold mb-4">Jatri</h1>
            <p class="text-lg  mb-6">
                One-stop travel solution for Car Rental, online Bus & Launch Tickets. Simplify your journey!
            </p>
            <div class="flex items-center space-x-8 mb-6">
                <div>
                    <p class=" text-sm">Investment stage</p>
                    <p class="text-lg font-semibold">Pre Seed</p>
                </div>
                <div>
                    <p class=" text-sm">Amount Seeking</p>
                    <p class="text-lg font-semibold">৳ 9,80,000</p>
                </div>
            </div>
            <button class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                Invest
            </button>
        </div>

        <!-- Right Content -->
        <div class="lg:w-1/2 mt-6 lg:mt-0">
            <img src="https://via.placeholder.com/600x400" alt="Jatri Image" class="w-full h-auto rounded-lg shadow-md">
            <button class="mt-4 px-6 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg shadow hover:bg-gray-300">
                View Pitch Deck
            </button>
        </div>
    </div>
</section>

<!-- Company Bio Section -->
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold mb-4">Company Bio</h2>
    <p class="text-gray-700 leading-relaxed">
        Jatri is a technology-driven platform revolutionizing public transportation in Bangladesh. Since its inception, Jatri has been
        dedicated to streamlining the commuter experience through innovative solutions that improve safety, reliability, and convenience.
        By leveraging cutting-edge digital technologies, Jatri offers a seamless platform for ticketing, scheduling, and real-time
        tracking, ensuring a more efficient and accessible transport ecosystem.
    </p>
</section>

<!-- Metrics Section -->
<section class="bg-gray-50 py-12">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <p class="text-2xl font-bold">
                    Over 2 million registered users
                </p>
                <p class="text-gray-500">With 15% month-over-month growth in adoption.</p>
            </div>
            <div class="text-center">
                <p class="text-2xl font-bold">
                    ৳50,000+ monthly revenue
                </p>
                <p class="text-gray-500">With 60% derived from recurring partnerships with fleet operators.</p>
            </div>
            <div class="text-center">
                <p class="text-2xl font-bold">TAM of $3 billion in South Asia</p>
                <p class="text-gray-500">In the urban transport market, with $200M directly addressable in Bangladesh.</p>
            </div>
        </div>
    </div>
</section>

<!-- Key Metrics Section -->
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold mb-8">Key Metrics</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-bold mb-2">Growth Traction</h3>
            <p class="text-gray-700 text-sm">
                User Base: Over X million registered users with Y% month-over-month growth.
            </p>
            <p class="text-gray-700 text-sm">
                Daily Active Users (DAU): 2K+ commuters rely on Jatri daily for hassle-free transit solutions.
            </p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-bold mb-2">Impact Metrics</h3>
            <p class="text-gray-700 text-sm">Time Saved: [Number] hours saved annually for users through efficient scheduling and real-time updates.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-bold mb-2">Revenue Highlights</h3>
            <p class="text-gray-700 text-sm">Monthly Revenue: $XX,XXX+ with a [Y%] growth rate in the last 12 months.</p>
        </div>
    </div>
</section>

<!-- More Live Deals Section -->
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold mb-8">More Live Deals</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <img src="https://via.placeholder.com/300x150" alt="Deal Image" class="w-full h-40 object-cover rounded-lg mb-4">
            <h3 class="text-lg font-bold">Jatri</h3>
            <p class="text-gray-500 text-sm mb-4">
                One-stop travel solution for Car Rental, online Bus & Launch Tickets. Simplify your journey!
            </p>
            <button class="px-6 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition">
                Invest
            </button>
        </div>
    </div>
</section>
@endsection