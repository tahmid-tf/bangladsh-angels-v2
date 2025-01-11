@extends('layouts.guest')
@section('page_title','Success | Bangladesh Angels Network')
@section('page_content')
<div class="container mx-auto px-4 py-12 text-center">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">Thank You for Your Purchase!</h1>
    <p class="text-gray-500">We’ve sent an email to your provided email address with the payment details.</p>
    <p class="text-gray-500">Feel free to contact us if you have any questions.</p>
    <a href="{{ route('home') }}" class="mt-6 inline-block px-6 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition">Back to Home</a>
</div>
@endsection