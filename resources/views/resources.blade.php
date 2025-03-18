@extends('layouts.guest')
@section('page_title','Resources | Bangladesh Angels Network Limited')
@section('page_content')
<section class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-gray-800">Resources</h1>
        <p class="text-gray-600">Discover webinars and BAN events to network and learn more about us</p>
    </div>

    <!-- BAN Events Section -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Events</h2>
        @if($events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <a 
                        target="_blank" 
                        href="{{ route('resource.public.view', $event->id) }}" 
                        class="bg-white rounded-lg shadow p-4"
                    >
                        {{-- Show the banner image or a placeholder if none exists --}}
                        @php
                            $bannerUrl = $event->getFirstMediaUrl('banner') ?: asset('resources/no-photo.png');
                        @endphp
                        <img 
                            src="{{ $bannerUrl }}" 
                            alt="Event Image" 
                            class="w-full h-40 object-cover rounded-md mb-4"
                        >
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $event->title }}</h3>

                        @if($event->date)
                            <p class="text-gray-600 text-sm mb-2">
                                {{ $event->date->format('F d, Y') }}
                            </p>
                        @endif
                        
                        @if($event->start_time && $event->end_time)
                            <p class="text-gray-600 text-sm mb-2">
                                {{ $event->start_time->format('g:i A') }} - {{ $event->end_time->format('g:i A') }}
                            </p>
                        @endif

                        @if($event->location)
                            <p class="text-gray-600 text-sm mb-4">{{ $event->location }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No events found at this time.</p>
        @endif
    </div>

    <!-- Webinars Section -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Webinars</h2>
        @if($webinars->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($webinars as $webinar)
                    <a 
                        target="_blank" 
                        href="{{ route('resource.public.view', $webinar->id) }}" 
                        class="bg-white rounded-lg shadow p-4"
                    >
                        {{-- Show the banner image or a placeholder if none exists --}}
                        @php
                            $bannerUrl = $webinar->getFirstMediaUrl('banner') ?: asset('resources/no-photo.png');
                        @endphp
                        <img 
                            src="{{ $bannerUrl }}" 
                            alt="Webinar Image" 
                            class="w-full h-40 object-cover rounded-md mb-4"
                        >
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $webinar->title }}</h3>

                        @if($webinar->date)
                            <p class="text-gray-600 text-sm mb-2">
                                {{ $webinar->date->format('F d, Y') }}
                            </p>
                        @endif
                        
                        @if($webinar->start_time && $webinar->end_time)
                            <p class="text-gray-600 text-sm mb-2">
                                {{ $webinar->start_time->format('g:i A') }} - {{ $webinar->end_time->format('g:i A') }}
                            </p>
                        @endif

                        @if($webinar->location)
                            <p class="text-gray-600 text-sm mb-4">{{ $webinar->location }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No webinars found at this time.</p>
        @endif
    </div>
</section>
@endsection
