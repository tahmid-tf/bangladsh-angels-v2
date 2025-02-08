@extends('layouts.guest')

@section('page_title','Forgot Password | Bangladesh Angels Network')

@section('page_content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-800">Reset Your Password</h2>
            <p class="text-sm text-gray-500 mt-1">Enter a new password to regain access.</p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="mt-6">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" class="w-full p-3 mt-1 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-green-300 transition duration-200"
                    type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input id="password" class="w-full p-3 mt-1 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-green-300 transition duration-200"
                    type="password" name="password" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                <input id="password_confirmation" class="w-full p-3 mt-1 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-green-300 transition duration-200"
                    type="password" name="password_confirmation" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Reset Button -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 focus:ring focus:ring-green-300 transition duration-200">
                    Reset Password
                </button>
            </div>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-green-600 transition duration-200">Back to Login</a>
        </div>
    </div>
</div>
@endsection
