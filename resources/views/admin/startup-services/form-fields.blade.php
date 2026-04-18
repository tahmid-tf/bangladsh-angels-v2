@php
    /** @var \App\Models\StartupService|null $service */
    $service = $service ?? null;
    $bulletsText = old('bullets_text', $service ? implode("\n", $service->bulletList()) : '');
    $brochureDefault = ($service?->show_brochure_link ?? true) ? '1' : '0';
    $brochureChecked = old('show_brochure_link', $brochureDefault) === '1';
@endphp

<div>
    <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
    <input type="text" name="title" id="title" value="{{ old('title', $service?->title) }}" required maxlength="255"
        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
</div>

<div>
    <label for="intro" class="block text-sm font-semibold text-gray-700 mb-1">Introduction</label>
    <textarea name="intro" id="intro" rows="4" required maxlength="5000"
        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">{{ old('intro', $service?->intro) }}</textarea>
    <p class="mt-1 text-xs text-gray-500">Short paragraph below the title on the Startups page.</p>
</div>

<div>
    <label for="bullets_text" class="block text-sm font-semibold text-gray-700 mb-1">Bullet points</label>
    <textarea name="bullets_text" id="bullets_text" rows="8" maxlength="10000"
        placeholder="One bullet per line"
        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554] font-mono text-sm">{{ $bulletsText }}</textarea>
    <p class="mt-1 text-xs text-gray-500">One line per bullet; empty lines are ignored.</p>
</div>

<div>
    <label for="footer_note" class="block text-sm font-semibold text-gray-700 mb-1">Footer note (optional)</label>
    <textarea name="footer_note" id="footer_note" rows="2" maxlength="2000"
        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">{{ old('footer_note', $service?->footer_note) }}</textarea>
    <p class="mt-1 text-xs text-gray-500">Small print below the bullet list.</p>
</div>

<div>
    <label for="link" class="block text-sm font-semibold text-gray-700 mb-1">CTA link</label>
    <input type="text" name="link" id="link" value="{{ old('link', $service?->link) }}" required maxlength="2048"
        placeholder="https://… or mailto:hello@example.com"
        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
    <p class="mt-1 text-xs text-gray-500">Use a full URL (https://…) or a mailto: link.</p>
</div>

<div>
    <label for="cta_label" class="block text-sm font-semibold text-gray-700 mb-1">Button text (CTA)</label>
    <input type="text" name="cta_label" id="cta_label" value="{{ old('cta_label', $service?->cta_label ?? 'Get in touch') }}" required maxlength="120"
        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
</div>

<div>
    <label for="sort_order" class="block text-sm font-semibold text-gray-700 mb-1">Display order</label>
    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $service?->sort_order ?? '') }}" min="0" max="999999"
        class="w-full max-w-xs rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
    <p class="mt-1 text-xs text-gray-500">Lower numbers appear first. Leave blank when adding to place at the end.</p>
</div>

<div class="flex items-start gap-3 rounded-lg border border-gray-200 bg-gray-50 px-4 py-3">
    <input type="hidden" name="show_brochure_link" value="0">
    <input type="checkbox" name="show_brochure_link" id="show_brochure_link" value="1" class="mt-1 h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-[#0a5554]"
        @checked($brochureChecked)>
    <div>
        <label for="show_brochure_link" class="text-sm font-semibold text-gray-700">Show brochure link under this card</label>
        <p class="text-xs text-gray-500 mt-0.5">Uses the same brochure PDF as the Resources page.</p>
    </div>
</div>

<div>
    <label for="logo" class="block text-sm font-semibold text-gray-700 mb-1">Logo</label>
    @if ($service?->logoUrl())
        <p class="text-sm text-gray-600 mb-2">Current:</p>
        <img src="{{ $service->logoUrl() }}" alt="" class="h-20 w-20 rounded-full object-cover border border-gray-200 mb-3">
    @endif
    <input type="file" name="logo" id="logo" accept="image/*"
        class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-green-50 file:px-4 file:py-2 file:font-semibold file:text-[#0a5554]">
    <p class="mt-1 text-xs text-gray-500">Optional. Square images work best in the circle. Max 4&nbsp;MB.</p>
</div>
