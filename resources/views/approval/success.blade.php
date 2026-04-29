@extends('layouts.guest')

@section('page_title', 'Registration Successful | Bangladesh Angels Network')

@section('page_content')
<section class="w-full px-4 py-10 md:py-14 bg-gradient-to-b from-white to-green-50/70">
    <div class="mx-auto max-w-4xl">
        <div class="rounded-3xl border border-green-100 bg-white/95 shadow-xl overflow-hidden">
            <div class="bg-[#0a5554] px-6 py-8 md:px-10 md:py-10 text-center">
                <img src="{{ asset('logo.webp') }}" alt="Bangladesh Angels Network" class="h-14 md:h-16 mx-auto mb-4">
                <h1 class="text-2xl md:text-3xl font-bold text-white tracking-tight">Registration Successful</h1>
                <p class="mt-3 text-sm md:text-base text-green-50/90">Welcome to Bangladesh Angels Network</p>
            </div>

            <div class="px-6 py-8 md:px-10 md:py-10">
                <div class="rounded-2xl border border-green-100 bg-green-50/70 p-5 md:p-6">
                    <p class="text-gray-700 text-base md:text-lg">Thank you for registering with Bangladesh Angels Network.</p>
                    <p class="mt-3 text-gray-600">Your application is now under review. This process usually takes 1-2 business days.</p>
                    <p class="mt-3 text-gray-600">Once approved, you will gain access to deals, DeckVue, and our investor community.</p>
                </div>

                <div class="mt-7 border-t border-green-100 pt-6">
                    <h2 class="text-lg md:text-xl font-bold text-[#0f3d34]">What happens next</h2>
                    <ul class="mt-4 space-y-2 text-gray-600">
                        <li>Our team reviews your investor application</li>
                        <li>You receive an email once your account is approved</li>
                        <li>After approval, all platform features become available</li>
                        <li>Your dashboard shows current investment opportunities</li>
                    </ul>
                    <p class="mt-5 text-gray-600">Need help? Contact <a href="mailto:support@bdangels.co" class="font-semibold text-[#0a5554] hover:underline">support@bdangels.co</a></p>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center rounded-full bg-[#0f3d34] px-6 py-3 text-sm font-bold text-white shadow-md transition-colors hover:bg-[#156755]">
                        Return to Homepage
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection