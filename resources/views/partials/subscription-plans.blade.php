{{-- Expects $tiers (Collection of SubscriptionTier). Optional: $tierSectionTitle, $tierSectionSubtitle --}}
@php
    $tierSectionTitle = $tierSectionTitle ?? 'Flexible plans for your investment needs';
    $tierSectionSubtitle = $tierSectionSubtitle ?? 'Choose your plan and make investment work like magic';
    $showFreeTierOption = $showFreeTierOption ?? false;
    $gridColsClass = $showFreeTierOption ? 'grid-cols-1 md:grid-cols-2 xl:grid-cols-4' : 'grid-cols-1 md:grid-cols-3';
@endphp

@if (session('error'))
    <div class="max-w-2xl mx-auto mb-8 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg" role="alert">
        {{ session('error') }}
    </div>
@endif

<div class="text-center mb-10">
    <h2 class="text-2xl font-bold text-gray-800">{{ $tierSectionTitle }}</h2>
    <p class="text-gray-500">{{ $tierSectionSubtitle }}</p>
</div>

@if ($tiers->isEmpty())
    <p class="text-center text-gray-600">No subscription plans are available at the moment. Please check back later.</p>
@else
    <div class="grid {{ $gridColsClass }} gap-8">
        @if ($showFreeTierOption)
            @php
                $freeContinueRoute = auth()->check() && auth()->user()->is_approved ? route('dashboard') : route('approval.success');
            @endphp
            <div class="border rounded-lg p-6 shadow-sm bg-white text-center">
                <h3 class="text-lg font-bold text-gray-800 mb-2 uppercase">Free</h3>
                <p class="text-4xl font-extrabold text-gray-800 mb-2">
                    $0 <span class="text-lg font-normal text-gray-500">/yr</span>
                </p>
                <div class="flex justify-center mb-4">
                    <img class="h-[100px]" src="{{ asset('plan_free.webp') }}" alt="Free tier">
                </div>
                <ul class="text-gray-600 space-y-2">
                    <li class="flex items-center justify-center space-x-2">
                        <span class="text-green-600">✔</span> <span>Keep your free investor account</span>
                    </li>
                    <li class="flex items-center justify-center space-x-2">
                        <span class="text-green-600">✔</span> <span>Upgrade any time later</span>
                    </li>
                </ul>
                <a href="{{ $freeContinueRoute }}" class="inline-block mt-6 bg-gray-700 text-white py-2 px-6 rounded-full hover:bg-gray-800 transition">
                    Continue with Free
                </a>
            </div>
        @endif
        @foreach ($tiers as $tier)
            <div class="border rounded-lg p-6 shadow-sm bg-white text-center {{ $tier->is_highlighted ? 'relative' : '' }}">
                <h3 class="text-lg font-bold text-gray-800 mb-2 uppercase">{{ $tier->name }}</h3>
                <p class="text-4xl font-extrabold text-gray-800 mb-2">
                    ${{ number_format((float) $tier->price_yearly, 0) }} <span class="text-lg font-normal text-gray-500">/yr</span>
                </p>
                <div class="flex justify-center mb-4">
                    <img class="h-[100px]" src="{{ $tier->iconAsset() }}" alt="{{ $tier->name }}">
                </div>
                @if ($tier->is_highlighted)
                    <span class="absolute top-4 right-4 bg-purple-200 text-purple-600 text-xs font-semibold px-2 py-1 rounded-full uppercase">
                        Popular
                    </span>
                @endif
                <ul class="text-gray-600 space-y-2 {{ $tier->is_highlighted ? 'mb-6' : '' }}">
                    @foreach ($tier->includedFeatureLines() as $line)
                        <li class="flex items-center justify-center space-x-2">
                            <span class="text-green-600">✔</span> <span>{{ $line }}</span>
                        </li>
                    @endforeach
                    @foreach ($tier->excludedFeatureLines() as $line)
                        <li class="flex items-center justify-center space-x-2">
                            <span class="text-gray-400">✘</span> <span>{{ $line }}</span>
                        </li>
                    @endforeach
                </ul>
                <form method="POST" action="{{ route('checkout') }}">
                    @csrf
                    <input type="hidden" name="plan" value="{{ $tier->slug }}">
                    <input type="hidden" name="plan_price" value="{{ $tier->price_yearly }}">
                    <button type="submit" class="mt-6 bg-green-600 text-white py-2 px-6 rounded-full hover:bg-green-700 transition">
                        Choose {{ $tier->name }}
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endif
