@extends('layouts.app')
@section('content')


    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-center">
                    <div class="mb-8">
                        <svg class="mx-auto h-16 w-16 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">Payment Unsuccessful</h1>
                    <p class="text-lg text-gray-600 mb-8">We're sorry, but your payment could not be processed successfully.</p>
                    
                    <div class="bg-gray-50 p-6 rounded-lg mb-8 max-w-lg mx-auto">
                        <h2 class="text-xl font-semibold mb-4 text-left">What went wrong?</h2>
                        <div class="text-left text-gray-600">
                            <p class="mb-2">Your payment might have failed due to one of the following reasons:</p>
                            <ul class="list-disc pl-5 space-y-1">
                                <li>Insufficient funds in your account</li>
                                <li>Card declined by your bank</li>
                                <li>Incorrect payment information</li>
                                <li>Connection issues during payment processing</li>
                            </ul>
                            
                            @if(isset($error_message) && $error_message)
                                <div class="mt-4 p-3 bg-red-50 border border-red-100 rounded">
                                    <p class="text-red-700">Error details: {{ $error_message }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <a href="{{ route('upgrade.page') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            <svg class="mr-2 -ml-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Try Again
                        </a>
                    </div>
                    
                    <div class="mt-6 text-gray-600">
                        <p>If you continue to experience issues, please contact us at <a href="mailto:support@bdangels.co" class="text-blue-500 hover:underline">support@bdangels.co</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection