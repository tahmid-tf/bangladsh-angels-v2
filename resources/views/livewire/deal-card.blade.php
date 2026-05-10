@php
    $href = auth()->check()
        ? (($deal->type !== 'review') ? route('deal.view', $deal) : $deal->groupchat_invite_link)
        : route('deal.view', $deal);
    $pitchDeckHref = auth()->check()
        ? ((! auth()->user()->isFree())
            ? ($deal->pitch_deck_url ?: route('deal.view', $deal))
            : route('plans'))
        : route('deal.view', $deal);
    $rawDesc = $deal->description ?? '';
    $oneLiner = $rawDesc !== '' ? \Illuminate\Support\Str::limit(strip_tags($rawDesc), 140, '…') : '—';
    $stage = $deal->investment_stage ? $deal->investment_stage : '—';
    $amount = $deal->amount_seeking ? '$ '.$deal->amountSeeking() : '—';
    $hideAmountSeeking = $deal->type === 'portfolio';

    $ctaLabel = match ($deal->type) {
        'review' => 'Join WhatsApp Group',
        'portfolio' => 'View Portfolio',
        'invest' => 'Express interest to invest',
        'commit' => 'Enter commitment (amount & deadline)',
        default => ucfirst((string) $deal->type),
    };
@endphp

<article class="flex h-full flex-col rounded-[1.75rem] bg-gradient-to-b from-[#108A5E] to-[#0B3022] p-6 md:p-7 text-white shadow-lg ring-1 ring-black/5">
    <div class="flex justify-center">
        <div class="h-20 w-20 md:h-24 md:w-24 shrink-0 overflow-hidden rounded-full border-2 border-white/90 bg-white shadow-md">
            <img src="{{ $deal->getLogoUrl() }}" alt="" class="h-full w-full object-cover object-center">
        </div>
    </div>
    <h3 class="mt-5 text-center text-lg md:text-xl font-bold tracking-tight">
        <a href="{{ $pitchDeckHref }}"
           target="_blank"
           rel="noopener noreferrer"
           class="text-inherit hover:underline decoration-white/80 underline-offset-4 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/80 rounded-sm">
            {{ $deal->title }}
        </a>
    </h3>

    <div class="mt-6 flex flex-1 flex-col space-y-3 text-sm leading-relaxed text-white/95">
        <div>
            <p class="font-medium text-white/80">One-Liner:</p>
            <p class="mt-0.5">{{ $oneLiner }}</p>
        </div>
        <div>
            <p class="font-medium text-white/80">Investment Stage:</p>
            <p class="mt-0.5">{{ $stage }}</p>
        </div>
        @if (! $hideAmountSeeking)
            <div>
                <p class="font-medium text-white/80">Amount Seeking</p>
                <p class="mt-0.5">{{ $amount }}</p>
            </div>
        @endif
    </div>

    <a href="{{ $href }}"
       target="_blank"
       rel="noopener noreferrer"
       class="mt-8 inline-flex w-full items-center justify-center rounded-full border border-white/35 bg-white/15 px-4 py-3 text-center text-xs sm:text-sm font-medium leading-snug tracking-wide text-white shadow-sm backdrop-blur-sm transition hover:bg-white/25 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/80">
        {{ $ctaLabel }}
    </a>
</article>
