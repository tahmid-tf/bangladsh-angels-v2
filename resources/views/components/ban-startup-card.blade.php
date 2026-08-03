@props([
    'startup',
    'href' => null,
    'linkLabel' => 'Explore opportunity',
    'showInvestmentDetails' => false,
])

@php
    $cardHref = $href ?: route('startups');
    $description = \Illuminate\Support\Str::limit(strip_tags((string) $startup->description), 120, '...');
    $investmentStage = $startup->investment_stage ?: '—';
    $amountSeeking = $startup->amount_seeking ? '$ '.$startup->amountSeeking() : '—';
@endphp

<article {{ $attributes->class(['ban2-startup-card']) }}>
    <div class="ban2-startup-card__logo">
        <img src="{{ $startup->getLogoUrl() }}" alt="{{ $startup->title }} logo" loading="lazy">
    </div>
    <div class="ban2-startup-card__meta">
        @unless ($showInvestmentDetails)
            <span>{{ $startup->investment_stage ?: 'Early stage' }}</span>
        @endunless
        <span>{{ $startup->sector ?: 'Technology' }}</span>
    </div>
    <h3>{{ $startup->title }}</h3>
    <p>{{ $description }}</p>
    @if ($showInvestmentDetails)
        <dl class="ban2-startup-card__details">
            <div>
                <dt>Investment Stage</dt>
                <dd>{{ $investmentStage }}</dd>
            </div>
            <div>
                <dt>Amount Seeking</dt>
                <dd>{{ $amountSeeking }}</dd>
            </div>
        </dl>
    @endif
    <a href="{{ $cardHref }}">{{ $linkLabel }} <span aria-hidden="true">&rarr;</span></a>
</article>
