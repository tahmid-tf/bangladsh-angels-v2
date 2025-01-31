@extends('layouts.investor')
@section('page_title','Deals | Bangladesh Angels Network Limited')
@section('page_content')
<div class="flex w-[70%] justify-start flex-col">
    <div class="flex w-full justify-between">
        <h1 class="text-3xl font-bold mb-6 ">All Deals</h1>
    </div>
    <div class="flex space-x-4 mb-6">
        <a href="{{route('deals')}}" class="text-gray-500 pb-2">All</a>
        <a href="{{route('deals.invest')}}" class="text-gray-500 pb-2">Invest</a>
        <a href="{{route('deals.commit')}}" class="text-gray-500 pb-2">Commit</a>
        <a href="{{route('deals.review')}}" class="font-bold border-b-2 border-black pb-2">Review</a>
    </div>    
</div>

<!-- Deals Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-[70%]">
    <!-- Card Component -->
    @forelse ($deals as $deal)
        <livewire:deal-card :deal="$deal"></livewire:deal-card>
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
