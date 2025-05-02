@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-8 mt-10">
        <div class="text-center mb-8">
            <img src="{{ asset('Logo Base@4x.png') }}" alt="Bangladesh Angels Network" class="h-16 mx-auto mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Account Under Review</h2>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
            <p class="text-lg text-gray-700 mb-4">Thank you for registering with Bangladesh Angels Network. Your account is currently under review by our team.</p>
            
            <p class="text-gray-600 mb-4">This process typically takes 1-2 business days. During this time, our team verifies your details to ensure a secure and trusted community for all our members.</p>
            
            <p class="text-gray-600 mb-4">Once your account is approved, you'll gain full access to all features including deals, resources, and our investor network.</p>
        </div>

        <div class="border-t border-gray-200 pt-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">What happens next?</h3>
            
            <ul class="list-disc pl-6 text-gray-600 space-y-2 mb-6">
                <li>You'll receive an email notification when your account has been approved</li>
                <li>You can then access all of our platform features</li>
                <li>Your dashboard will be updated with investment opportunities</li>
            </ul>

            <p class="text-gray-600">If you have any questions about your account status, please contact our support team at <a href="mailto:support@bdangels.co" class="text-blue-600 hover:underline">support@bdangels.co</a></p>
        </div>

    </div>
</div>
@endsection