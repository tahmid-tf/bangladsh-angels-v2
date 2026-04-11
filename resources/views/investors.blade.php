@extends('layouts.guest')
@section('page_title','Our Investors | Bangladesh Angel Investors Limited')
@section('page_content')
<div class="w-full max-w-6xl mx-auto px-4 sm:px-6">
    {{-- 1. Become an Investor CTA --}}
    <section class="bg-[#0a5554] rounded-3xl py-10 sm:py-12 text-white shadow-lg mb-8 sm:mb-10">
        <div class="container mx-auto px-6 lg:flex lg:items-center lg:justify-between lg:gap-12">
            <div class="lg:w-1/2">
                <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 tracking-tight">Our Angel Investors</h1>
                <p class="text-base sm:text-lg leading-relaxed text-white/90">
                    Join a global network of executives and operators who have built and expanded companies all over the world.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row sm:items-center gap-4">
                    <a href="{{ route('investor.signup') }}"
                       class="inline-flex items-center justify-center px-6 py-3 rounded-lg font-semibold text-sm sm:text-base bg-white text-[#0a5554] shadow-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#0a5554] transition">
                        Become an Investor
                    </a>
                    @guest
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center justify-center text-sm sm:text-base text-white/90 underline underline-offset-4 hover:text-white transition">
                            Or register for an account
                        </a>
                    @endguest
                </div>
            </div>
            <div class="lg:w-1/2 mt-8 lg:mt-0">
                <img src="{{ asset('investor_cover.webp') }}" alt="Investors" class="w-full h-auto rounded-xl shadow-md" width="640" height="400" loading="eager">
            </div>
        </div>
    </section>
</div>

{{-- 2. Our Membership Plans (pricing) --}}
<section class="w-full max-w-6xl mx-auto px-4 sm:px-6 py-10 sm:py-12 border-t border-gray-100" aria-label="Our membership plans">
    @include('partials.subscription-plans', [
        'tiers' => $tiers,
        'tierSectionTitle' => 'Our Membership Plans',
        'tierSectionSubtitle' => 'Choose the tier that fits how you invest with Bangladesh Angels Network.',
    ])
</section>

{{-- 3. Investor highlight --}}
<section class="container mx-auto px-4 sm:px-6 py-10 sm:py-12 border-t border-gray-100" aria-labelledby="investor-highlight-heading">
    <h2 id="investor-highlight-heading" class="text-2xl sm:text-3xl font-bold text-center text-[#0f3d34] mb-3">Investor highlight</h2>
    <p class="text-center text-gray-600 mb-10 sm:mb-12 max-w-3xl mx-auto">
        Meet a selection of members featured by Bangladesh Angels Network.
    </p>

    <div id="investor-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        @forelse ($investors as $investor)
            @if ($investor->hasPublicFeaturedTestimonial())
                <article
                    class="flex flex-col bg-gradient-to-br from-[#e8f7f1] to-white rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-[#36b37e]/25"
                >
                    <div class="px-1 pt-5 sm:pt-6 flex justify-center">
                        <span class="text-5xl sm:text-6xl font-serif text-[#36b37e]/35 leading-none select-none" aria-hidden="true">&ldquo;</span>
                    </div>
                    <blockquote class="px-5 sm:px-7 pb-2 -mt-2">
                        <p class="text-[0.95rem] sm:text-base text-gray-800 leading-relaxed text-center sm:text-left">
                            {{ $investor->featured_testimonial }}
                        </p>
                    </blockquote>
                    <div class="px-5 sm:px-7 pb-5 sm:pb-6 mt-4 pt-4 border-t border-[#36b37e]/15">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                            <img src="{{ $investor->getProfilePhotoUrl() }}" alt="{{ $investor->name }}"
                                class="w-16 h-16 sm:w-20 sm:h-20 rounded-full mx-auto sm:mx-0 object-cover border-2 border-white shadow-sm ring-2 ring-[#36b37e]/20">
                            <div class="text-center sm:text-left flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-[#0f3d34]">{{ $investor->name }}</h3>
                                <p class="text-gray-600 text-sm sm:text-base">{{ $investor->designation }}{{ $investor->company_name ? ', '.$investor->company_name : '' }}</p>
                                <p class="text-xs font-medium text-[#36b37e] mt-1 uppercase tracking-wide">Featured investor</p>
                                <div class="flex flex-wrap justify-center sm:justify-start gap-3 mt-3">
                                    @if ($investor->joining_date)
                                        <p class="text-gray-500 text-xs sm:text-sm">
                                            <i class="far fa-calendar-alt mr-1"></i>
                                            Member since {{ $investor->joining_date }}
                                        </p>
                                    @endif
                                    @if ($investor->linkedin)
                                        <a href="{{ $investor->linkedin }}" target="_blank" rel="noopener noreferrer"
                                           class="text-blue-600 hover:text-blue-800 text-sm inline-flex items-center gap-1">
                                            <i class="fab fa-linkedin"></i> LinkedIn
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @else
                <div
                    class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border border-green-100/80"
                >
                    <div class="p-5 sm:p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-4">
                            <img src="{{ $investor->getProfilePhotoUrl() }}" alt="{{ $investor->name }}"
                                class="w-20 h-20 rounded-full mx-auto sm:mx-0 object-cover border-2 border-gray-100">
                            <div class="text-center sm:text-left">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $investor->name }}</h3>
                                <p class="text-gray-600">{{ $investor->designation }}{{ ($investor->company_name) ? ', ' . $investor->company_name : '' }}</p>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-4 mt-2">
                            <div class="flex flex-wrap justify-between items-center gap-2">
                                @if ($investor->joining_date)
                                    <p class="text-gray-500 text-sm mb-2 sm:mb-0">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        Member Since: {{ $investor->joining_date }}
                                    </p>
                                @endif
                                @if ($investor->linkedin)
                                    <a href="{{ $investor->linkedin }}" target="_blank" rel="noopener noreferrer"
                                       class="text-blue-600 hover:text-blue-800 transition-colors flex items-center gap-1 group">
                                        <i class="fab fa-linkedin"></i>
                                        <span class="group-hover:underline">LinkedIn</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="col-span-full text-center py-12 px-4 bg-gray-50 rounded-lg border border-dashed border-gray-200">
                <p class="text-gray-600 text-lg font-medium">Featured investors will appear here soon.</p>
                <p class="mt-2 text-gray-500 text-sm max-w-md mx-auto">We showcase selected members on this page. Interested in joining the network?</p>
                <a href="{{ route('investor.signup') }}" class="inline-flex mt-6 px-5 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                    Become an Investor
                </a>
            </div>
        @endforelse
    </div>
</section>
@endsection
