@extends('layouts.guest')

@php
    $memberDealLinks = auth()->check() && auth()->user() && ! auth()->user()->isFree();
    $isPortfolio = $deal->type === 'portfolio';
    $listingUrl = $isPortfolio ? route('portfolio') : route('startups');
    $listingLabel = $isPortfolio ? 'Back to portfolio' : 'Back to startups';
    $relatedDealsHeading = $isPortfolio ? 'More portfolio companies' : 'More active opportunities';
    $relatedLinkLabel = $isPortfolio ? 'View company' : 'Explore opportunity';
    $plainDescription = trim(strip_tags((string) $deal->description));
    $heroDescription = \Illuminate\Support\Str::limit($plainDescription, 230, '...');
    $sector = $deal->sector ?: 'Technology';
    $investmentStage = $deal->investment_stage ?: '—';
    $amountSeeking = $deal->amount_seeking ? '$ '.$deal->amountSeeking() : '—';
    $showMemberActions = auth()->check() && (
        ($deal->type !== 'review' && filled($deal->groupchat_invite_link))
        || $deal->type !== 'portfolio'
    );
@endphp

@section('page_title', $deal->title.' | Bangladesh Angels Network')

@push('head_meta')
    <x-seo-meta
        :title="$deal->title.' | Bangladesh Angels Network'"
        :description="\Illuminate\Support\Str::limit($plainDescription, 155, '...')"
        :canonical="route('deal.view', $deal)"
        :image="$deal->getCoverUrl()"
    />
@endpush

@section('page_content')
<main class="ban-subpage ban-deal-page">
    <div class="ban-page-shell ban-deal-alerts" aria-live="polite">
        @if ($errors->any())
            <div class="ban-deal-alert ban-deal-alert--error">
                <strong>Something went wrong.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="ban-deal-alert ban-deal-alert--error">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="ban-deal-alert ban-deal-alert--success">{{ session('success') }}</div>
        @endif
    </div>

    <section class="ban-deal-hero" aria-labelledby="deal-heading">
        <div class="ban-page-shell ban-deal-hero__grid">
            <div class="ban-deal-hero__copy">
                <a href="{{ $listingUrl }}" class="ban-deal-back"><span aria-hidden="true">&larr;</span> {{ $listingLabel }}</a>

                <div class="ban-deal-identity">
                    <div class="ban-deal-identity__logo">
                        <img src="{{ $deal->getLogoUrl() }}" alt="{{ $deal->title }} logo" width="88" height="88">
                    </div>
                    <div class="ban-deal-identity__tags" aria-label="Company classification">
                        <span>{{ $sector }}</span>
                        <span>{{ $isPortfolio ? 'BAN portfolio' : 'Active opportunity' }}</span>
                    </div>
                </div>

                <h1 id="deal-heading">{{ $deal->title }}</h1>
                <p class="ban-deal-hero__lede">{{ $heroDescription ?: 'Company information will be available soon.' }}</p>

                <dl class="ban-deal-facts" aria-label="Investment overview">
                    <div>
                        <dt>Investment stage</dt>
                        <dd>{{ $investmentStage }}</dd>
                    </div>
                    <div>
                        <dt>Amount seeking</dt>
                        <dd>{{ $amountSeeking }}</dd>
                    </div>
                    <div>
                        <dt>Sector</dt>
                        <dd>{{ $sector }}</dd>
                    </div>
                </dl>

                <div class="ban-deal-actions">
                    @if ($memberDealLinks && filled($deal->pitch_deck_url))
                        <a href="{{ $deal->pitch_deck_url }}" target="_blank" rel="noopener noreferrer" class="ban-deal-button ban-deal-button--primary">
                            View pitch deck <span aria-hidden="true">&nearr;</span>
                        </a>
                    @elseif (! $memberDealLinks)
                        <a href="{{ route('plans') }}" class="ban-deal-button ban-deal-button--primary">
                            Unlock investor materials <span aria-hidden="true">&rarr;</span>
                        </a>
                    @endif

                    @if (filled($deal->commit_link))
                        <a href="{{ $memberDealLinks ? $deal->commit_link : route('plans') }}"
                           @if ($memberDealLinks) target="_blank" rel="noopener noreferrer" @endif
                           class="ban-deal-button ban-deal-button--secondary">
                            {{ $memberDealLinks ? 'Commit' : 'Unlock commitment access' }} <span aria-hidden="true">&nearr;</span>
                        </a>
                    @endif

                    @if (filled($deal->substack_link))
                        <a href="{{ $memberDealLinks ? $deal->substack_link : route('plans') }}"
                           @if ($memberDealLinks) target="_blank" rel="noopener noreferrer" @endif
                           class="ban-deal-button ban-deal-button--text">
                            View on Substack <span aria-hidden="true">&nearr;</span>
                        </a>
                    @endif
                </div>
            </div>

            <figure class="ban-deal-visual">
                <div class="ban-deal-visual__frame">
                    <div class="ban-deal-visual__topline" aria-hidden="true">
                        <span>{{ $isPortfolio ? 'BAN portfolio company' : 'BAN investment opportunity' }}</span>
                        <span>{{ $investmentStage }}</span>
                    </div>
                    <img src="{{ $deal->getCoverUrl() }}" alt="{{ $deal->title }} company cover" width="720" height="540" loading="eager">
                </div>
                <figcaption><span aria-hidden="true"></span> Curated by Bangladesh Angels Network</figcaption>
            </figure>
        </div>
    </section>

    <section class="ban-deal-overview" aria-labelledby="company-overview-heading">
        <div class="ban-page-shell ban-deal-overview__grid">
            <article>
                <p class="ban-page-kicker">Company overview</p>
                <h2 id="company-overview-heading">The company behind the opportunity.</h2>
                <div class="ban-deal-overview__copy">
                    {!! nl2br(e($plainDescription ?: 'A detailed company overview will be published here soon.')) !!}
                </div>
            </article>

            <aside class="ban-deal-snapshot" aria-label="Company snapshot">
                <p>At a glance</p>
                <dl>
                    <div><dt>Company</dt><dd>{{ $deal->title }}</dd></div>
                    <div><dt>Sector</dt><dd>{{ $sector }}</dd></div>
                    <div><dt>Stage</dt><dd>{{ $investmentStage }}</dd></div>
                    <div><dt>Amount seeking</dt><dd>{{ $amountSeeking }}</dd></div>
                </dl>
            </aside>
        </div>
    </section>

    @if ($deal->hasKeyMetric())
        <section class="ban-deal-metrics" aria-labelledby="deal-metrics-heading">
            <div class="ban-page-shell">
                <header class="ban-page-heading ban-page-heading--split">
                    <div>
                        <p class="ban-page-kicker">Key metrics</p>
                        <h2 id="deal-metrics-heading">The signals that matter.</h2>
                    </div>
                    <p>A concise view of the operating and market indicators shared for this company.</p>
                </header>

                <div class="ban-deal-metrics__grid">
                    @foreach ($deal->getKeyMetrics() as $metric)
                        @if (isset($metric['name'], $metric['value']) && ($metric['name'] !== null || $metric['value'] !== null))
                            <article>
                                <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <h3>{{ $metric['name'] ?: 'Metric' }}</h3>
                                <p>{{ $metric['value'] ?: '—' }}</p>
                            </article>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($showMemberActions)
        <section class="ban-deal-member-actions" aria-labelledby="member-actions-heading">
            <div class="ban-page-shell ban-deal-member-actions__grid">
                <div>
                    <p class="ban-page-kicker">Investor access</p>
                    <h2 id="member-actions-heading">Take the next step with {{ $deal->title }}.</h2>
                    <p>Use your BAN member access to join the discussion or register your investment interest.</p>
                </div>
                <div class="ban-deal-member-actions__controls">
                    @if ($deal->type !== 'review' && filled($deal->groupchat_invite_link))
                        <form action="{{ route('deal.invest', $deal->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="deal_id" value="{{ $deal->id }}">
                            <input type="hidden" name="type" value="review">
                            <button type="submit">Join WhatsApp group <span aria-hidden="true">&rarr;</span></button>
                        </form>
                    @endif

                    @if ($deal->type !== 'portfolio')
                        <div class="ban-deal-livewire-action">
                            <livewire:deal-action-button :deal="$deal" />
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    @if (count($otherDeals) > 0)
        <section class="ban-deal-related" aria-labelledby="related-deals-heading">
            <div class="ban-page-shell">
                <header class="ban-page-heading ban-page-heading--split">
                    <div>
                        <p class="ban-page-kicker">Continue exploring</p>
                        <h2 id="related-deals-heading">{{ $relatedDealsHeading }}</h2>
                    </div>
                    <a href="{{ $listingUrl }}" class="ban2-text-link">View all <span aria-hidden="true">&rarr;</span></a>
                </header>

                <div class="ban2-startups__grid">
                    @foreach ($otherDeals as $otherDeal)
                        <x-ban-startup-card
                            :startup="$otherDeal"
                            :href="route('deal.view', $otherDeal)"
                            :link-label="$relatedLinkLabel"
                        />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</main>
@endsection
