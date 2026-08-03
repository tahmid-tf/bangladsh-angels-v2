@props([
    'startup',
    'href' => null,
    'linkLabel' => 'Explore opportunity',
])

@php
    $cardHref = $href ?: route('startups');
    $description = \Illuminate\Support\Str::limit(strip_tags((string) $startup->description), 120, '...');
@endphp

<article {{ $attributes->class(['ban2-startup-card']) }}>
    <div class="ban2-startup-card__logo">
        <img src="{{ $startup->getLogoUrl() }}" alt="{{ $startup->title }} logo" loading="lazy">
    </div>
    <div class="ban2-startup-card__meta">
        <span>{{ $startup->investment_stage ?: 'Early stage' }}</span>
        <span>{{ $startup->sector ?: 'Technology' }}</span>
    </div>
    <h3>{{ $startup->title }}</h3>
    <p>{{ $description }}</p>
    <a href="{{ $cardHref }}">{{ $linkLabel }} <span aria-hidden="true">&rarr;</span></a>
</article>
