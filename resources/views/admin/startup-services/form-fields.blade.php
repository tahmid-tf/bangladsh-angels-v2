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
    <div class="flex-1 min-w-0 space-y-4">
        <div>
            <label for="show_brochure_link" class="text-sm font-semibold text-gray-700">Show brochure link under this card</label>
            <p class="text-xs text-gray-500 mt-0.5">When enabled, visitors see “Click here to see our brochure” under the CTA on <code class="text-[11px] bg-gray-100 px-1 rounded">/startups</code>.</p>
        </div>
        <div>
            <label for="brochure_url" class="block text-sm font-semibold text-gray-700 mb-1">Brochure link (optional)</label>
            <input type="url" name="brochure_url" id="brochure_url" value="{{ old('brochure_url', $service?->brochure_url) }}" maxlength="2048" placeholder="https://example.com/brochure.pdf"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
            <p class="mt-1 text-xs text-gray-500">Paste a full <code class="text-[11px] bg-gray-100 px-1 rounded">https://</code> URL to a PDF or hosted document.</p>
            @error('brochure_url')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="brochure" class="block text-sm font-semibold text-gray-700 mb-1">Or upload brochure PDF</label>
            @php
                $brochureMedia = $service?->getFirstMedia(\App\Models\StartupService::MEDIA_BROCHURE);
            @endphp
            @if ($brochureMedia)
                <p class="text-sm text-gray-600 mb-2">Current file: <a href="{{ $brochureMedia->getUrl() }}" target="_blank" rel="noopener noreferrer" class="font-semibold text-[#0a5554] underline">{{ $brochureMedia->file_name }}</a></p>
                <label class="flex items-center gap-2 text-sm text-gray-700 mb-3">
                    <input type="checkbox" name="remove_brochure" value="1" class="rounded border-gray-300 text-green-600 focus:ring-[#0a5554]" @checked(old('remove_brochure'))>
                    Remove uploaded PDF
                </label>
            @endif
            <input type="file" name="brochure" id="brochure" accept="application/pdf,.pdf"
                class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-green-50 file:px-4 file:py-2 file:font-semibold file:text-[#0a5554]">
            <p class="mt-1 text-xs text-gray-500">PDF only, max 10&nbsp;MB. An upload takes precedence over the link until you remove it.</p>
            @error('brochure')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <p class="text-xs text-gray-500 border-t border-gray-200 pt-3">If both link and upload are empty, the public page uses the site default <code class="text-[11px] bg-gray-100 px-1 rounded">/MoU.pdf</code> (<code class="text-[11px] bg-gray-100 px-1 rounded">public/MoU.pdf</code>).</p>
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
