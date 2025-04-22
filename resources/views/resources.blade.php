@extends('layouts.guest')
@section('page_title','Resources | Bangladesh Angels Network Limited')
@section('page_content')
<section class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-gray-800">Resources</h1>
        <p class="text-gray-600">Discover webinars and BAN events to network and learn more about us</p>
    </div>

    <!-- Angel Academy Section -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Angel Academy</h2>
        <div class="bg-[#00877a]/10 p-6 rounded-lg mb-6">
            <p class="text-gray-700 mb-4">Angel Academy is our premier educational program designed for aspiring and experienced angel investors. The curriculum covers essential topics including due diligence, deal screening, investment structuring, valuation methodologies, and post-investment management. Our expert-led sessions provide practical knowledge and tools to help you make informed investment decisions and successfully navigate the startup ecosystem.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            <!-- Session 1 -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-[#00877a]">
                <div class="flex flex-col h-full">
                    <div class="mb-4">
                        <span class="bg-[#00877a]/10 text-[#00877a] text-xs font-semibold px-2.5 py-0.5 rounded">September 9, 2023</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Screening & Pitching</h3>
                    <div class="mb-4">
                        <h4 class="text-sm font-semibold text-gray-700 mb-1">Presenters:</h4>
                        <p class="text-gray-600">Ahmed Jawad Yusuf, Alavi Mirza, Saleh Sazzad, Mohtasim Bin Habib, Mustavi Khan</p>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-sm font-semibold text-gray-700 mb-1">Materials:</h4>
                        <ul class="list-disc pl-5 text-gray-600 text-sm">
                            <li>Session 1 Deck</li>
                            <li>Startups or SMEs - Why Does it Even Matter?</li>
                            <li>Startup = Growth</li>
                            <li>Evaluate Startup Ideas by Y Combinator</li>
                            <li>Market Pull by Julian Shapiro</li>
                        </ul>
                    </div>
                    <div class="mt-auto">
                        @auth
                            <a href="https://vimeo.com/862695099?share=copy" target="_blank" class="inline-block bg-[#00877a] hover:bg-[#00877a]/80 text-white font-medium py-2 px-4 rounded transition duration-300 w-full text-center">
                                <i class="fas fa-play-circle mr-2"></i> Watch Session Recording
                            </a>
                        @else
                            <a href="{{ route('upgrade.page') }}" class="inline-block bg-[#00877a] hover:bg-[#00877a]/80 text-white font-medium py-2 px-4 rounded transition duration-300 w-full text-center">
                                <i class="fas fa-lock mr-2"></i> Sign In to Watch
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Session 2 -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-[#00877a]">
                <div class="flex flex-col h-full">
                    <div class="mb-4">
                        <span class="bg-[#00877a]/10 text-[#00877a] text-xs font-semibold px-2.5 py-0.5 rounded">September 16, 2023</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Due Diligence & Structuring</h3>
                    <div class="mb-4">
                        <h4 class="text-sm font-semibold text-gray-700 mb-1">Presenters:</h4>
                        <p class="text-gray-600">Alavi Mirza, Saleh Sazzad, Mohtasim Bin Habib, Mustavi Khan</p>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-sm font-semibold text-gray-700 mb-1">Materials:</h4>
                        <ul class="list-disc pl-5 text-gray-600 text-sm">
                            <li>Session 2 Deck</li>
                            <li>Demo Data Room - Due Diligence Checklist</li>
                            <li>Financial Model Template by Slidebean</li>
                            <li>Buyer Beware: Bad Cap Tables Will Kill Startups</li>
                            <li>SAFE Note Example</li>
                            <li>SAFE vs Convertible Note</li>
                        </ul>
                    </div>
                    <div class="mt-auto">
                        @auth
                            <a href="https://vimeo.com/865123352?share=copy" target="_blank" class="inline-block bg-[#00877a] hover:bg-[#00877a]/80 text-white font-medium py-2 px-4 rounded transition duration-300 w-full text-center">
                                <i class="fas fa-play-circle mr-2"></i> Watch Session Recording
                            </a>
                        @else
                            <a href="{{ route('upgrade.page') }}" class="inline-block bg-[#00877a] hover:bg-[#00877a]/80 text-white font-medium py-2 px-4 rounded transition duration-300 w-full text-center">
                                <i class="fas fa-lock mr-2"></i> Sign In to Watch
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Session 3 -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-[#00877a]">
                <div class="flex flex-col h-full">
                    <div class="mb-4">
                        <span class="bg-[#00877a]/10 text-[#00877a] text-xs font-semibold px-2.5 py-0.5 rounded">September 23, 2023</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Structuring & Completing Transactions</h3>
                    <div class="mb-4">
                        <h4 class="text-sm font-semibold text-gray-700 mb-1">Presenters:</h4>
                        <p class="text-gray-600">Ahmed Jawad Yusuf, Alavi Mirza, Saleh Sazzad</p>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-sm font-semibold text-gray-700 mb-1">Materials:</h4>
                        <ul class="list-disc pl-5 text-gray-600 text-sm">
                            <li>Session 3 Deck</li>
                            <li>SAFE Note (SG) Sample</li>
                            <li>Sample Term Sheet - Ordinary Shares</li>
                            <li>Sample Term Sheet_RCPS</li>
                            <li>Sample Share Subscription and Shareholders Agreement</li>
                            <li>Sample_TS_Shareholding_Calc</li>
                        </ul>
                    </div>
                    <div class="mt-auto">
                        @auth
                            <a href="https://vimeo.com/867473367?share=copy" target="_blank" class="inline-block bg-[#00877a] hover:bg-[#00877a]/80 text-white font-medium py-2 px-4 rounded transition duration-300 w-full text-center">
                                <i class="fas fa-play-circle mr-2"></i> Watch Session Recording
                            </a>
                        @else
                            <a href="{{ route('upgrade.page') }}" class="inline-block bg-[#00877a] hover:bg-[#00877a]/80 text-white font-medium py-2 px-4 rounded transition duration-300 w-full text-center">
                                <i class="fas fa-lock mr-2"></i> Sign In to Watch
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Session 4 -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-[#00877a]">
                <div class="flex flex-col h-full">
                    <div class="mb-4">
                        <span class="bg-[#00877a]/10 text-[#00877a] text-xs font-semibold px-2.5 py-0.5 rounded">September 30, 2023</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Post-Investment Activities, Exits & Angel Investing Core Principles</h3>
                    <div class="mb-4">
                        <h4 class="text-sm font-semibold text-gray-700 mb-1">Presenters:</h4>
                        <p class="text-gray-600">Saleh Sazzad, Mustavi Khan, Mohaimenul Islam</p>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-sm font-semibold text-gray-700 mb-1">Materials:</h4>
                        <ul class="list-disc pl-5 text-gray-600 text-sm">
                            <li>Session 4 Deck</li>
                            <li>KAUFFMAN's Study on Returns to Angel Investors</li>
                        </ul>
                    </div>
                    <div class="mt-auto">
                        @auth
                            <a href="https://vimeo.com/869821154?share=copy" target="_blank" class="inline-block bg-[#00877a] hover:bg-[#00877a]/80 text-white font-medium py-2 px-4 rounded transition duration-300 w-full text-center">
                                <i class="fas fa-play-circle mr-2"></i> Watch Session Recording
                            </a>
                        @else
                            <a href="{{ route('upgrade.page') }}" class="inline-block bg-[#00877a] hover:bg-[#00877a]/80 text-white font-medium py-2 px-4 rounded transition duration-300 w-full text-center">
                                <i class="fas fa-lock mr-2"></i> Sign In to Watch
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
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
