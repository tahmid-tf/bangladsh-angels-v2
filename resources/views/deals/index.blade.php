@extends('layouts.investor')
@section('page_title','Deals | Bangladesh Angels Network Limited')
@section('page_content')
<div class="flex w-[70%] justify-start flex-col">
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
            <span class="text-green-700">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
            <span class="text-red-700">&times;</span>
        </button>
    </div>
@endif
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
        <a href="{{route('deals')}}" class="font-bold border-b-2 border-black pb-2">All</a>
        <a href="{{route('deals.invest')}}" class="text-gray-500 pb-2">Invest</a>
        <a href="{{route('deals.commit')}}" class="text-gray-500 pb-2">Commit</a>
        <a href="{{route('deals.review')}}" class="text-gray-500 pb-2">Review</a>
    </div>    
</div>


<!-- Deals Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-[70%]">
    <!-- Card Component -->
    @forelse ($deals as $deal)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <a href="{{ route('deal.view', $deal->id) }}">
            <img src="{{ $deal->getCoverUrl() }}" alt="Deal Image" class="w-full h-40 object-cover">
        </a>
        <div class="p-4">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-bold">{{ $deal->title }}</h2>
                <span class="bg-gray-200 text-xs px-2 py-1 rounded-full">{{ ucfirst($deal->sector) }}</span>
            </div>
            <p class="text-gray-500 text-sm mt-2">
                {{ $deal->description }}
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
            <form method="POST" action="{{ route('deal.invest',$deal->id) }}" onsubmit="return confirm('Are you sure you want to perform this action?');">
                @csrf
                <input type="hidden" name="deal_id" value="{{ $deal->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <form action="{{route('deal.invest', $deal->id)}}" class="mt-6" method="POST">
                    @csrf
                    <input type="text" name="user_id" value="{{auth()->id()}}" hidden id="user_id">
                    <input type="text" name="deal_id" value="{{$deal->id}}" hidden id="deal_id">
                    <input type="submit" value="{{ucfirst($deal->type)}}" class="px-6 w-full mt-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                </form>
                
            </form>
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
