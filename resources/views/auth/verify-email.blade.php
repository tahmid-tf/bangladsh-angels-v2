@extends('layouts.guest')

@section('page_title','Verify Your Email | Bangladesh Angels Network')

@section('page_content')
<div class="flex px-4 w-[90vw] md:w-[40vw] items-center justify-center">
    <div class="w-full bg-white shadow-lg rounded-lg p-8">
        
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-800">Verify Your Email</h2>
            <p class="text-sm text-gray-500 mt-1">
                Thanks for signing up! Before getting started, please verify your email address by clicking the link we sent to your inbox.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mt-4 text-center text-sm font-medium text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-6 flex flex-col space-y-4">
            <!-- Resend Verification Email -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full bg-[#00877a] text-white py-3 rounded-lg font-semibold hover:bg-[#20978c] focus:ring focus:ring-[#20978c] transition duration-200">
                    Resend Verification Email
                </button>
            </form>

            <!-- Log Out -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-sm text-gray-600 hover:text-[#20978c] transition duration-200">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
