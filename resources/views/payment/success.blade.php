@extends('layouts.guest')
@section('page_title','Success | Bangladesh Angels Network')
@section('page_content')
<div class="container mx-auto px-4 py-12 text-center">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">Thank You for Your Purchase!</h1>
    <p class="text-gray-500">We’ve sent an email to your provided email address with the payment details.</p>
    <p class="text-gray-500">Feel free to contact us if you have any questions.</p>
    <table class="mt-6">
        <th>Analyst</th>
        <th>Contact</th>
        <tr>
            <td class="text-left">
                Mohaimenul Islam
            </td>
            <td class="text-left">
                <a href="tel:+8801731814993">+8801731814993</a>
            </td>
        </tr>
        <tr>
            <td class="text-left">
                Mustavi Khan
            </td>
            <td class="text-left">
                <a href="tel:+8801727612346">+8801727612346</a>
                
            </td>
        </tr>
        <tr>
            <td class="text-left">
                Farin Sabrina
            </td>
            <td class="text-left">
                <a href="tel:+8801705181801">+8801705181801</a>
            </td>
        </tr>
        <tr>
            <td class="text-left">
                Rifat Ara Bohny
            </td>
            <td class="text-left">
                <a href="tel:+8801687387288">+8801687387288</a> 
            </td>
        </tr>
    </table>
    <a href="{{ route('home') }}" class="mt-6 inline-block px-6 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition">Back to Home</a>
</div>
@endsection