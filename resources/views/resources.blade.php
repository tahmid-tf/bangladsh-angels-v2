@extends('layouts.guest')
@section('page_title', 'Resources | Bangladesh Angels Network Limited')
@section('page_content')
@php
    $brochureUrl = asset('MoU.pdf');
    $shadowClasses = [
        'bg-[#36b37e]/22',
        'bg-[#18736a]/18',
        'bg-[#0f3d34]/14',
    ];
    $surfaceClasses = [
        'from-white via-[#f7fdf9] to-[#eefaf4] border-green-100/90',
        'from-white via-[#f3faf8] to-[#e6f4f0] border-[#18736a]/25',
        'from-white via-[#f4faf7] to-[#e8f5ef] border-[#0f3d34]/18',
    ];
@endphp

<section class="w-full max-w-5xl mx-auto px-4 sm:px-6 py-10 md:py-14">
    <header class="mb-10 md:mb-14">
        <h1 class="text-3xl md:text-4xl font-bold text-[#0f3d34] tracking-tight">Resources</h1>
        <p class="mt-3 text-gray-600 max-w-2xl leading-relaxed">
            Programs and tools we work with to support angels and founders across the network.
        </p>
    </header>

    <div class="flex flex-col gap-12 md:gap-16">
        @forelse ($hubCards as $card)
            @php
                $i = $loop->index % 3;
                $isExternal = str_starts_with(strtolower(trim($card->link)), 'http');
            @endphp
            <div class="relative">
                <div class="absolute inset-0 translate-x-2 translate-y-2 rounded-3xl {{ $shadowClasses[$i] }}" aria-hidden="true"></div>
                <article class="relative overflow-hidden rounded-3xl border bg-gradient-to-br {{ $surfaceClasses[$i] }} shadow-md">
                    <div class="flex flex-col lg:flex-row lg:items-center gap-8 lg:gap-10 p-8 md:p-10">
                        <div class="lg:flex-1 text-center lg:text-left min-w-0">
                            <h2 class="text-2xl md:text-3xl font-bold text-[#0f3d34]">{{ $card->title }}</h2>
                            <p class="mt-2 text-sm md:text-base text-gray-600 leading-relaxed">{{ $card->one_liner }}</p>
                        </div>
                        <div class="flex justify-center shrink-0">
                            <div class="h-28 w-28 md:h-32 md:w-32 shrink-0 overflow-hidden rounded-full border-2 border-white shadow-md ring-2 ring-[#36b37e]/20 bg-gray-50">
                                @if ($card->logoUrl())
                                    <img src="{{ $card->logoUrl() }}" alt="" class="h-full w-full object-cover object-center">
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-xs font-medium text-gray-400 tracking-wide" aria-hidden="true">Logo</div>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col items-center lg:items-end shrink-0 w-full lg:w-auto">
                            <a href="{{ $card->link }}"
                               @if ($isExternal) target="_blank" rel="noopener noreferrer" @endif
                               class="inline-flex items-center justify-center gap-2 rounded-full bg-[#0f3d34] px-6 py-3 text-sm md:text-base font-semibold text-white shadow-sm hover:bg-[#156755] transition-colors w-full sm:w-auto">
                                <span>{{ $card->cta_label ?: 'Learn more' }}</span>
                                <span aria-hidden="true">?</span>
                            </a>
                        </div>
                    </div>
                </article>
                <p class="mt-4 text-center">
                    <a href="{{ $brochureUrl }}" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold text-[#36b37e] hover:text-[#18736a] underline underline-offset-4">
                        Click here to see our brochure
                    </a>
                </p>
            </div>
        @empty
            <p class="text-center text-gray-600 py-12">No resource cards are configured yet.</p>
        @endforelse
    </div>
</section>
@endsection
