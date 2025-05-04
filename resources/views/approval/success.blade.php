@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-8 mt-10">
        <div class="text-center mb-8">
            <img src="{{ asset('Logo Base@4x.png') }}" alt="Bangladesh Angels Network" class="h-16 mx-auto mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Registration Successful!</h2>
        </div>

        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
            <p class="text-lg text-gray-700 mb-4">Thank you for registering with Bangladesh Angels Network.</p>
            
            <p class="text-gray-600 mb-4">Your application has been received and our team is currently reviewing it thoroughly. This process typically takes 1-2 business days.</p>
            
            <p class="text-gray-600 mb-4">Once approved, you'll gain full access to all network features including deals, resources, and our investor community.</p>
        </div>

        <div class="border-t border-gray-200 pt-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">What happens next?</h3>
            
            <ul class="list-disc pl-6 text-gray-600 space-y-2 mb-6">
                <li>Our team will review your investor application</li>
                <li>You'll receive an email notification when your account is approved</li>
                <li>After approval, you can access all platform features</li>
                <li>Your dashboard will display available investment opportunities</li>
            </ul>

            <p class="text-gray-600 mb-4">We carefully evaluate each application to maintain a high-quality network of investors and ensure the best experience for all members.</p>

            <p class="text-gray-600">If you have any questions about your application status, please contact our support team at <a href="mailto:support@bdangels.co" class="text-blue-600 hover:underline">support@bdangels.co</a></p>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Return to Homepage
            </a>
        </div>
    </div>
</div>
@endsection