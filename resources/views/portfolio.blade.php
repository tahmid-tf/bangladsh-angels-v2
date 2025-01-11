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
        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Company Image -->
            <a href="{{route('deal.view', $deal->id)}}">
                <div class="rounded-lg overflow-hidden mb-6">
                    <img src="{{ $deal->getCoverUrl() }}" alt="{{ $deal->title }}" class="w-full h-48 object-cover">
                </div>
            </a>
            
        
            <!-- Deal Header -->
            <div class="flex items-center mb-4">
                <div class="h-12 w-12 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-500 text-lg font-bold">
                    <img src="{{ $deal->getLogoUrl() }}" alt="{{ $deal->title }}" class="h-10 w-10 rounded-full border">
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-bold">{{ $deal->title }}</h3>
                    <span class="text-sm text-green-600 font-semibold px-2 py-1 bg-green-100 rounded-full">{{ $deal->sector }}</span>
                </div>
            </div>
        
            <!-- Description -->
            <p class="text-gray-600 mb-4 leading-relaxed">
                {{ \Illuminate\Support\Str::limit($deal->description, 200) }}
            </p>
        
            <!-- Key Metrics -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4 text-center">
                @foreach($deal->getKeyMetrics() as $metric)
                <div class="flex flex-col items-center bg-gray-100 rounded-lg p-4">
                    <span class="text-green-600 text-lg font-semibold">{{ $metric['value'] }}</span>
                    <span class="text-sm text-gray-600">{{ $metric['name'] }}</span>
                </div>
                @endforeach
            </div>
        
            <!-- CTA Button -->
            <div class="mt-6">
                <a href="{{ $deal->pitch_deck_url }}" target="_blank" class="px-6 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700 transition">
                    View Pitch Deck
                </a>
            </div>
        </div>
        
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{-- {{ $deals->links() }} --}}
    </div>
</section>
@endsection