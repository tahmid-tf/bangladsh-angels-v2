@extends('layouts.guest')
@section('page_title','Resources | Bangladesh Angels Network Limited')
@section('page_content')
<section class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-gray-800">Resources</h1>
        <p class="text-gray-600">Discover webinars and BAN events to network and learn more about us</p>
    </div>

    <!-- BAN Events Section -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Events</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Event Card -->
            <a target="_blank" href="https://www.linkedin.com/posts/bangladesh-angels_banminishowcase2024-bangladeshangels-activity-7199468873224499200-mg9_?utm_source=social_share_send&utm_medium=member_desktop_web" class="bg-white rounded-lg shadow p-4">
                <img src="{{ asset('resources/1.PNG') }}" alt="Event Image" class="w-full h-40 object-cover rounded-md mb-4">
                <h3 class="text-lg font-bold text-gray-800 mb-2">BAN Mini Showcase Powered by ShopUp</h3>
                <p class="text-gray-600 text-sm mb-2">16-22 December, 2023</p>
                <p class="text-gray-600 text-sm mb-2">08:00 AM - 06:00 PM</p>
                <p class="text-gray-600 text-sm mb-4">64-65, Kazi Nazrul Islam Avenue, Dhaka-1215</p>
            </a>
            <!-- Event Card -->
            <a target="_blank" href="https://vimeo.com/965767648?share=copy" class="bg-white rounded-lg shadow p-4">
                <img src="https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg" alt="Event Image" class="w-full h-40 object-cover rounded-md mb-4">
                <h3 class="text-lg font-bold text-gray-800 mb-2">BAN Spring Virtual Showcase </h3>
                <p class="text-gray-600 text-sm mb-2">2024</p>
                {{-- <p class="text-gray-600 text-sm mb-2">08:00 AM - 06:00 PM</p> --}}
                {{-- <p class="text-gray-600 text-sm mb-4">64-65, Kazi Nazrul Islam Avenue, Dhaka-1215</p> --}}
            </a>
            <!-- Event Card -->
            <a target="_blank" href="https://vimeo.com/965767648?share=copy" class="bg-white rounded-lg shadow p-4">
                <img src="https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg" alt="Event Image" class="w-full h-40 object-cover rounded-md mb-4">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Gender Lens Investing </h3>
                <p class="text-gray-600 text-sm mb-2">2024</p>
                {{-- <p class="text-gray-600 text-sm mb-2">08:00 AM - 06:00 PM</p> --}}
                {{-- <p class="text-gray-600 text-sm mb-4">64-65, Kazi Nazrul Islam Avenue, Dhaka-1215</p> --}}
            </a>
            
        </div>

        
    </div>
    <!-- BAN Events Section -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Webinars</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Event Card -->
            <a target="_blank" href="https://vimeo.com/932260771/e13f5211a8?share=copy" class="bg-white rounded-lg shadow p-4">
                <img src="{{asset('resources/2.PNG')}}" alt="Event Image" class="w-full h-40 object-cover rounded-md mb-4">
                <h3 class="text-lg font-bold text-gray-800 mb-2">How to Acquire and Grow SMBs </h3>
                <p class="text-gray-600 text-sm mb-2">April 9, 2024</p>
                {{-- <p class="text-gray-600 text-sm mb-2">08:00 AM - 06:00 PM</p> --}}
                {{-- <p class="text-gray-600 text-sm mb-4">64-65, Kazi Nazrul Islam Avenue, Dhaka-1215</p> --}}
            </a>
            <!-- Event Card -->
            <a target="_blank" href="https://vimeo.com/890633531/1b7f033edf?share=copy" class="bg-white rounded-lg shadow p-4">
                <img src="{{asset('resources/3.PNG')}}" alt="Event Image" class="w-full h-40 object-cover rounded-md mb-4">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Bloom Fellowship Employer Session with LCP </h3>
                <p class="text-gray-600 text-sm mb-2">December 2, 2023</p>
                {{-- <p class="text-gray-600 text-sm mb-2">08:00 AM - 06:00 PM</p> --}}
                {{-- <p class="text-gray-600 text-sm mb-4">64-65, Kazi Nazrul Islam Avenue, Dhaka-1215</p> --}}
            </a>
            
        </div>

        
    </div>
</section>

@endsection