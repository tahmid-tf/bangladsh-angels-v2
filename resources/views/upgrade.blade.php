@extends('layouts.guest')
@section('page_title', 'Upgrade | Bangladesh Angels Network Limited')

@push('head_meta')
    <x-seo-meta
        title="Upgrade | Bangladesh Angels Network Limited"
        description="Upgrade your Bangladesh Angels Network membership to unlock live deals, investor workspaces, and advanced member benefits."
        :canonical="route('upgrade.page')"
        :image="asset('unlockdeals.PNG')"
    />
@endpush

@section('page_content')
<!-- Modal Background Overlay -->
<div id="modal-overlay" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50">
    <!-- Modal Container -->
    <div class="bg-white rounded-xl shadow-lg w-11/12 md:w-1/2 mx-auto p-8 text-center">
        <!-- Icon -->
        <div class="flex justify-center mb-4">
            <img src="{{asset('unlockdeals.PNG')}}" alt="">
        </div>
        <!-- Title -->
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Upgrade to unlock deals</h2>
        <!-- Subtitle -->
        <p class="text-gray-500 mb-6">Please upgrade to advanced or institutional plans to unlock deals.</p>
        <!-- Buttons -->
        <div class="flex justify-center space-x-4">
            <a href="{{route('plans')}}" class="px-6 py-3 bg-green-500 text-white font-semibold rounded-full hover:bg-green-600 transition">View Plans</a>
            <a href="{{route('home')}}" class="px-6 py-3 border border-green-500 text-green-500 font-semibold rounded-full hover:bg-green-50 transition">Go back</a>
        </div>
    </div>
</div>
<div class="flex w-[70%] justify-start flex-col">
    <div class="flex w-full justify-between">
        <h1 class="text-3xl font-bold mb-6 ">All Deals</h1>
        <button class="flex items-center space-x-2 px-5 py-2 border-2 border-green-300 rounded-full hover:bg-green-100 transition duration-200">
            <!-- Icon (Simple Filter Icon) -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#36b37e" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M6 8l6 6m0 0l6-6m-6 6V8"></path>
            </svg>
            <!-- Text -->
            <span class="text-green-500 font-bold">Filters</span>
        </button>
    </div>
    <div class="flex flex-wrap gap-x-4 gap-y-2 mb-6">
        <a href="#" class="font-bold border-b-2 border-black pb-2 text-sm max-w-[min(100%,22rem)] leading-snug text-center sm:text-left">Commit Investment / Express Interest to Invest</a>
        <a href="#" class="text-gray-500 pb-2">Commit</a>
        <a href="#" class="text-gray-500 pb-2">Review</a>
    </div>    
</div>

<!-- Deals Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-[70%]">
    <!-- Card Component -->
    @php
        $i = 9;
    @endphp
   @while ($i > 0)
   <div class="bg-white rounded-lg shadow-md overflow-hidden">
       <img src="https://via.placeholder.com/300x150" alt="Deal Image" class="w-full h-40 object-cover">
       <div class="p-4">
           <div class="flex items-center justify-between">
               <h2 class="text-lg font-bold">Jatri</h2>
               <span class="bg-gray-200 text-xs px-2 py-1 rounded-full">Transport</span>
           </div>
           <p class="text-gray-500 text-sm mt-2">
               One-stop travel solution for Car Rental, online Bus & Launch Tickets. Simplify your travel!
           </p>
           <div class="flex justify-between items-center mt-4 text-sm">
               <div class="text-center">
                   <p class="text-gray-400">Investment stage</p>
                   <p class="font-semibold">Pre Seed</p>
               </div>
               <div class="text-center">
                   <p class="text-gray-400">Amount Seeking</p>
                   <p class="font-semibold">৳ 9,80,000</p>
               </div>
           </div>
           <button type="button" class="w-full mt-4 bg-[#36b37e] text-white px-2 py-2.5 rounded-full text-xs font-semibold leading-snug hover:bg-green-600 transition">
               Commit Investment / Express Interest to Invest
           </button>
       </div>
   </div>
   @php
       $i--; // Decrement the counter
   @endphp
@endwhile
    
    
</div>
@endsection