@extends('layouts.investor')
@section('page_title','Resource | Bangladesh Angels Network Limited')
@section('page_content')
<section class="bg-[#0a5554] py-12 rounded-3xl border-box w-[95%] mx-auto">

    {{-- Validation & Session Messages --}}
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
            <!-- Resource Title -->
            <h1 class="text-4xl font-extrabold mb-4">
                {{ $resource->title }}
            </h1>

            <!-- Description -->
            <p class="text-lg mb-6">
                {{ $resource->description }}
            </p>

            <!-- Date, Time, Location, Fee -->
            <div class="flex items-center flex-wrap gap-8 mb-6">
                @if($resource->date)
                    <div>
                        <p class="text-sm">Date</p>
                        <p class="text-lg font-semibold">{{ $resource->date->format('F d, Y') }}</p>
                    </div>
                @endif

                @if($resource->start_time)
                    <div>
                        <p class="text-sm">Start Time</p>
                        <p class="text-lg font-semibold">{{ $resource->start_time->format('h:i A') }}</p>
                    </div>
                @endif

                @if($resource->end_time)
                    <div>
                        <p class="text-sm">End Time</p>
                        <p class="text-lg font-semibold">{{ $resource->end_time->format('h:i A') }}</p>
                    </div>
                @endif

                @if($resource->location)
                    <div>
                        <p class="text-sm">Location</p>
                        <p class="text-lg font-semibold">{{ $resource->location }}</p>
                    </div>
                @endif

                @if($resource->registration_fee)
                    <div>
                        <p class="text-sm">Registration Fee</p>
                        <p class="text-lg font-semibold">{{ $resource->registration_fee }} BDT</p>
                    </div>
                @endif
            </div>

            <!-- Registration Details (optional) -->
            @if($resource->registration_details)
                <div class="bg-white text-gray-800 p-4 rounded-lg shadow mb-6">
                    <h2 class="text-lg font-bold mb-2">How to Register</h2>
                    <p>{{ $resource->registration_details }}</p>
                </div>
            @endif
        </div>

        <!-- Right Content: Banner Image -->
        <div class="lg:w-1/2 mt-6 lg:mt-0 lg:ml-8">
            @php
                // If using Spatie Media Library:
                // $bannerUrl = $resource->getFirstMediaUrl('banner') ?: asset('placeholder_banner.png');
                // If using a stored column or a default placeholder:
                $bannerUrl = $resource->getFirstMediaUrl('banner') ?? asset('placeholder_banner.png');
            @endphp
            <img
                src="{{ $bannerUrl }}"
                alt="Resource Banner"
                class="w-full h-auto rounded-lg shadow-md"
            >
        </div>
    </div>
</section>

<!-- Benefits Section -->
@if(is_array($resource->benefits) && count($resource->benefits) > 0)
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold mb-4">Why Attend?</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($resource->benefits as $benefit)
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition duration-300">
                <p class="text-gray-700 font-semibold">{{ $benefit }}</p>
            </div>
        @endforeach
    </div>
</section>
@endif

<!-- Event Highlights Section -->
@if(is_array($resource->event_highlights) && count($resource->event_highlights) > 0)
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold mb-4">Event Highlights</h2>
    <ul class="list-disc list-inside text-gray-700">
        @foreach($resource->event_highlights as $highlight)
            <li class="mb-2">{{ $highlight }}</li>
        @endforeach
    </ul>
</section>
@endif

<!-- Target Audience Section -->
@if(is_array($resource->target_audience) && count($resource->target_audience) > 0)
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold mb-4">Who Should Attend?</h2>
    <ul class="list-disc list-inside text-gray-700">
        @foreach($resource->target_audience as $audience)
            <li class="mb-2">{{ $audience }}</li>
        @endforeach
    </ul>
</section>
@endif

<!-- Speakers Section -->
@if(is_array($resource->speakers) && count($resource->speakers) > 0)
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold mb-8">Speakers</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($resource->speakers as $index => $speaker)
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                @php
                    // If using Spatie’s 'speakers' collection
                    // We stored images with a custom property linking them to the speaker index
                    $speakerImage = $resource->getMedia('speakers')->first(function($media) use($index) {
                        return $media->getCustomProperty('speaker_index') == $index;
                    });
                    $speakerImageUrl = $speakerImage
                        ? $speakerImage->getUrl()
                        : asset('placeholder_speaker.png');
                @endphp
                <img
                    src="{{ $speakerImageUrl }}"
                    alt="Speaker Photo"
                    class="w-24 h-24 rounded-full object-cover mb-4"
                >
                <h3 class="text-lg font-bold text-gray-800">{{ $speaker['name'] ?? 'Unknown Speaker' }}</h3>
                <p class="text-gray-600">{{ $speaker['designation'] ?? '' }}</p>
            </div>
        @endforeach
    </div>
</section>
@endif

<!-- Possibly: More Resources Section -->
@if(isset($otherResources) && count($otherResources) > 0)
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold mb-8">More Resources</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($otherResources as $otherResource)
            <!-- You can create a Livewire or Blade component for resource cards -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-xl font-semibold mb-2">
                    {{ $otherResource->title }}
                </h3>
                <p class="text-gray-600 mb-4 line-clamp-3">
                    {{ Str::limit($otherResource->description, 100) }}
                </p>
                <a href="{{ route('resources.show', $otherResource->id) }}"
                   class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    View
                </a>
            </div>
        @endforeach
    </div>
</section>
@endif

@endsection
