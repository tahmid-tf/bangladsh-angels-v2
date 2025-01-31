@extends('layouts.guest')
@section('page_title','Our Investors | Bangladesh Angel Investors Limited')
@section('page_content')
<section class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-center mb-4">Our Angel Investors</h1>
    <p class="text-center text-gray-600 mb-12">
        Join a Global network of over 450 executives and operators who have built and expanded companies all over the world.
    </p>

    

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        
        @forelse ($investors as $investor)
            <!-- Investor Card -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex items-center mb-4">
                    <img src="{{ $investor->getProfilePhotoUrl() }}" alt="Investor" class="w-16 h-16 rounded-full mr-4">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $investor->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $investor->designation }}{{ ($investor->company_name) ? ', ' . $investor->company_name : '' }}</p>
                    </div>
                </div>
                @if ($investor->joining_date)
                    <p class="text-gray-500 text-sm">Member Since: {{ $investor->joining_date }}</p>
                @endif
                @if ($investor->linkedin)
                    <a href="{{$investor->linkedin}}" class="text-blue-600 mt-4 inline-block"><i class="fab fa-linkedin"></i> LinkedIn</a>
                @endif
            </div>
        @empty
            No Investors to Show
        @endforelse
    </div>

</section>

@endsection