<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col p-6 text-gray-900">
                    <span class="flex">
                        <strong>Your Investments : </strong>{{auth()->user()->investments->count()}}
                    </span>
                    <!-- Table -->
                    <div class="bg-white rounded-lg mt-6 shadow overflow-x-auto">
                        @foreach (auth()->user()->investments as $investment)
                                <div class="flex flex-col justify-between bg-white rounded-lg shadow-md overflow-hidden">
                                    <div class="flex flex-col p-4">
                                        <a href="{{ route('deal.view', $investment->deal->id) }}">
                                            <img src="{{ $investment->deal->getCoverUrl() }}" alt="Deal Image" class="w-full h-40 object-cover">
                                        </a>
                                        <div class="flex items-center mt-6 justify-between">
                                            <h2 class="text-lg font-bold">{{ $investment->deal->title }}</h2>
                                            <span class="bg-gray-200 text-xs px-2 py-1 rounded-full">{{ ucfirst($investment->deal->sector) }}</span>
                                        </div>
                                        <p class="text-gray-500 text-sm mt-2">
                                            {{ $investment->deal->description }}
                                        </p>
                                        <div class="flex justify-between items-center mt-4 text-sm">
                                            <div class="text-center">
                                                <p class="text-gray-400">Investment Stage</p>
                                                <p class="font-semibold">{{ $investment->deal->investment_stage }}</p>
                                            </div>
                                            <div class="text-center">
                                                <p class="text-gray-400">Amount Seeking</p>
                                                <p class="font-semibold">$ {{ $investment->deal->amountSeeking() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{route('deal.view',$investment->deal->id)}}" class="px-6 w-full mt-6 py-3 bg-green-600 text-center text-white font-semibold rounded-lg hover:bg-green-700 transition"> View Deal</a>
                                    
                                </div>
                                @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
