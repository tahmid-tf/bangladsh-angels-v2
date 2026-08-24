@php($programCard = $card ?? null)

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label for="eyebrow" class="block text-sm font-semibold text-gray-700 mb-1">Category label</label>
        <input type="text" name="eyebrow" id="eyebrow" value="{{ old('eyebrow', $programCard?->eyebrow) }}" required maxlength="120"
               placeholder="Women-led investment"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">
    </div>
    <div>
        <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Program title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $programCard?->title) }}" required maxlength="255"
               placeholder="BWIN"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">
    </div>
</div>

<div>
    <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
    <textarea name="description" id="description" rows="5" required maxlength="1200"
              class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">{{ old('description', $programCard?->description) }}</textarea>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label for="primary_label" class="block text-sm font-semibold text-gray-700 mb-1">Primary button label</label>
        <input type="text" name="primary_label" id="primary_label" value="{{ old('primary_label', $programCard?->primary_label) }}" required maxlength="120"
               placeholder="Explore program"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">
    </div>
    <div>
        <label for="primary_link" class="block text-sm font-semibold text-gray-700 mb-1">Primary button link</label>
        <input type="text" name="primary_link" id="primary_link" value="{{ old('primary_link', $programCard?->primary_link) }}" required maxlength="2048"
               placeholder="/bwin or https://example.com"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">
    </div>
</div>

<div>
    <h2 class="text-sm font-bold text-gray-800">Secondary button <span class="font-normal text-gray-500">(optional)</span></h2>
    <p class="text-xs text-gray-500 mt-1 mb-3">Fill in both fields to display a second action.</p>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="secondary_label" class="block text-sm font-semibold text-gray-700 mb-1">Button label</label>
            <input type="text" name="secondary_label" id="secondary_label" value="{{ old('secondary_label', $programCard?->secondary_label) }}" maxlength="120"
                   placeholder="Book a call"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">
        </div>
        <div>
            <label for="secondary_link" class="block text-sm font-semibold text-gray-700 mb-1">Button link</label>
            <input type="text" name="secondary_link" id="secondary_link" value="{{ old('secondary_link', $programCard?->secondary_link) }}" maxlength="2048"
                   placeholder="https://calendar.example.com"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label for="theme" class="block text-sm font-semibold text-gray-700 mb-1">Card appearance</label>
        <select name="theme" id="theme" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">
            @foreach (\App\Models\LandingProgramCard::THEMES as $value => $label)
                <option value="{{ $value }}" @selected(old('theme', $programCard?->theme ?? 'white') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="sort_order" class="block text-sm font-semibold text-gray-700 mb-1">Sort order</label>
        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $programCard?->sort_order) }}" min="0" max="999" step="1"
               placeholder="Automatically placed last"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">
    </div>
</div>
