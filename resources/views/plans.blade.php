@extends('layouts.guest')
@section('page_title','Subscription Plans | Bangladesh Angels Network')
@section('page_content')
<!-- Pricing Section -->
<section class="container mx-auto px-4 py-12">
    <!-- Header -->
    <div class="text-center mb-10">
        <h2 class="text-2xl font-bold text-gray-800">Flexible plans for your investment needs</h2>
        <p class="text-gray-500">Choose your plan and make investment work like magic</p>
    </div>

    <!-- Pricing Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Core Plan -->
        <div class="border rounded-lg p-6 shadow-sm bg-white text-center">
            <h3 class="text-lg font-bold text-gray-800 mb-2 uppercase">Core</h3>
            <p class="text-4xl font-extrabold text-gray-800 mb-2">
                $399 <span class="text-lg font-normal text-gray-500">/yr</span>
            </p>
            <div class="flex justify-center mb-4">
                <img class="h-[100px]" src="{{asset('plan_core.webp')}}" alt="Icon">
            </div>
            <ul class="text-gray-600 space-y-2">
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>3 deal reviews monthly</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Review and commit deals</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-gray-400">✘</span> <span>Investment deals</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-gray-400">✘</span> <span>Advanced security</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-gray-400">✘</span> <span>Permissions & workflows</span>
                </li>
            </ul>
            <button class="mt-6 bg-gray-200 text-gray-500 py-2 px-6 rounded-full cursor-not-allowed">
                Current Plan
            </button>
        </div>

        <!-- Advanced Plan -->
        <div class="border rounded-lg p-6 shadow-sm bg-white text-center relative">
            <h3 class="text-lg font-bold text-gray-800 mb-2 uppercase">Advanced</h3>
            <p class="text-4xl font-extrabold text-gray-800 mb-2">
                $599 <span class="text-lg font-normal text-gray-500">/yr</span>
            </p>
            <div class="flex justify-center mb-4">
                <img class="h-[100px]" src="{{asset('plan_advanced.webp')}}" alt="Icon">
            </div>
            <span class="absolute top-4 right-4 bg-purple-200 text-purple-600 text-xs font-semibold px-2 py-1 rounded-full uppercase">
                Popular
            </span>
            <ul class="text-gray-600 space-y-2">
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>3 deal reviews monthly</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Review and commit deals</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Investment deals</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-gray-400">✘</span> <span>Advanced security</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-gray-400">✘</span> <span>Permissions & workflows</span>
                </li>
            </ul>
            <a href="{{route('checkout')}}" class="mt-6 bg-green-600 text-white py-2 px-6 rounded-full hover:bg-green-700 transition">
                Choose Advanced
            </a>
        </div>

        <!-- Institutional Plan -->
        <div class="border rounded-lg p-6 shadow-sm bg-white text-center">
            <h3 class="text-lg font-bold text-gray-800 mb-2 uppercase">Institutional</h3>
            <p class="text-4xl font-extrabold text-gray-800 mb-2">
                $999 <span class="text-lg font-normal text-gray-500">/yr</span>
            </p>
            <div class="flex justify-center mb-4">
                <img class="h-[100px]" src="{{asset('plan_institutional.webp')}}" alt="Icon">
            </div>
            <ul class="text-gray-600 space-y-2">
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>3 deal reviews monthly</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Review and commit deals</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Investment deals</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Advanced security</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Permissions & workflows</span>
                </li>
            </ul>
            <button class="mt-6 bg-green-600 text-white py-2 px-6 rounded-full hover:bg-green-700 transition">
                Choose Institutional
            </button>
        </div>
    </div>
</section>

@endsection