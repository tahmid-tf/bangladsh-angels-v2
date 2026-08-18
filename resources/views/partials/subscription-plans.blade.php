{{-- Expects $tiers (Collection of SubscriptionTier). Optional: $tierSectionTitle, $tierSectionSubtitle, $tierSectionKicker, $tierSectionHeadingId --}}
@php
    $tierSectionTitle = $tierSectionTitle ?? 'Flexible plans for your investment needs';
    $tierSectionSubtitle = $tierSectionSubtitle ?? 'Choose your plan and make investment work like magic';
    $tierSectionKicker = $tierSectionKicker ?? null;
    $tierSectionHeadingId = $tierSectionHeadingId ?? null;
    $showFreeTierOption = $showFreeTierOption ?? false;
    $planPageMode = $planPageMode ?? false;
    $gridColsClass = $showFreeTierOption ? 'grid-cols-1 md:grid-cols-2 xl:grid-cols-4' : 'grid-cols-1 md:grid-cols-3';
    $semanticGridClass = $showFreeTierOption
        ? 'ban-subscription-plans__grid--four'
        : 'ban-subscription-plans__grid--three';
@endphp

@if (session('error'))
    <div class="ban-subscription-plans__alert max-w-2xl mx-auto mb-8 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg" role="alert">
        {{ session('error') }}
    </div>
@endif

<header class="ban-subscription-plans__heading text-center mb-10">
    @if ($tierSectionKicker)
        <p class="ban2-kicker">{{ $tierSectionKicker }}</p>
    @endif
    <h2 @if ($tierSectionHeadingId) id="{{ $tierSectionHeadingId }}" @endif class="text-2xl font-bold text-gray-800">{{ $tierSectionTitle }}</h2>
    <p class="text-gray-500">{{ $tierSectionSubtitle }}</p>
</header>

@if ($tiers->isEmpty())
    <p class="ban-subscription-plans__empty text-center text-gray-600" role="status">No subscription plans are available at the moment. Please check back later.</p>
@else
    <div class="ban-subscription-plans__grid {{ $semanticGridClass }} grid {{ $gridColsClass }} gap-8">
        @if ($showFreeTierOption)
            @php
                $freeContinueRoute = auth()->check() && auth()->user()->is_approved ? route('dashboard') : route('approval.success');
            @endphp
            <article class="ban-subscription-plan-card ban-subscription-plan-card--free border rounded-lg p-6 shadow-sm bg-white text-center flex flex-col h-full">
                <h3 class="ban-subscription-plan-card__name text-lg font-bold text-gray-800 mb-2 uppercase">Free</h3>
                @if ($planPageMode)
                    <p class="ban-subscription-plan-card__description">For approved investors exploring the BAN community.</p>
                @endif
                <p class="ban-subscription-plan-card__price text-4xl font-extrabold text-gray-800 mb-2">
                    $0 <span class="text-lg font-normal text-gray-500">/yr</span>
                </p>
                @unless ($planPageMode)
                    <div class="ban-subscription-plan-card__icon flex justify-center mb-4">
                        <img class="h-[100px] object-contain" src="{{ asset('icon.webp') }}" alt="" width="100" height="100" loading="lazy">
                    </div>
                @endunless
                @if ($planPageMode)
                    <p class="ban-subscription-plan-card__features-label">Your membership includes</p>
                @endif
                <ul class="ban-subscription-plan-card__features text-gray-600 space-y-2 mb-6">
                    <li class="ban-subscription-plan-card__feature ban-subscription-plan-card__feature--included flex items-center justify-center space-x-2">
                        <span aria-hidden="true" class="text-green-600">✔</span> <span>Keep your free investor account</span>
                    </li>
                    <li class="ban-subscription-plan-card__feature ban-subscription-plan-card__feature--included flex items-center justify-center space-x-2">
                        <span aria-hidden="true" class="text-green-600">✔</span> <span>Upgrade any time later</span>
                    </li>
                </ul>
                <a href="{{ $freeContinueRoute }}" class="ban-subscription-plan-card__button ban-subscription-plan-card__button--free inline-block mt-auto bg-gray-700 text-white py-2 px-6 rounded-full hover:bg-gray-800 transition">
                    Continue with Free
                </a>
            </article>
        @endif
        @foreach ($tiers as $tier)
            @php
                $tierDescription = match (strtolower((string) $tier->slug)) {
                    'core' => 'Essential access for angels ready to discover and participate.',
                    'advanced' => 'Deeper visibility and tools for active, hands-on investors.',
                    'institutional' => 'Expanded access for funds, family offices and investment teams.',
                    default => 'Premium access to the Bangladesh Angels investor network.',
                };
            @endphp
            <article class="ban-subscription-plan-card border rounded-lg p-6 shadow-sm bg-white text-center flex flex-col h-full {{ $tier->is_highlighted ? 'ban-subscription-plan-card--highlighted relative' : '' }}">
                <h3 class="ban-subscription-plan-card__name text-lg font-bold text-gray-800 mb-2 uppercase">{{ $tier->name }}</h3>
                @if ($planPageMode)
                    <p class="ban-subscription-plan-card__description">{{ $tierDescription }}</p>
                @endif
                <p class="ban-subscription-plan-card__price text-4xl font-extrabold text-gray-800 mb-2">
                    ${{ number_format((float) $tier->price_yearly, 0) }} <span class="text-lg font-normal text-gray-500">/yr</span>
                </p>
                @unless ($planPageMode)
                    <div class="ban-subscription-plan-card__icon flex justify-center mb-4">
                        <img class="h-[100px]" src="{{ $tier->iconAsset() }}" alt="" width="100" height="100" loading="lazy">
                    </div>
                @endunless
                @if ($tier->is_highlighted)
                    <span class="ban-subscription-plan-card__badge absolute top-4 right-4 bg-purple-200 text-purple-600 text-xs font-semibold px-2 py-1 rounded-full uppercase">
                        {{ $planPageMode ? 'Most popular' : 'Popular' }}
                    </span>
                @endif
                @if ($planPageMode)
                    <p class="ban-subscription-plan-card__features-label">Your membership includes</p>
                @endif
                <ul class="ban-subscription-plan-card__features text-gray-600 space-y-2 mb-6">
                    @foreach ($tier->includedFeatureLines() as $line)
                        <li class="ban-subscription-plan-card__feature ban-subscription-plan-card__feature--included flex items-center justify-center space-x-2">
                            <span aria-hidden="true" class="text-green-600">✔</span> <span>{{ $line }}</span>
                        </li>
                    @endforeach
                    @foreach ($tier->excludedFeatureLines() as $line)
                        <li class="ban-subscription-plan-card__feature ban-subscription-plan-card__feature--excluded flex items-center justify-center space-x-2">
                            <span aria-hidden="true" class="text-gray-400">✘</span> <span>{{ $line }}</span>
                        </li>
                    @endforeach
                </ul>
                <form class="ban-subscription-plan-card__form" method="POST" action="{{ route('checkout') }}">
                    @csrf
                    <input type="hidden" name="plan" value="{{ $tier->slug }}">
                    <input type="hidden" name="plan_price" value="{{ $tier->price_yearly }}">
                    <button type="submit" class="ban-subscription-plan-card__button mt-auto bg-green-600 text-white py-2 px-6 rounded-full hover:bg-green-700 transition">
                        Choose {{ $tier->name }}
                    </button>
                </form>
            </article>
        @endforeach
    </div>
@endif
