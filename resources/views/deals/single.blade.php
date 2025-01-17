@extends('layouts.investor')
@section('page_title','Deals | Bangladesh Angels Network Limited')
@section('page_content')
<section class="bg-[#0a5554] py-12 rounded-3xl border-box w-[95%]">
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            <p class="font-bold">Whoops! Something went wrong.</p>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif
    <!-- Hero Section -->
    <div class="container mx-auto px-6 lg:flex lg:items-center text-white">
        <!-- Left Content -->
        <div class="lg:w-full">
            <h1 class="text-4xl font-extrabold mb-4">{{$deal->title}}</h1>
            <p class="text-lg  mb-6">
                {{$deal->description}}
            </p>
            <div class="flex items-center space-x-8 mb-6">
                <div>
                    <p class=" text-sm">Investment Stage</p>
                    <p class="text-lg font-semibold">{{ $deal->investment_stage }}</p>
                </div>
                <div>
                    <p class=" text-sm">Amount Seeking</p>
                    <p class="text-lg font-semibold">$ {{$deal->amount_seeking}}</p>
                </div>
            </div>
            <a href="{{$deal->pitch_deck_url}}" class="my-6 px-6 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg shadow hover:bg-gray-300">
                View Pitch Deck
            </a>
            <form action="{{route('deal.invest', $deal->id)}}" class="mt-6" method="POST">
                @csrf
                <input type="text" name="user_id" value="{{auth()->id()}}" hidden id="user_id">
                <input type="text" name="deal_id" value="{{$deal->id}}" hidden id="deal_id">
                <input type="submit" value="{{ucfirst($deal->type)}}" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
            </form>
            
            
            
        </div>

        <!-- Right Content -->
        <div class="lg:w-1/2 lg:mt-0">
            <img src="{{$deal->getCoverUrl()}}" alt="Jatri Image" class="w-full h-auto rounded-lg shadow-md">
            
        </div>
    </div>
</section>

<!-- Company Bio Section -->
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold mb-4">Company Bio</h2>
    <p class="text-gray-700 leading-relaxed">
        {{$deal->description}}
    </p>
</section>

{{-- <!-- Metrics Section -->
<section class="bg-gray-50 py-12">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <p class="text-2xl font-bold">
                    Over 2 million registered users
                </p>
                <p class="text-gray-500">With 15% month-over-month growth in adoption.</p>
            </div>
            <div class="text-center">
                <p class="text-2xl font-bold">
                    ৳50,000+ monthly revenue
                </p>
                <p class="text-gray-500">With 60% derived from recurring partnerships with fleet operators.</p>
            </div>
            <div class="text-center">
                <p class="text-2xl font-bold">TAM of $3 billion in South Asia</p>
                <p class="text-gray-500">In the urban transport market, with $200M directly addressable in Bangladesh.</p>
            </div>
        </div>
    </div>
</section> --}}
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold mb-8 text-center">Key Metrics</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($deal->getKeyMetrics() as $metric)
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <h3 class="text-lg font-bold mb-3 text-gray-900">{{ $metric['name'] }}</h3>
            <p class="text-gray-600 text-sm leading-relaxed">
                {{ $metric['value'] }}
            </p>
        </div>
        @empty
        <div class="col-span-full text-center text-gray-500">
            <p>No Key Metrics available for this deal.</p>
        </div>
        @endforelse
    </div>
</section>


<!-- More Live Deals Section -->
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold mb-8">More Live Deals</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse ($otherDeals as $otherDeal)
            <div class="bg-white p-6 rounded-lg shadow">
                <img src="{{$otherDeal->getCoverUrl()}}" alt="Deal Image" class="w-full h-40 object-cover rounded-lg mb-4">
                <h3 class="text-lg font-bold">{{ $otherDeal->title }}</h3>
                <p class="text-gray-500 text-sm mb-4">
                    {{$otherDeal->description}}
                </p>
                <button class="px-6 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition">
                    Invest
                </button>
            </div>
        @empty
            
        @endforelse
        
    </div>
</section>
@endsection