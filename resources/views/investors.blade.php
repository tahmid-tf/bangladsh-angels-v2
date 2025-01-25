@extends('layouts.guest')
@section('page_title','Our Investors | Bangladesh Angel Investors Limited')
@section('page_content')
<section class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-center mb-4">Our Angel Investors</h1>
    <p class="text-center text-gray-600 mb-12">
        Join a Global network of over 450 executives and operators who have built and expanded companies all over the world.
    </p>

    

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Investor Card -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center mb-4">
                <img src="https://via.placeholder.com/64" alt="Investor" class="w-16 h-16 rounded-full mr-4">
                <div>
                    <h3 class="text-lg font-semibold">Sajid Amit</h3>
                    <p class="text-sm text-gray-500">Fintech Expert, Center for Enterprise and Society, ULAB</p>
                </div>
            </div>
            <p class="text-gray-600 mb-4">
                "From $10k to $100k in 2 years! I invested early in a fintech startup through the platform. In just three years, my $10k has grown to $150k as the company scaled and was acquired. It's been an incredible journey with Bangladesh Angels so far."
            </p>
            <p class="text-gray-500 text-sm">Member Since: 2012</p>
            <a href="#" class="text-blue-600 mt-4 inline-block"><i class="fab fa-linkedin"></i> LinkedIn</a>
        </div>

        <!-- Copy above card for each investor -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center mb-4">
                <img src="https://via.placeholder.com/64" alt="Investor" class="w-16 h-16 rounded-full mr-4">
                <div>
                    <h3 class="text-lg font-semibold">Sayma Rahman</h3>
                    <p class="text-sm text-gray-500">Founder and CEO, SR Ventures and Consultancy</p>
                </div>
            </div>
            <p class="text-gray-600 mb-4">
                "400% ROI from Tech Startup Exit. I took a chance with BAN on a software company in its seed stage. After three years, the company was bought by a larger investor. My initial $25k investment turned into $100k—a 400% return!"
            </p>
            <p class="text-gray-500 text-sm">Member Since: 2012</p>
            <a href="#" class="text-blue-600 mt-4 inline-block"><i class="fab fa-linkedin"></i> LinkedIn</a>
        </div>

        <!-- Additional cards would go here following the same format -->
    </div>

</section>

@endsection