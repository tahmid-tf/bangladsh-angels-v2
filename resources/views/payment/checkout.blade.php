@extends('layouts.guest')
@section('page_title','Checkout | Bangladesh Angels Network')
@section('page_content')

    <!-- Page Container -->
    <div class="container mx-auto px-4 py-12">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Let’s finish powering you up!</h1>
            <p class="text-gray-500">Professional plan is right for you.</p>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left: Billing Address -->
            <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Billing Address -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Billing Address</h2>
                        <form class="space-y-4">
                            <input type="text" placeholder="Julian Weber" class="w-full border rounded-md px-4 py-2 text-gray-700 focus:ring focus:ring-green-200">
                            <input type="text" placeholder="365-374-4961" class="w-full border rounded-md px-4 py-2 text-gray-700 focus:ring focus:ring-green-200">
                            <input type="email" placeholder="julian.weber@selisegroup.com" class="w-full border rounded-md px-4 py-2 text-gray-700 focus:ring focus:ring-green-200">
                            <input type="text" placeholder="19034 Verna Unions Apt. 164 - Honolulu" class="w-full border rounded-md px-4 py-2 text-gray-700 focus:ring focus:ring-green-200">
                        </form>
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Payment Method</h2>
                        <form class="space-y-4">
                            <!-- SSLCommerz -->
                            <label class="flex items-center space-x-4">
                                <input type="radio" name="payment" class="text-green-600 focus:ring focus:ring-green-200">
                                <span class="flex items-center">
                                    SSLCommerz
                                    <img src="https://via.placeholder.com/50" alt="SSLCommerz Logo" class="ml-2 h-5">
                                </span>
                            </label>

                            <!-- PayPal -->
                            <label class="flex items-center space-x-4">
                                <input type="radio" name="payment" class="text-green-600 focus:ring focus:ring-green-200">
                                <span class="flex items-center">
                                    Paypal
                                    <img src="https://via.placeholder.com/50" alt="PayPal Logo" class="ml-2 h-5">
                                </span>
                            </label>

                            <!-- Credit Card -->
                            <label class="flex items-center space-x-4">
                                <input type="radio" name="payment" checked class="text-green-600 focus:ring focus:ring-green-200">
                                <span class="flex items-center">
                                    Credit Card
                                    <img src="https://via.placeholder.com/50" alt="Credit Card Logos" class="ml-2 h-5">
                                </span>
                            </label>
                            <input type="text" placeholder="**** **** **** 5678" class="w-full border rounded-md px-4 py-2 text-gray-700 focus:ring focus:ring-green-200">
                            <a href="#" class="text-green-600 text-sm font-semibold">+ Add new card</a>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right: Summary -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Summary</h2>
                <ul class="space-y-4">
                    <li class="flex justify-between text-gray-700">
                        <span>Subscription</span>
                        <span class="bg-green-100 text-green-600 text-sm font-semibold px-2 py-1 rounded-full">Premium</span>
                    </li>
                    <li class="flex justify-between text-gray-700 items-center">
                        <span>Billed Monthly</span>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-10 h-6 bg-gray-200 rounded-full peer-checked:bg-green-600"></div>
                        </label>
                    </li>
                    <li class="text-gray-800 text-4xl font-bold text-center">
                        $9.99 <span class="text-lg font-normal text-gray-500">/mo</span>
                    </li>
                    <li class="flex justify-between text-gray-700">
                        <span>Total Billed</span>
                        <span>$9.99</span>
                    </li>
                </ul>
                <button class="mt-6 bg-green-600 text-white w-full py-2 rounded-full hover:bg-green-700 transition">
                    Upgrade My Plan
                </button>
                <p class="text-center text-sm text-gray-500 mt-4">
                    Secure credit card payment <br>
                    This is a secure 128-bit SSL encrypted payment
                </p>
            </div>
        </div>
    </div>

@endsection