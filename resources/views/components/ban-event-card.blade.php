@props([
    'resource',
    'detailHref' => null,
])

@php
    /** @var \App\Models\Resource $resource */
    $detailHref = $detailHref ?? route('resource.public.view', $resource);
    $banner = $resource->cardBannerUrl();
    $cta = $resource->cta_link ? trim($resource->cta_link) : '';
    $ctaIsExternal = $cta !== '' && preg_match('#^https?://#i', $cta);
    $snippet = \Illuminate\Support\Str::limit(trim(strip_tags((string) $resource->description)), 320);
@endphp

<article class="ban-event-card group flex flex-col overflow-hidden rounded-2xl border border-emerald-950/30 bg-[#042f28] shadow-[0_12px_40px_-8px_rgba(6,45,38,0.45)] ring-1 ring-white/5 sm:flex-row sm:items-stretch">
    <a href="{{ $detailHref }}" class="relative block aspect-[5/4] w-full shrink-0 overflow-hidden bg-black/25 sm:aspect-auto sm:w-[min(38vw,260px)] sm:max-w-[280px] sm:self-stretch sm:min-h-[200px]">
        <img src="{{ $banner }}"
             alt=""
             class="h-full w-full object-cover transition duration-300 ease-out group-hover:scale-[1.02]"
             width="400"
             height="320"
             loading="lazy"
             decoding="async">
        <span class="sr-only">{{ $resource->title }} — view details</span>
    </a>
    <div class="flex min-w-0 flex-1 flex-col justify-between gap-5 bg-gradient-to-br from-[#0f5648] via-[#0c453b] to-[#062920] px-6 py-6 sm:px-8 sm:py-7">
        <div class="min-w-0 space-y-3">
            <p class="text-[0.65rem] font-semibold uppercase tracking-[0.2em] text-[#b9f3dc]">{{ $resource->type === 'webinar' ? 'Webinar' : 'Event' }}</p>
            <h3 class="text-xl font-bold leading-snug tracking-tight text-white sm:text-2xl">
                <a href="{{ $detailHref }}" class="text-white decoration-white/30 decoration-2 underline-offset-4 transition hover:underline">
                    {{ $resource->title }}
                </a>
            </h3>
            @if ($snippet !== '')
                <p class="text-[0.9375rem] leading-relaxed text-[#ecfdf5] sm:text-base">{{ $snippet }}</p>
            @endif
        </div>
        <div class="flex flex-col gap-3 border-t border-white/10 pt-4 sm:flex-row sm:flex-wrap sm:items-center sm:justify-between sm:gap-4">
            <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                @if ($cta !== '')
                    <a href="{{ $cta }}"
                       @if ($ctaIsExternal) target="_blank" rel="noopener noreferrer" @endif
                       class="inline-flex items-center justify-center rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-[#063d2f] shadow-sm transition hover:bg-emerald-50">
                        Register / RSVP
                    </a>
                @endif
                <a href="{{ $detailHref }}"
                   class="inline-flex items-center text-sm font-semibold text-[#d1fae5] underline decoration-[#86efac] underline-offset-4 transition hover:text-white hover:decoration-white/60">
                    Event details
                </a>
            </div>
            @if ($resource->date || $resource->location)
                <ul class="flex flex-col gap-1 text-xs text-[#b9f3dc] sm:text-right sm:text-sm">
                    @if ($resource->date)
                        <li>{{ $resource->date->format('M j, Y') }}</li>
                    @endif
                    @if ($resource->location)
                        <li class="line-clamp-2">{{ $resource->location }}</li>
                    @endif
                </ul>
            @endif
        </div>
    </div>
</article>
