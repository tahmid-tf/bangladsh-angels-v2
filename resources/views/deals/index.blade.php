@extends('layouts.investor')
@section('page_title','Deals | Bangladesh Angels Network Limited')
@section('page_content')
<div class="flex w-full md:w-[70%] justify-start flex-col">
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
        <h1 class="text-3xl font-bold mb-6">Active Deals</h1>
    </div>
</div>


<!-- Deals Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full md:w-[70%]">
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
