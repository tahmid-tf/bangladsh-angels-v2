@extends('layouts.guest')

@section('page_title', 'Forgot Password | Bangladesh Angels Network')

@section('page_content')
<div class="flex px-4 w-[90vw] md:w-[40vw] items-center justify-center">
    <div class="w-full bg-white shadow-lg rounded-lg p-8">
        
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-800">Forgot Your Password?</h2>
            <p class="text-sm text-gray-500 mt-1">Enter your email to receive a reset link.</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-center text-sm text-green-600" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="mt-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input id="email" class="w-full p-3 mt-1 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-green-300 transition duration-200"
                    type="email" name="email" value="{{ old('email') }}" required autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-[#00877a] text-white py-3 rounded-lg font-semibold hover:bg-green-700 focus:ring focus:ring-green-300 transition duration-200">
                    Send Password Reset Link
                </button>
            </div>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-green-600 transition duration-200">Back to Login</a>
        </div>
    </div>
</div>
@endsection
