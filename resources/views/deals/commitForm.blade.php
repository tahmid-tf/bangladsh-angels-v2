@extends('layouts.investor')
@section('page_title','Commit Form | Bangladesh Angels Network Limited')
@section('page_content')

<div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
    <!-- Deal Details Section -->
    <div class="mb-6">
        <img 
            src="{{ $deal->getCoverUrl() }}" 
            alt="{{ $deal->title }}" 
            class="w-full rounded-lg shadow-md object-cover"
        >
        <h2 class="text-2xl font-bold text-gray-800 mt-4">{{ $deal->title }}</h2>
        <p class="text-gray-600 text-sm mt-1">{{ $deal->sector }}</p>
        <p class="text-gray-700 mt-2">
            <span class="font-semibold">Investment Stage:</span> {{ $deal->investment_stage }}
        </p>
        <p class="text-gray-700 mt-1">
            <span class="font-semibold">Amount Seeking:</span> ${{ number_format($deal->amount_seeking, 2) }}
        </p>
        <p class="text-gray-600 mt-3">{{ $deal->description }}</p>
    </div>

    <!-- Commit Investment Form -->
    <h1 class="text-xl font-bold text-gray-800 mb-4">Commit Investment</h1>
    <form action="{{route('deal.commit',$deal->id)}}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="deal_id" value="{{ $deal->id }}">

        <!-- Investment Amount -->
        <div class="mb-4">
            <label for="amount" class="block text-gray-700 font-semibold mb-2">How much can you invest? *</label>
            <input 
                type="number" 
                id="amount" 
                name="amount" 
                class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:ring-green-200" 
                placeholder="Enter amount in USD" 
                required>
        </div>

        <!-- Deadline -->
        <div class="mb-4">
            <label for="deadline" class="block text-gray-700 font-semibold mb-2">By when? *</label>
            <input 
                type="date" 
                id="deadline" 
                name="deadline" 
                class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:ring-green-200" 
                required>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-center w-full">
            <button 
                type="submit" 
                class="bg-green-600  text-white px-6 py-2 rounded-lg hover:bg-green-700 w-full transition">
                Commit
            </button>
        </div>
    </form>
</div>
@endsection