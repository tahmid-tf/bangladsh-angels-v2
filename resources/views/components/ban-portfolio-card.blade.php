@props([
    'company',
    'href' => null,
])

@php
    $cardHref = $href ?: route('portfolio');
@endphp

<a href="{{ $cardHref }}" {{ $attributes->class(['ban2-portfolio-card']) }} aria-label="View {{ $company->title }} in the BAN portfolio">
    <img src="{{ $company->getLogoUrl() }}" alt="{{ $company->title }} logo" loading="lazy">
    <div>
        <h3>{{ $company->title }}</h3>
        <p>{{ $company->sector ?: 'Portfolio company' }}</p>
    </div>
</a>
