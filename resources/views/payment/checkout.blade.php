@extends('layouts.guest')
@section('page_title','Checkout | Bangladesh Angels Network')
@section('page_content')

<!-- Page Container -->
<div class="container mx-auto px-4 py-12">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Let’s finish powering you up!</h1>
        <p class="text-gray-500">Your selected plan is shown below.</p>
    </div>

    <!-- Main Content -->
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <!-- Hidden Inputs for Plan and Price -->
        <input type="hidden" name="plan" value="{{ session('checkout.plan.name', 'Default Plan') }}">
        <input type="hidden" name="price" value="{{ session('checkout.plan.price', '0') }}">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Selected Plan Section -->
            <div class="bg-white shadow-md rounded-lg p-6 lg:col-span-3">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Selected Plan</h2>
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-xl font-bold text-gray-800">{{ session('checkout.plan.name', 'Default Plan') }}</p>
                        <p class="text-gray-500">${{ session('checkout.plan.price', '0') }} /yr</p>
                    </div>
                    <a href="{{ route('plans') }}" class="text-green-600 hover:underline">Change Plan</a>
                </div>
            </div>

            <!-- Left: Billing Address -->
            <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Billing Address -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Billing Address</h2>
                        <div class="space-y-4">
                            <input 
                                type="text" 
                                name="name" 
                                placeholder="Full Name" 
                                value="{{ auth()->user() ? auth()->user()->name : old('name') }}" 
                                class="w-full border rounded-md px-4 py-2 text-gray-700 focus:ring focus:ring-green-200"
                                required
                            >
                            <input 
                                type="text" 
                                name="phone" 
                                placeholder="Phone Number" 
                                value="{{ auth()->user() ? auth()->user()->phone : old('phone') }}" 
                                class="w-full border rounded-md px-4 py-2 text-gray-700 focus:ring focus:ring-green-200"
                                required
                            >
                            <input 
                                type="email" 
                                name="email" 
                                placeholder="Email Address" 
                                value="{{ auth()->user() ? auth()->user()->email : old('email') }}" 
                                class="w-full border rounded-md px-4 py-2 text-gray-700 focus:ring focus:ring-green-200"
                                required
                            >
                            <input 
                                type="text" 
                                name="address" 
                                placeholder="Address" 
                                value="{{ auth()->user() && auth()->user()->address ? auth()->user()->address : old('address') }}" 
                                class="w-full border rounded-md px-4 py-2 text-gray-700 focus:ring focus:ring-green-200"
                            >
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Payment Method</h2>
                        <div class="space-y-4">
                            <!-- Send Payment Details -->
                            <label class="flex items-center space-x-4">
                                <input type="radio" name="payment" value="email" class="text-green-600 focus:ring focus:ring-green-200" checked>
                                <span class="flex items-center">
                                    Send Payment details to my email
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Summary -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Summary</h2>
                <ul class="space-y-4">
                    <li class="flex justify-between text-gray-700">
                        <span>Subscription</span>
                        <span class="bg-green-100 text-green-600 text-sm font-semibold px-2 py-1 rounded-full">
                            {{ session('checkout.plan.name', 'Default Plan') }}
                        </span>
                    </li>
                    <li class="text-gray-800 text-4xl font-bold text-center">
                        ${{ session('checkout.plan.price', '0') }} <span class="text-lg font-normal text-gray-500">/yr</span>
                    </li>
                    <li class="flex justify-between text-gray-700">
                        <span>Total Billed</span>
                        <span>${{ session('checkout.plan.price', '0') }}</span>
                    </li>
                </ul>
                <button type="submit" class="mt-6 bg-green-600 text-white w-full py-2 rounded-full hover:bg-green-700 transition">
                    Complete Checkout
                </button>
                <p class="text-center text-sm text-gray-500 mt-4">
                    Secure credit card payment <br>
                    This is a secure 128-bit SSL encrypted payment
                </p>
            </div>
        </div>
    </form>

</div>

@endsection
