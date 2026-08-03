@props(['member'])

@php
    $initials = collect(preg_split('/\s+/', trim($member->name)))
        ->filter()
        ->map(fn ($part) => mb_substr($part, 0, 1))
        ->take(2)
        ->implode('');
@endphp

<article {{ $attributes->class(['ban-team-card']) }}>
    <div class="ban-team-card__photo">
        @if ($member->photoUrl())
            <img src="{{ $member->photoUrl() }}" alt="{{ $member->name }}" width="520" height="620" loading="lazy" decoding="async">
        @else
            <span aria-hidden="true">{{ $initials }}</span>
        @endif
    </div>
    <div class="ban-team-card__body">
        <div>
            <p>Bangladesh Angels Network</p>
            <h3>{{ $member->name }}</h3>
            <span>{{ $member->title }}</span>
            @if (filled($member->subtitle))
                <span>{{ $member->subtitle }}</span>
            @endif
        </div>
        @if (filled($member->linkedin_url))
            <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener noreferrer" aria-label="View {{ $member->name }} on LinkedIn">
                LinkedIn <span aria-hidden="true">↗</span>
            </a>
        @endif
    </div>
</article>
