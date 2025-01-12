@extends('layouts.investor')
@section('page_title','Deals | Bangladesh Angels Network Limited')
@section('page_content')
<div class="flex w-[70%] justify-start flex-col">
    <div class="flex w-full justify-between">
        <h1 class="text-3xl font-bold mb-6 ">All Deals</h1>
        <button class="flex items-center space-x-2 px-5 py-2 border-2 border-green-300 rounded-full hover:bg-green-100 transition duration-200">
            <!-- Icon (Simple Filter Icon) -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#36b37e" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M6 8l6 6m0 0l6-6m-6 6V8"></path>
            </svg>
            <!-- Text -->
            <span class="text-green-500 font-bold">Filters</span>
        </button>
    </div>
    <div class="flex space-x-4 mb-6">
        <a href="{{route('deals')}}" class="text-gray-500 pb-2">All</a>
        <a href="{{route('deals.invest')}}" class="font-bold border-b-2 border-black pb-2">Invest</a>
        <a href="{{route('deals.commit')}}" class="text-gray-500 pb-2">Commit</a>
        <a href="{{route('deals.review')}}" class="text-gray-500 pb-2">Review</a>
    </div>    
</div>

<!-- Deals Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-[70%]">
    <!-- Card Component -->
    @forelse ($deals as $deal)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <a href="{{route('deal.view',$deal->id)}}">
                <img src="{{$deal->getCoverUrl()}}" alt="Deal Image" class="w-full h-40 object-cover">
            </a>
            <div class="p-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold">{{$deal->title}}</h2>
                    <span class="bg-gray-200 text-xs px-2 py-1 rounded-full">Transport</span>
                </div>
                <p class="text-gray-500 text-sm mt-2">
                    {{$deal->description}}
                </p>
                <div class="flex justify-between items-center mt-4 text-sm">
                    <div class="text-center">
                        <p class="text-gray-400">Investment Stage</p>
                        <p class="font-semibold">{{ $deal->investment_stage }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-gray-400">Amount Seeking</p>
                        <p class="font-semibold">$ {{ $deal->amountSeeking() }}</p>
                    </div>
                </div>
                <button class="w-full mt-4 bg-[#36b37e] text-white py-2 rounded-full font-semibold hover:bg-green-600 transition">
                    Invest
                </button>
            </div>
        </div>        
    @empty
    No Deals in this section
    @endforelse
    @php
        $i = 9;
    @endphp
   @while ($i > 0)
   
   @php
       $i--; // Decrement the counter
   @endphp
@endwhile
    
    
</div>
@endsection
