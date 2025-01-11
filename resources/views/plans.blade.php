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
                    <span class="text-green-600">✔</span> <span>Complete deal access</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Data room access (with approval)</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Active deal participation</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Investment capabilities</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-gray-400">✘</span> <span>Portfolio monitoring</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-gray-400">✘</span> <span>Full access to dataroom</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-gray-400">✘</span> <span>Full access of deal flows & showcases</span>
                </li>
            </ul>
            <form method="POST" action="{{ route('checkout') }}">
                @csrf
                <input type="hidden" name="plan_name" value="Core">
                <input type="hidden" name="plan_price" value="399">
                <button type="submit" class="mt-6 bg-green-600 text-white py-2 px-6 rounded-full hover:bg-green-700 transition">
                    Choose Core
                </button>
            </form>
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
            <ul class="text-gray-600 space-y-2 mb-6">
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Complete Deal Access</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Full Access to Data Room</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Active Deal Participation</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Investment Capabilities</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Portfolio Monitoring</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Full access of Deal Flows & Showcases</span>
                </li>
            </ul class="">
            <form method="POST" action="{{ route('checkout') }}">
                @csrf
                <input type="hidden" name="plan_name" value="Advanced">
                <input type="hidden" name="plan_price" value="599">
                <button type="submit" class="mt-6 bg-green-600 text-white py-2 px-6 rounded-full hover:bg-green-700 transition">
                    Choose Advanced
                </button>
            </form>
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
                    <span class="text-green-600">✔</span> <span>Complete Deal Access</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Full Access to Data Room</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Active Deal Participation</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Investment Capabilities</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Portfolio Monitoring</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>Full access of Deal Flows & Showcases</span>
                </li>
                <li class="flex items-center justify-center space-x-2">
                    <span class="text-green-600">✔</span> <span>3-4 Additional Account access</span>
                </li>
            </ul>
            <form method="POST" action="{{ route('checkout') }}">
                @csrf
                <input type="hidden" name="plan_name" value="Institutional">
                <input type="hidden" name="plan_price" value="999">
                <button type="submit" class="mt-6 bg-green-600 text-white py-2 px-6 rounded-full hover:bg-green-700 transition">
                    Choose Institutional
                </button>
            </form>
        </div>
    </div>
</section>

@endsection