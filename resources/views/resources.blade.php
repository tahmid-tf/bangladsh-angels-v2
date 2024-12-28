@extends('layouts.guest')
@section('page_title','Resources | Bangladesh Angels Network Limited')
@section('page_content')
<section class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-gray-800">BAN Resources</h1>
        <p class="text-gray-600">Discover webinars and BAN events to network and learn more about us</p>
    </div>

    <!-- BAN Events Section -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">BAN Events</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Event Card -->
            <div class="bg-white rounded-lg shadow p-4">
                <img src="https://via.placeholder.com/150" alt="Event Image" class="w-full h-40 object-cover rounded-md mb-4">
                <h3 class="text-lg font-bold text-gray-800 mb-2">BAN Mini Showcase Powered by ShopUp</h3>
                <p class="text-gray-600 text-sm mb-2">16-22 December, 2023</p>
                <p class="text-gray-600 text-sm mb-2">08:00 AM - 06:00 PM</p>
                <p class="text-gray-600 text-sm mb-4">64-65, Kazi Nazrul Islam Avenue, Dhaka-1215</p>
                <button class="bg-green-500 text-white px-4 py-2 rounded-lg w-full hover:bg-green-600">Register</button>
            </div>
            <!-- Repeat the above card as needed -->
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center space-x-2">
            <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded">1</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded">2</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded">3</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded">...</button>
        </div>
    </div>

    <!-- BAN Webinars Section -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800 mb-6">BAN Webinars</h2>
        <p class="text-gray-600 mb-6">Join BAN webinars to learn all you need to upscale your business</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Webinar Card -->
            <div class="bg-white rounded-lg shadow p-4">
                <img src="https://via.placeholder.com/150" alt="Webinar Image" class="w-full h-40 object-cover rounded-md mb-4">
                <h3 class="text-lg font-bold text-gray-800 mb-2">BAN Monsoon Showcase</h3>
                <p class="text-gray-600 text-sm mb-2">Sunday, October 13</p>
                <p class="text-gray-600 text-sm mb-2">7:00 PM - 9:00 PM GMT+6</p>
                <p class="text-gray-600 text-sm mb-4">Zoom</p>
                <button class="bg-green-500 text-white px-4 py-2 rounded-lg w-full hover:bg-green-600">Register</button>
            </div>
            <!-- Repeat the above card as needed -->
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center space-x-2">
            <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded">1</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded">2</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded">3</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded">...</button>
        </div>
    </div>
</section>

@endsection