@props(['member'])

<div {{ $attributes->class(['bg-white flex flex-col items-center rounded-2xl border border-green-100/80 shadow-md p-8 text-center hover:shadow-lg hover:border-[#36b37e]/30 transition']) }}>
    <div class="relative mx-auto mb-5 aspect-square w-36 max-w-full sm:w-40 shrink-0 overflow-hidden rounded-full bg-gray-100 ring-2 ring-[#36b37e]/20 ring-offset-2 ring-offset-white isolate">
        @if ($member->photoUrl())
            <img src="{{ $member->photoUrl() }}" alt="{{ $member->name }}" width="160" height="160" loading="lazy" decoding="async" class="absolute inset-0 h-full w-full max-h-full max-w-full object-cover object-center block select-none">
        @else
            <div class="absolute inset-0 flex items-center justify-center text-xs font-medium text-gray-400" aria-hidden="true">Photo</div>
        @endif
    </div>
    <h3 class="text-lg font-bold text-gray-900">{{ $member->name }}</h3>
    <p class="mt-1 text-sm text-gray-600 leading-snug">{{ $member->title }}</p>
    @if (filled($member->subtitle))
        <p class="mt-0.5 text-sm text-gray-600 leading-snug">{{ $member->subtitle }}</p>
    @endif
    @if (filled($member->linkedin_url))
        <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener noreferrer" class="mt-4 inline-flex items-center justify-center rounded-full border border-[#0f3d34]/20 bg-[#f7fdf9] px-4 py-1.5 text-sm font-bold text-[#0f3d34] hover:bg-[#e8f5ef] transition" aria-label="LinkedIn profile for {{ $member->name }}">in</a>
    @endif
</div>
