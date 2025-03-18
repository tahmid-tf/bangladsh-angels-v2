@extends('layouts.admin')
@section('page_title','Edit Resource | Bangladesh Angels Network')
@section('page_content')
@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-4">
        {{ session('success') }}
    </div>
@endif

<section class="container mx-auto px-4 py-8 bg-white rounded-lg shadow-md">
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold mb-1">Edit Resource</h1>
            <p class="text-sm text-gray-500">Dashboard &gt; Resources &gt; Edit Resource</p>
        </div>
        <div class="flex">
            <!-- Delete Form -->
            <form action="{{route('resource.destory',$resource->id)}}" method="POST" onsubmit="return confirmDelete()">
                @csrf
                <button type="submit" class="mt-4 mr-6 md:mt-0 px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Delete
                </button>
            </form>

            <!-- Update Button -->
            <button type="submit" form="resource-form" class="mt-4 md:mt-0 px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                Update Resource
            </button>
        </div>
    </header>

    <!-- Delete Confirmation -->
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this resource? This action cannot be undone.");
        }
    </script>

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

    <form 
        id="resource-form" 
        action="{{ route('resource.update', $resource->id) }}" 
        method="POST" 
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        <!-- Banner Image Upload -->
        <div class="border-dashed border-2 border-gray-300 rounded-lg p-4 mb-6 text-center">
            @php
                // If using Spatie Media Library:
                // $bannerUrl = $resource->getFirstMediaUrl('banner') ?: asset('placeholder_banner.png');
                // Or a custom method: $resource->getBannerUrl()
                $bannerUrl = $resource->getFirstMediaUrl('banner') ?? asset('placeholder_banner.png');
            @endphp
            <label class="block cursor-pointer">
                <img 
                    id="banner-preview" 
                    src="{{ $bannerUrl }}" 
                    alt="Current Banner" 
                    class="mx-auto rounded-lg h-40 w-full object-cover mb-2"
                >
                <input type="file" name="banner_image" accept="image/*" class="hidden" id="banner-input">
                <p class="text-center text-sm text-gray-500">Replace banner</p>
                <p class="text-center text-xs text-gray-400">Max size: ~2MB, Formats: JPEG, PNG, GIF</p>
            </label>
        </div>

        <script>
            // Preview Banner
            const bannerInput = document.getElementById('banner-input');
            const bannerPreview = document.getElementById('banner-preview');

            bannerInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        bannerPreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    bannerPreview.src = "{{ asset('placeholder_banner.png') }}";
                }
            });
        </script>

        <!-- Resource Basic Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Title *</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    class="input-field" 
                    value="{{ old('title', $resource->title) }}" 
                    required
                >
            </div>

            <!-- Type (enum: event, webinar) -->
            <div>
                <label for="type" class="block text-sm font-semibold text-gray-700 mb-1">Type *</label>
                <select id="type" name="type" class="input-field" required>
                    <option value="event"   {{ old('type', $resource->type) == 'event'   ? 'selected' : '' }}>Event</option>
                    <option value="webinar" {{ old('type', $resource->type) == 'webinar' ? 'selected' : '' }}>Webinar</option>
                </select>
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-semibold text-gray-700 mb-1">Location</label>
                <input 
                    type="text" 
                    id="location" 
                    name="location" 
                    class="input-field" 
                    value="{{ old('location', $resource->location) }}"
                >
            </div>

            <!-- Date -->
            <div>
                <label for="date" class="block text-sm font-semibold text-gray-700 mb-1">Date</label>
                <input 
                    type="date" 
                    id="date" 
                    name="date" 
                    class="input-field" 
                    value="{{ old('date', optional($resource->date)->format('Y-m-d')) }}"
                >
            </div>

            <!-- Start Time -->
            <div>
                <label for="start_time" class="block text-sm font-semibold text-gray-700 mb-1">Start Time</label>
                <input 
                    type="time" 
                    id="start_time" 
                    name="start_time" 
                    class="input-field" 
                    value="{{ old('start_time', optional($resource->start_time)->format('H:i')) }}"
                >
            </div>

            <!-- End Time -->
            <div>
                <label for="end_time" class="block text-sm font-semibold text-gray-700 mb-1">End Time</label>
                <input 
                    type="time" 
                    id="end_time" 
                    name="end_time" 
                    class="input-field" 
                    value="{{ old('end_time', optional($resource->end_time)->format('H:i')) }}"
                >
            </div>

            <!-- Registration Fee -->
            <div>
                <label for="registration_fee" class="block text-sm font-semibold text-gray-700 mb-1">Registration Fee</label>
                <input 
                    type="number" 
                    step="0.01" 
                    id="registration_fee" 
                    name="registration_fee" 
                    class="input-field" 
                    value="{{ old('registration_fee', $resource->registration_fee) }}"
                >
            </div>
        </div>

        <!-- Description -->
        <div class="mt-4">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description *</label>
            <textarea 
                id="description" 
                name="description" 
                class="input-field" 
                rows="4" 
                required
            >{{ old('description', $resource->description) }}</textarea>
        </div>

        <!-- Registration Details -->
        <div class="mt-4">
            <label for="registration_details" class="block text-sm font-semibold text-gray-700 mb-1">Registration Details</label>
            <textarea 
                id="registration_details" 
                name="registration_details" 
                class="input-field" 
                rows="3"
            >{{ old('registration_details', $resource->registration_details) }}</textarea>
        </div>

        <!-- Benefits (Dynamic JSON Array) -->
        <div class="border rounded-lg p-4 mt-6">
            <h2 class="text-lg font-bold mb-4">Benefits</h2>
            @php
                // Convert to array if null
                $benefits = old('benefits', $resource->benefits ?? []);
            @endphp
            <div id="benefits-container" class="space-y-4">
                @if(is_array($benefits) && count($benefits) > 0)
                    @foreach($benefits as $index => $benefit)
                        <div class="grid grid-cols-1 gap-2">
                            <input 
                                type="text" 
                                name="benefits[{{ $index }}]" 
                                class="input-field" 
                                value="{{ $benefit }}"
                            >
                        </div>
                    @endforeach
                @else
                    <!-- Default empty field if no data -->
                    <div class="grid grid-cols-1 gap-2">
                        <input 
                            type="text" 
                            name="benefits[0]" 
                            class="input-field" 
                            placeholder="e.g., Exclusive networking opportunities"
                        >
                    </div>
                @endif
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
        <div class="border rounded-lg p-4 mt-6">
            <h2 class="text-lg font-bold mb-4">Event Highlights</h2>
            @php
                $highlights = old('event_highlights', $resource->event_highlights ?? []);
            @endphp
            <div id="highlights-container" class="space-y-4">
                @if(is_array($highlights) && count($highlights) > 0)
                    @foreach($highlights as $index => $highlight)
                        <div class="grid grid-cols-1 gap-2">
                            <input 
                                type="text" 
                                name="event_highlights[{{ $index }}]" 
                                class="input-field" 
                                value="{{ $highlight }}"
                            >
                        </div>
                    @endforeach
                @else
                    <!-- Default empty field if no data -->
                    <div class="grid grid-cols-1 gap-2">
                        <input 
                            type="text" 
                            name="event_highlights[0]" 
                            class="input-field" 
                            placeholder="e.g., Fireside chat with industry leaders"
                        >
                    </div>
                @endif
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
        <div class="border rounded-lg p-4 mt-6">
            <h2 class="text-lg font-bold mb-4">Target Audience</h2>
            @php
                $audience = old('target_audience', $resource->target_audience ?? []);
            @endphp
            <div id="audience-container" class="space-y-4">
                @if(is_array($audience) && count($audience) > 0)
                    @foreach($audience as $index => $aud)
                        <div class="grid grid-cols-1 gap-2">
                            <input 
                                type="text" 
                                name="target_audience[{{ $index }}]" 
                                class="input-field" 
                                value="{{ $aud }}"
                            >
                        </div>
                    @endforeach
                @else
                    <!-- Default empty field -->
                    <div class="grid grid-cols-1 gap-2">
                        <input 
                            type="text" 
                            name="target_audience[0]" 
                            class="input-field" 
                            placeholder="e.g., Angel Investors"
                        >
                    </div>
                @endif
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
        <div class="border rounded-lg p-4 mt-6">
            <h2 class="text-lg font-bold mb-4">Speakers</h2>
            @php
                $oldSpeakers = old('speakers', $resource->speakers ?? []);
            @endphp

            <div id="speakers-container" class="space-y-4">
                @if(is_array($oldSpeakers) && count($oldSpeakers) > 0)
                    @foreach($oldSpeakers as $index => $speakerData)
                        <div class="border border-gray-200 p-4 rounded space-y-2 speaker-entry">
                            <!-- Name -->
                            <div>
                                <input 
                                    type="text" 
                                    name="speakers[{{ $index }}][name]" 
                                    placeholder="Speaker Name" 
                                    class="input-field" 
                                    value="{{ $speakerData['name'] ?? '' }}"
                                >
                            </div>
                            <!-- Designation -->
                            <div>
                                <input 
                                    type="text" 
                                    name="speakers[{{ $index }}][designation]" 
                                    placeholder="Speaker Designation" 
                                    class="input-field" 
                                    value="{{ $speakerData['designation'] ?? '' }}"
                                >
                            </div>
                            <!-- Image Preview -->
                            <div class="text-center">
                                @php
                                    // Attempt to find existing media by custom property
                                    $speakerImage = $resource->getMedia('speakers')->first(function($media) use($index) {
                                        return $media->getCustomProperty('speaker_index') == $index;
                                    });
                                    $speakerImageUrl = $speakerImage 
                                        ? $speakerImage->getUrl() 
                                        : asset('placeholder_speaker.png');
                                @endphp
                                <label class="block cursor-pointer">
                                    <div class="mb-2">
                                        <img 
                                            id="speaker-preview-{{ $index }}" 
                                            src="{{ $speakerImageUrl }}" 
                                            alt="Speaker Image" 
                                            class="mx-auto rounded-full h-20 w-20 object-cover"
                                        >
                                    </div>
                                    <input 
                                        type="file" 
                                        name="speakers[{{ $index }}][image]" 
                                        accept="image/*" 
                                        class="hidden speaker-image-input" 
                                        data-preview-target="speaker-preview-{{ $index }}"
                                    >
                                    <p class="text-gray-400 text-xs">Replace speaker photo</p>
                                </label>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Default single speaker fieldset if no data -->
                    <div class="border border-gray-200 p-4 rounded space-y-2 speaker-entry">
                        <div>
                            <input 
                                type="text" 
                                name="speakers[0][name]" 
                                placeholder="Speaker Name" 
                                class="input-field"
                            >
                        </div>
                        <div>
                            <input 
                                type="text" 
                                name="speakers[0][designation]" 
                                placeholder="Speaker Designation" 
                                class="input-field"
                            >
                        </div>
                        <!-- Image Upload -->
                        <div class="text-center">
                            <label class="block cursor-pointer">
                                <div class="mb-2">
                                    <img 
                                        id="speaker-preview-0" 
                                        src="{{ asset('placeholder_speaker.png') }}" 
                                        alt="Speaker Placeholder" 
                                        class="mx-auto rounded-full h-20 w-20 object-cover"
                                    >
                                </div>
                                <input 
                                    type="file" 
                                    name="speakers[0][image]" 
                                    accept="image/*" 
                                    class="hidden speaker-image-input" 
                                    data-preview-target="speaker-preview-0"
                                >
                                <p class="text-gray-400 text-xs">Upload speaker photo</p>
                            </label>
                        </div>
                    </div>
                @endif
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
    /*******************************************
     * Dynamic Fields: Benefits
     *******************************************/
    let benefitCounter = document.querySelectorAll('#benefits-container .grid').length;
    document.getElementById('add-benefit-btn').addEventListener('click', function () {
        const container = document.getElementById('benefits-container');
        const newField = `
            <div class="grid grid-cols-1 gap-2">
                <input 
                    type="text" 
                    name="benefits[${benefitCounter}]" 
                    class="input-field" 
                    placeholder="e.g., Exclusive networking opportunities"
                >
            </div>`;
        container.insertAdjacentHTML('beforeend', newField);
        benefitCounter++;
    });

    /*******************************************
     * Dynamic Fields: Event Highlights
     *******************************************/
    let highlightCounter = document.querySelectorAll('#highlights-container .grid').length;
    document.getElementById('add-highlight-btn').addEventListener('click', function () {
        const container = document.getElementById('highlights-container');
        const newField = `
            <div class="grid grid-cols-1 gap-2">
                <input 
                    type="text" 
                    name="event_highlights[${highlightCounter}]" 
                    class="input-field" 
                    placeholder="e.g., Fireside chat with industry leaders"
                >
            </div>`;
        container.insertAdjacentHTML('beforeend', newField);
        highlightCounter++;
    });

    /*******************************************
     * Dynamic Fields: Target Audience
     *******************************************/
    let audienceCounter = document.querySelectorAll('#audience-container .grid').length;
    document.getElementById('add-audience-btn').addEventListener('click', function () {
        const container = document.getElementById('audience-container');
        const newField = `
            <div class="grid grid-cols-1 gap-2">
                <input 
                    type="text" 
                    name="target_audience[${audienceCounter}]" 
                    class="input-field" 
                    placeholder="e.g., Angel Investors"
                >
            </div>`;
        container.insertAdjacentHTML('beforeend', newField);
        audienceCounter++;
    });

    /*******************************************
     * Dynamic Fields: Speakers
     *******************************************/
    let speakerCounter = document.querySelectorAll('.speaker-entry').length;
    document.getElementById('add-speaker-btn').addEventListener('click', function () {
        const container = document.getElementById('speakers-container');
        const newSpeaker = `
            <div class="border border-gray-200 p-4 rounded space-y-2 speaker-entry">
                <div>
                    <input 
                        type="text" 
                        name="speakers[${speakerCounter}][name]" 
                        placeholder="Speaker Name" 
                        class="input-field"
                    >
                </div>
                <div>
                    <input 
                        type="text" 
                        name="speakers[${speakerCounter}][designation]" 
                        placeholder="Speaker Designation" 
                        class="input-field"
                    >
                </div>
                <div class="text-center">
                    <label class="block cursor-pointer">
                        <div class="mb-2">
                            <img 
                                id="speaker-preview-${speakerCounter}" 
                                src="{{ asset('placeholder_speaker.png') }}" 
                                alt="Speaker Placeholder" 
                                class="mx-auto rounded-full h-20 w-20 object-cover"
                            >
                        </div>
                        <input 
                            type="file" 
                            name="speakers[${speakerCounter}][image]" 
                            accept="image/*" 
                            class="hidden speaker-image-input" 
                            data-preview-target="speaker-preview-${speakerCounter}"
                        >
                        <p class="text-gray-400 text-xs">Upload speaker photo</p>
                    </label>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newSpeaker);
        speakerCounter++;
    });

    /*******************************************
     * IMAGE PREVIEW FOR SPEAKERS
     *******************************************/
    document.addEventListener('change', function(e) {
        if (e.target.matches('.speaker-image-input')) {
            const input = e.target;
            const previewId = input.getAttribute('data-preview-target');
            const previewImg = document.getElementById(previewId);
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (evt) {
                    previewImg.src = evt.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                previewImg.src = "{{ asset('placeholder_speaker.png') }}";
            }
        }
    });
</script>
@endsection
