@extends('layouts.admin')
@section('page_title','Add a new Resource | Bangladesh Angels Network')
@section('page_content')

<section class="container mx-auto px-6 py-12 bg-white rounded-lg shadow-lg mt-8">
    <header class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold">Add New Resource</h1>
            <p class="text-gray-500">Dashboard &gt; Resources &gt; Add new resource</p>
        </div>
        <div class="flex space-x-4">
            <!-- The form ID is "resource-form" -->
            <button type="submit" form="resource-form" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">
                Add new resource
            </button>
        </div>
    </header>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="resource-form" action="{{ route('resource.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Banner Image Upload -->
        <div class="text-center border-dashed border-2 border-gray-300 rounded-lg p-6 mb-6">
            <label class="block cursor-pointer">
                <div class="mb-4">
                    <img
                        id="banner-preview"
                        src="{{ asset('placeholder_banner.png') }}"
                        alt="Upload Placeholder"
                        class="mx-auto rounded-lg h-40 w-full object-cover"
                    >
                </div>
                <input type="file" name="banner_image" accept="image/*" class="hidden" id="banner-input">
                <p class="text-gray-500 text-sm">Upload Banner Image</p>
                <p class="text-gray-400 text-xs">Allowed: *.jpeg, *.png, *.gif (Max: ~2MB, for example)</p>
            </label>
        </div>

        <script>
            // Preview for the Banner Image
            const bannerInput = document.getElementById('banner-input');
            const bannerPreview = document.getElementById('banner-preview');

            bannerInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        bannerPreview.src = e.target.result;
                        bannerPreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    // Reset to placeholder if no file is selected
                    bannerPreview.src = "{{ asset('placeholder_banner.png') }}";
                }
            });
        </script>

        <!-- Resource Basic Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Title -->
            <div>
                <label for="title" class="block text-gray-700 font-semibold mb-2">Title *</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    placeholder="Resource title"
                    class="input-field"
                    value="{{ old('title') }}"
                    required
                >
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Type (Enum) -->
            <div>
                <label for="type" class="block text-gray-700 font-semibold mb-2">Type *</label>
                <select
                    id="type"
                    name="type"
                    class="input-field"
                    required
                >
                    <option value="">Select Type</option>
                    <option value="event"   {{ old('type') === 'event'   ? 'selected' : '' }}>Event</option>
                    <option value="webinar" {{ old('type') === 'webinar' ? 'selected' : '' }}>Webinar</option>
                </select>
                @error('type')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-gray-700 font-semibold mb-2">Location</label>
                <input
                    type="text"
                    id="location"
                    name="location"
                    placeholder="Venue or address"
                    class="input-field"
                    value="{{ old('location') }}"
                >
                @error('location')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Date -->
            <div>
                <label for="date" class="block text-gray-700 font-semibold mb-2">Date</label>
                <input
                    type="date"
                    id="date"
                    name="date"
                    class="input-field"
                    value="{{ old('date') }}"
                >
                @error('date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Start Time -->
            <div>
                <label for="start_time" class="block text-gray-700 font-semibold mb-2">Start Time</label>
                <input
                    type="time"
                    id="start_time"
                    name="start_time"
                    class="input-field"
                    value="{{ old('start_time') }}"
                >
                @error('start_time')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- End Time -->
            <div>
                <label for="end_time" class="block text-gray-700 font-semibold mb-2">End Time</label>
                <input
                    type="time"
                    id="end_time"
                    name="end_time"
                    class="input-field"
                    value="{{ old('end_time') }}"
                >
                @error('end_time')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Registration Fee -->
            <div>
                <label for="registration_fee" class="block text-gray-700 font-semibold mb-2">Registration Fee</label>
                <input
                    type="number"
                    step="0.01"
                    id="registration_fee"
                    name="registration_fee"
                    placeholder="1500"
                    class="input-field"
                    value="{{ old('registration_fee') }}"
                >
                @error('registration_fee')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-gray-700 font-semibold mb-2">Description *</label>
            <textarea
                id="description"
                name="description"
                placeholder="Describe this resource or event"
                rows="4"
                class="input-field"
                required
            >{{ old('description') }}</textarea>
            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="rounded-lg border border-emerald-100 bg-emerald-50/50 p-5 space-y-5">
            <h2 class="text-lg font-bold text-[#0f3d34]">Public listing</h2>
            <div>
                <label for="cta_link" class="block text-gray-700 font-semibold mb-2">RSVP / CTA link</label>
                <input
                    type="text"
                    id="cta_link"
                    name="cta_link"
                    inputmode="url"
                    autocomplete="url"
                    placeholder="https://forms.gle/… or your RSVP URL"
                    class="input-field"
                    value="{{ old('cta_link') }}"
                >
                <p class="mt-1 text-xs text-gray-600">Optional. When set, a <strong>Register / RSVP</strong> button appears on the event card on the homepage and the member Resources page.</p>
                @error('cta_link')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <input type="hidden" name="show_on_landing" value="0">
                <label class="flex cursor-pointer items-start gap-3">
                    <input type="checkbox" name="show_on_landing" value="1" class="mt-1 rounded border-gray-300 text-green-600 focus:ring-green-600" {{ old('show_on_landing') ? 'checked' : '' }}>
                    <span class="text-sm text-gray-700"><strong class="text-gray-900">Show on homepage</strong> under “BAN Events” (only for type <em>Event</em>; up to six, ordered by date).</span>
                </label>
            </div>
        </div>

        <!-- Registration Details -->
        <div>
            <label for="registration_details" class="block text-gray-700 font-semibold mb-2">Registration Details</label>
            <textarea
                id="registration_details"
                name="registration_details"
                placeholder="How to register, special instructions, etc."
                rows="3"
                class="input-field"
            >{{ old('registration_details') }}</textarea>
            @error('registration_details')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Benefits (Dynamic JSON Array) -->
        <div class="border rounded-lg p-4">
            <h2 class="text-lg font-bold mb-4">Benefits</h2>
            <p class="text-sm text-gray-500 mb-4">Add bullet points or reasons to attend. Empty rows are not saved.</p>
            @php
                $benefitRows = is_array(old('benefits')) ? array_values(old('benefits')) : [];
                if (count($benefitRows) === 0) {
                    $benefitRows = [''];
                }
            @endphp
            <div id="benefits-container" class="space-y-4" data-list-type="simple">
                @foreach ($benefitRows as $index => $benefit)
                    <div class="dynamic-list-row flex items-start gap-2">
                        <input
                            type="text"
                            name="benefits[{{ $index }}]"
                            placeholder="e.g., Exclusive networking opportunities"
                            class="input-field min-w-0 flex-1"
                            value="{{ is_scalar($benefit) ? $benefit : '' }}"
                        >
                        <button type="button" class="list-remove-btn mt-1 shrink-0 rounded border border-red-200 px-2 py-1 text-sm text-red-600 hover:bg-red-50 @if (count($benefitRows) <= 1) hidden @endif" title="Remove row">Remove</button>
                    </div>
                @endforeach
            </div>
            <button
                type="button"
                id="add-benefit-btn"
                class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg mt-4"
            >
                + Add Benefit
            </button>
        </div>

        <!-- Event Highlights (Dynamic JSON Array) -->
        <div class="border rounded-lg p-4">
            <h2 class="text-lg font-bold mb-4">Event Highlights</h2>
            <p class="text-sm text-gray-500 mb-4">Keynotes, panel discussions, etc. Empty rows are not saved.</p>
            @php
                $highlightRows = is_array(old('event_highlights')) ? array_values(old('event_highlights')) : [];
                if (count($highlightRows) === 0) {
                    $highlightRows = [''];
                }
            @endphp
            <div id="highlights-container" class="space-y-4" data-list-type="simple">
                @foreach ($highlightRows as $index => $highlight)
                    <div class="dynamic-list-row flex items-start gap-2">
                        <input
                            type="text"
                            name="event_highlights[{{ $index }}]"
                            placeholder="e.g., Fireside chat with industry leaders"
                            class="input-field min-w-0 flex-1"
                            value="{{ is_scalar($highlight) ? $highlight : '' }}"
                        >
                        <button type="button" class="list-remove-btn mt-1 shrink-0 rounded border border-red-200 px-2 py-1 text-sm text-red-600 hover:bg-red-50 @if (count($highlightRows) <= 1) hidden @endif" title="Remove row">Remove</button>
                    </div>
                @endforeach
            </div>
            <button
                type="button"
                id="add-highlight-btn"
                class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg mt-4"
            >
                + Add Highlight
            </button>
        </div>

        <!-- Target Audience (Dynamic JSON Array) -->
        <div class="border rounded-lg p-4">
            <h2 class="text-lg font-bold mb-4">Target Audience</h2>
            <p class="text-sm text-gray-500 mb-4">Who should attend? Empty rows are not saved.</p>
            @php
                $audienceRows = is_array(old('target_audience')) ? array_values(old('target_audience')) : [];
                if (count($audienceRows) === 0) {
                    $audienceRows = [''];
                }
            @endphp
            <div id="audience-container" class="space-y-4" data-list-type="simple">
                @foreach ($audienceRows as $index => $audience)
                    <div class="dynamic-list-row flex items-start gap-2">
                        <input
                            type="text"
                            name="target_audience[{{ $index }}]"
                            placeholder="e.g., Angel Investors"
                            class="input-field min-w-0 flex-1"
                            value="{{ is_scalar($audience) ? $audience : '' }}"
                        >
                        <button type="button" class="list-remove-btn mt-1 shrink-0 rounded border border-red-200 px-2 py-1 text-sm text-red-600 hover:bg-red-50 @if (count($audienceRows) <= 1) hidden @endif" title="Remove row">Remove</button>
                    </div>
                @endforeach
            </div>
            <button
                type="button"
                id="add-audience-btn"
                class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg mt-4"
            >
                + Add Audience
            </button>
        </div>

        <!-- Speakers (Dynamic JSON Array) -->
        <div class="border rounded-lg p-4">
            <h2 class="text-lg font-bold mb-4">Speakers</h2>
            <p class="text-sm text-gray-500 mb-4">Add speaker info: name, designation, and photo. Empty speaker blocks are not saved.</p>

            @php
                $oldSpeakers = old('speakers');
                if (! is_array($oldSpeakers) || count($oldSpeakers) === 0) {
                    $oldSpeakers = [['name' => '', 'designation' => '']];
                }
                $oldSpeakers = array_values($oldSpeakers);
            @endphp

            <div id="speakers-container" class="space-y-4">
                @foreach ($oldSpeakers as $index => $speakerData)
                    <div class="speaker-entry relative space-y-2 rounded border border-gray-200 p-4">
                        <div class="flex justify-end">
                            <button type="button" class="speaker-remove-btn rounded border border-red-200 px-2 py-1 text-sm text-red-600 hover:bg-red-50 @if (count($oldSpeakers) <= 1) hidden @endif" title="Remove speaker">Remove</button>
                        </div>
                        <div>
                            <input
                                type="text"
                                name="speakers[{{ $index }}][name]"
                                placeholder="Speaker Name"
                                class="input-field"
                                value="{{ $speakerData['name'] ?? '' }}"
                            >
                        </div>
                        <div>
                            <input
                                type="text"
                                name="speakers[{{ $index }}][designation]"
                                placeholder="Speaker Designation"
                                class="input-field"
                                value="{{ $speakerData['designation'] ?? '' }}"
                            >
                        </div>
                        <div class="text-center">
                            <label class="block cursor-pointer">
                                <div class="mb-2">
                                    <img
                                        id="speaker-preview-{{ $index }}"
                                        src="{{ asset('placeholder_speaker.png') }}"
                                        alt="Upload Placeholder"
                                        class="mx-auto h-20 w-20 rounded-full object-cover"
                                    >
                                </div>
                                <input
                                    type="file"
                                    name="speakers[{{ $index }}][image]"
                                    accept="image/*"
                                    class="speaker-image-input hidden"
                                    data-preview-target="speaker-preview-{{ $index }}"
                                >
                                <p class="text-xs text-gray-400">Upload speaker photo</p>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Button to add another speaker -->
            <button
                type="button"
                id="add-speaker-btn"
                class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg mt-4"
            >
                + Add Speaker
            </button>
        </div>

    </form>
</section>

<!-- Tailwind-based styling for inputs -->
<style>
    .input-field {
        border: 1px solid #e2e8f0;
        padding: 0.5rem;
        border-radius: 0.375rem;
        width: 100%;
        background-color: #f9fafb;
    }
    .input-field:focus {
        outline: none;
        border-color: #34d399;
        box-shadow: 0 0 0 3px rgba(52, 211, 153, 0.5);
    }
</style>

<script>
    function refreshSimpleListRemoveButtons(containerId) {
        const container = document.getElementById(containerId);
        if (!container) return;
        const rows = container.querySelectorAll('.dynamic-list-row');
        rows.forEach((row) => {
            const btn = row.querySelector('.list-remove-btn');
            if (btn) btn.classList.toggle('hidden', rows.length <= 1);
        });
    }

    function refreshSpeakerRemoveButtons() {
        const container = document.getElementById('speakers-container');
        if (!container) return;
        const entries = container.querySelectorAll('.speaker-entry');
        entries.forEach((entry) => {
            const btn = entry.querySelector('.speaker-remove-btn');
            if (btn) btn.classList.toggle('hidden', entries.length <= 1);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        refreshSimpleListRemoveButtons('benefits-container');
        refreshSimpleListRemoveButtons('highlights-container');
        refreshSimpleListRemoveButtons('audience-container');
        refreshSpeakerRemoveButtons();
    });

    ['benefits-container', 'highlights-container', 'audience-container'].forEach(function (containerId) {
        document.getElementById(containerId).addEventListener('click', function (e) {
            const removeBtn = e.target.closest('.list-remove-btn');
            if (!removeBtn) return;
            const row = removeBtn.closest('.dynamic-list-row');
            const container = document.getElementById(containerId);
            if (container.querySelectorAll('.dynamic-list-row').length <= 1) return;
            row.remove();
            refreshSimpleListRemoveButtons(containerId);
        });
    });

    document.getElementById('speakers-container').addEventListener('click', function (e) {
        const btn = e.target.closest('.speaker-remove-btn');
        if (!btn) return;
        const entry = btn.closest('.speaker-entry');
        const container = document.getElementById('speakers-container');
        if (container.querySelectorAll('.speaker-entry').length <= 1) return;
        entry.remove();
        refreshSpeakerRemoveButtons();
    });

    document.getElementById('add-benefit-btn').addEventListener('click', function () {
        const container = document.getElementById('benefits-container');
        const idx = container.querySelectorAll('.dynamic-list-row').length;
        container.insertAdjacentHTML('beforeend', `
            <div class="dynamic-list-row flex items-start gap-2">
                <input type="text" name="benefits[${idx}]" placeholder="e.g., Exclusive networking opportunities" class="input-field min-w-0 flex-1">
                <button type="button" class="list-remove-btn mt-1 shrink-0 rounded border border-red-200 px-2 py-1 text-sm text-red-600 hover:bg-red-50" title="Remove row">Remove</button>
            </div>`);
        refreshSimpleListRemoveButtons('benefits-container');
    });

    document.getElementById('add-highlight-btn').addEventListener('click', function () {
        const container = document.getElementById('highlights-container');
        const idx = container.querySelectorAll('.dynamic-list-row').length;
        container.insertAdjacentHTML('beforeend', `
            <div class="dynamic-list-row flex items-start gap-2">
                <input type="text" name="event_highlights[${idx}]" placeholder="e.g., Fireside chat with industry leaders" class="input-field min-w-0 flex-1">
                <button type="button" class="list-remove-btn mt-1 shrink-0 rounded border border-red-200 px-2 py-1 text-sm text-red-600 hover:bg-red-50" title="Remove row">Remove</button>
            </div>`);
        refreshSimpleListRemoveButtons('highlights-container');
    });

    document.getElementById('add-audience-btn').addEventListener('click', function () {
        const container = document.getElementById('audience-container');
        const idx = container.querySelectorAll('.dynamic-list-row').length;
        container.insertAdjacentHTML('beforeend', `
            <div class="dynamic-list-row flex items-start gap-2">
                <input type="text" name="target_audience[${idx}]" placeholder="e.g., Angel Investors" class="input-field min-w-0 flex-1">
                <button type="button" class="list-remove-btn mt-1 shrink-0 rounded border border-red-200 px-2 py-1 text-sm text-red-600 hover:bg-red-50" title="Remove row">Remove</button>
            </div>`);
        refreshSimpleListRemoveButtons('audience-container');
    });

    document.getElementById('add-speaker-btn').addEventListener('click', function () {
        const container = document.getElementById('speakers-container');
        const idx = container.querySelectorAll('.speaker-entry').length;
        container.insertAdjacentHTML('beforeend', `
            <div class="speaker-entry relative space-y-2 rounded border border-gray-200 p-4">
                <div class="flex justify-end">
                    <button type="button" class="speaker-remove-btn rounded border border-red-200 px-2 py-1 text-sm text-red-600 hover:bg-red-50" title="Remove speaker">Remove</button>
                </div>
                <div>
                    <input type="text" name="speakers[${idx}][name]" placeholder="Speaker Name" class="input-field">
                </div>
                <div>
                    <input type="text" name="speakers[${idx}][designation]" placeholder="Speaker Designation" class="input-field">
                </div>
                <div class="text-center">
                    <label class="block cursor-pointer">
                        <div class="mb-2">
                            <img id="speaker-preview-${idx}" src="{{ asset('placeholder_speaker.png') }}" alt="" class="mx-auto h-20 w-20 rounded-full object-cover">
                        </div>
                        <input type="file" name="speakers[${idx}][image]" accept="image/*" class="speaker-image-input hidden" data-preview-target="speaker-preview-${idx}">
                        <p class="text-xs text-gray-400">Upload speaker photo</p>
                    </label>
                </div>
            </div>`);
        refreshSpeakerRemoveButtons();
    });

    document.addEventListener('change', function (e) {
        if (e.target.matches('.speaker-image-input')) {
            const input = e.target;
            const previewId = input.getAttribute('data-preview-target');
            const previewImg = document.getElementById(previewId);
            const file = input.files[0];
            if (file && previewImg) {
                const reader = new FileReader();
                reader.onload = function (evt) {
                    previewImg.src = evt.target.result;
                };
                reader.readAsDataURL(file);
            } else if (previewImg) {
                previewImg.src = "{{ asset('placeholder_speaker.png') }}";
            }
        }
    });
</script>

@endsection
