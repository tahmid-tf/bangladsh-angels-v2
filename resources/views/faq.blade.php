@extends('layouts.guest')
@section('page_title','FAQ | Bangladesh Angels Network')
@section('page_content')
<!-- Hero Section -->
<section class="relative bg-green-700 w-full text-white py-20">
    <div class="container mx-auto text-center">
        <h1 class="text-5xl font-extrabold mb-6">How can we help you?</h1>
        <div class="relative w-full max-w-md mx-auto">
            <!-- Search Bar -->
            <input
                type="text"
                placeholder="Search support"
                class="w-full rounded-full border-none py-4 px-6 text-gray-700 focus:outline-none shadow-lg"
            />
            <!-- Search Icon -->
            <span class="absolute right-5 top-1/2 transform -translate-y-1/2 text-green-600 text-2xl">
                🔍
            </span>
        </div>
    </div>
</section>

<!-- Cards Section -->
<section class="container flex justify-center items-center w-full">
    <!-- Card 1 -->
    <div class="flex items-center justify-center border rounded-lg p-8 shadow-lg bg-white hover:shadow-2xl transition duration-200">
        <div class="flex items-center text-center">
            <img src="{{asset('pitch.webp')}}" alt="Pitch Icon" class="w-16 mx-auto mb-4">
            <p class="text-lg font-bold text-gray-700 ml-3">I want to pitch</p>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="flex items-center justify-center border rounded-lg p-8 shadow-lg bg-white hover:shadow-2xl transition duration-200">
        <div class="flex items-center text-center">
            <img src="{{asset('investicon.webp')}}" alt="Invest Icon" class="w-16 mx-auto mb-4">
            <p class="text-lg font-bold text-gray-700 ml-3">I want to invest</p>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="container mx-auto mt-16 px-4">
    <h2 class="text-center text-3xl font-bold mb-8 text-gray-800">FAQ</h2>
    <p class="text-center text-gray-500 mb-8">
        Discover frequently asked questions that people face
    </p>
    
    <!-- FAQ List -->
    <div class="space-y-4 max-w-3xl mx-auto">
        <!-- FAQ Item -->
        <details class="bg-white border rounded-lg p-5 shadow-sm">
            <summary class="font-semibold cursor-pointer">Who are angel investors? How is it different from Venture Capital?</summary>
            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                Angel investors are high-net-worth individuals and family offices who invest in early-stage businesses...
            </p>
        </details>

        <!-- FAQ Item -->
        <details class="bg-white border rounded-lg p-5 shadow-sm">
            <summary class="font-semibold cursor-pointer">Why do I need Angel Investor?</summary>
            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                Angel investors bring expertise, mentorship, and funding to early-stage startups to accelerate growth.
            </p>
        </details>

        <!-- FAQ Item -->
        <details class="bg-white border rounded-lg p-5 shadow-sm">
            <summary class="font-semibold cursor-pointer">What are the sectors where angel investors invest?</summary>
            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                Angel investors typically focus on technology, healthcare, consumer products, and other scalable industries.
            </p>
        </details>
    </div>
</section>
@endsection