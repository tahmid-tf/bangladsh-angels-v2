@php
    /** @var \App\Models\ResourceHubCard|null $card */
    $card = $card ?? null;
@endphp

<div>
    <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Card title</label>
    <input type="text" name="title" id="title" value="{{ old('title', $card?->title) }}" required maxlength="255"
        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
</div>

<div>
    <label for="one_liner" class="block text-sm font-semibold text-gray-700 mb-1">One-liner</label>
    <textarea name="one_liner" id="one_liner" rows="4" required maxlength="2000"
        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">{{ old('one_liner', $card?->one_liner) }}</textarea>
</div>

<div>
    <label for="link" class="block text-sm font-semibold text-gray-700 mb-1">Learn more link</label>
    <input type="text" name="link" id="link" value="{{ old('link', $card?->link) }}" required maxlength="2048"
        placeholder="https://… or mailto:hello@example.com"
        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
    <p class="mt-1 text-xs text-gray-500">Use a full URL (https://…) or a mailto: link.</p>
    <div class="mt-2 flex flex-wrap gap-2">
        <button type="button" data-fill-target="link" data-fill-value="https://deckvue.ai" class="rounded-full border border-gray-300 px-3 py-1 text-xs font-semibold text-gray-700 hover:bg-gray-50">DeckVue</button>
        <button type="button" data-fill-target="link" data-fill-value="https://calendar.google.com/calendar/u/0/appointments/schedules/AcZssZ1oFoHy0m9As4PtSfm4Ee-nVyoZRNNyZ38doHCWpVwDfo5u3qxnesRT_LqD_Fv5nUlbE3EvxyYN" class="rounded-full border border-gray-300 px-3 py-1 text-xs font-semibold text-gray-700 hover:bg-gray-50">Calendar</button>
    </div>
</div>

<div>
    <label for="cta_label" class="block text-sm font-semibold text-gray-700 mb-1">Second button text (CTA, optional)</label>
    <input type="text" name="cta_label" id="cta_label" value="{{ old('cta_label', $card?->cta_label) }}" maxlength="120"
        placeholder="Book a call / Book a demo"
        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
    <div class="mt-2 flex flex-wrap gap-2">
        <button type="button" data-fill-target="cta_label" data-fill-value="Book a call" class="rounded-full border border-gray-300 px-3 py-1 text-xs font-semibold text-gray-700 hover:bg-gray-50">Book a call</button>
        <button type="button" data-fill-target="cta_label" data-fill-value="Book a demo" class="rounded-full border border-gray-300 px-3 py-1 text-xs font-semibold text-gray-700 hover:bg-gray-50">Book a demo</button>
    </div>
</div>

<div>
    <label for="cta_link" class="block text-sm font-semibold text-gray-700 mb-1">Second button link (optional)</label>
    <input type="text" name="cta_link" id="cta_link" value="{{ old('cta_link', $card?->cta_link) }}" maxlength="2048"
        placeholder="https://calendar... or https://deckvue.ai/..."
        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
    <div class="mt-2 flex flex-wrap gap-2">
        <button type="button" data-fill-target="cta_link" data-fill-value="https://calendar.google.com/calendar/u/0/appointments/schedules/AcZssZ1oFoHy0m9As4PtSfm4Ee-nVyoZRNNyZ38doHCWpVwDfo5u3qxnesRT_LqD_Fv5nUlbE3EvxyYN" class="rounded-full border border-gray-300 px-3 py-1 text-xs font-semibold text-gray-700 hover:bg-gray-50">Calendar</button>
        <button type="button" data-fill-target="cta_link" data-fill-value="https://deckvue.ai" class="rounded-full border border-gray-300 px-3 py-1 text-xs font-semibold text-gray-700 hover:bg-gray-50">DeckVue</button>
    </div>
</div>

<div>
    <label for="logo" class="block text-sm font-semibold text-gray-700 mb-1">Logo</label>
    @if ($card?->logoUrl())
        <p class="text-sm text-gray-600 mb-2">Current logo:</p>
        <img src="{{ $card->logoUrl() }}" alt="" class="h-20 w-20 rounded-full object-cover border border-gray-200 mb-3">
        <label class="mt-2 flex cursor-pointer items-center gap-2 text-sm text-gray-700">
            <input type="checkbox" name="remove_logo" value="1" class="rounded border-gray-300 text-[#0a5554] focus:ring-[#0a5554]">
            <span>Remove current logo</span>
        </label>
    @endif
    <input type="file" name="logo" id="logo" accept="image/*"
        class="mt-3 block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-green-50 file:px-4 file:py-2 file:font-semibold file:text-[#0a5554]">
    <p class="mt-1 text-xs text-gray-500">Optional. Square images work best. Max 4&nbsp;MB. Uploading a new image replaces the current one.</p>
</div>

<script>
    (function () {
        const fillButtons = document.querySelectorAll('[data-fill-target][data-fill-value]');
        fillButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const target = button.getAttribute('data-fill-target');
                const value = button.getAttribute('data-fill-value');
                const input = target ? document.getElementById(target) : null;
                if (input) {
                    input.value = value || '';
                    input.dispatchEvent(new Event('input', { bubbles: true }));
                }
            });
        });
    })();
</script>
