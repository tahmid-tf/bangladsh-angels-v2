@extends('layouts.guest')

@section('page_title', 'Account Under Review | Bangladesh Angels Network')

@section('page_content')
<section class="w-full px-4 py-10 md:py-14 bg-gradient-to-b from-white to-green-50/70">
    <div class="mx-auto max-w-4xl">
        <div class="rounded-3xl border border-green-100 bg-white/95 shadow-xl overflow-hidden">
            <div class="bg-[#0a5554] px-6 py-8 md:px-10 md:py-10 text-center">
                <img src="{{ asset('logo.webp') }}" alt="Bangladesh Angels Network" class="h-14 md:h-16 mx-auto mb-4">
                <h1 class="text-2xl md:text-3xl font-bold text-white tracking-tight">Account Under Review</h1>
                <p class="mt-3 text-sm md:text-base text-green-50/90">Your registration is in progress</p>
            </div>

            <div class="px-6 py-8 md:px-10 md:py-10">
                <div class="rounded-2xl border border-green-100 bg-green-50/70 p-5 md:p-6">
                    <p class="text-gray-700 text-base md:text-lg">Thank you for registering with Bangladesh Angels Network. Your account is currently under review by our team.</p>
                    <p class="mt-3 text-gray-600">This process usually takes 1-2 business days while we verify details for a secure and trusted community.</p>
                    <p class="mt-3 text-gray-600">After approval, you will gain access to deals, DeckVue, and our investor network.</p>
                </div>

                <div class="mt-7 border-t border-green-100 pt-6">
                    <h2 class="text-lg md:text-xl font-bold text-[#0f3d34]">What happens next</h2>
                    <ul class="mt-4 space-y-2 text-gray-600">
                        <li>You receive an email notification once your account is approved</li>
                        <li>You can then access all platform features</li>
                        <li>Your dashboard is updated with investment opportunities</li>
                    </ul>
                    <p class="mt-5 text-gray-600">Need help? Contact <a href="mailto:support@bdangels.co" class="font-semibold text-[#0a5554] hover:underline">support@bdangels.co</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection