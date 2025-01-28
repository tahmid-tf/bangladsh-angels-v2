@extends('layouts.guest')
@section('page_title','Portfolio | Bangladesh Angel Investors Ltd.')
@section('page_content')
<section class="container mx-auto px-6 py-12">
    <header class="mb-8">
        <h1 class="text-3xl font-bold">Portfolio Companies</h1>
        <p class="text-gray-600">Take a look at our portfolio companies</p>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($deals as $deal)
        <div class="flex flex-col justify-between bg-white rounded-lg shadow-md overflow-hidden">
            <div class="flex flex-col p-4">
                <a href="{{ route('deal.view', $deal->id) }}">
                    <img src="{{ $deal->getCoverUrl() }}" alt="Deal Image" class="w-full h-40 object-cover">
                </a>
                <div class="flex items-center mt-6 justify-between">
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
            </div>
            
            <a href="{{route('deal.public.view', $deal->id)}}" class="px-6 text-center w-full mt-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">View Portfolio</a>
        </div>
        
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{-- {{ $deals->links() }} --}}
    </div>
</section>
@endsection