@extends('layouts.admin')
@section('page_title','Add a new member | Bangladesh Angels Network')
@section('page_content')
<section class="container mx-auto px-6 py-12 bg-white rounded-lg shadow-lg mt-8">
    <header class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold">Add New Deal</h1>
            <p class="text-gray-500">Dashboard &gt; Deals &gt; Add new deal</p>
        </div>
        <div class="flex space-x-4">
            <button type="submit" form="deal-form" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">Add new deal</button>
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

    <form id="deal-form" action="{{ route('deal.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Deal Information -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Upload Logo -->
            <div class="text-center border-dashed border-2 border-gray-300 rounded-lg p-6">
                <label class="block cursor-pointer">
                    <div class="mb-4">
                        <img 
                            id="logo-preview" 
                            src="{{ asset('upload_dealcover.png') }}" 
                            alt="Upload Placeholder" 
                            class="mx-auto rounded-full h-24 w-24 object-cover"
                        >
                    </div>
                    <input type="file" name="logo" accept="image/*" class="hidden" id="logo-input">
                    <p class="text-gray-500 text-sm">Upload logo</p>
                    <p class="text-gray-400 text-xs">Allowed: *.jpeg, *.png, *.gif (Max: 3.1 MB)</p>
                </label>
            </div>

            <script>
                // Preview Logo
                const logoInput = document.getElementById('logo-input');
                const logoPreview = document.getElementById('logo-preview');

                logoInput.addEventListener('change', function () {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            logoPreview.src = e.target.result; // Set preview image source
                            logoPreview.style.display = 'block'; // Ensure the preview is visible
                        };
                        reader.readAsDataURL(file);
                    } else {
                        // Reset to default placeholder if no file is selected
                        logoPreview.src = "{{ asset('upload_dealcover.png') }}";
                    }
                });
            </script>

            <style>
                /* Ensure the preview looks good */
                #logo-preview {
                    object-fit: cover; /* Ensures image fills the rounded area proportionally */
                    border: 2px solid #e2e8f0; /* Add a light border for better visibility */
                    padding: 0.25rem; /* Add space around the image */
                    background-color: #f9fafb; /* Matches the field background color */
                }
            </style>


            <!-- Input Fields -->
            <div class="md:col-span-2 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="title" class="block text-gray-700 font-semibold mb-2">Title *</label>
                        <input type="text" id="title" name="title" placeholder="Enter Deal Title" class="input-field" value="{{ old('title') }}" required>
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <select name="type"  id="type" class="input-field" required>
                        <option value="">Deal Type</option>
                        <option value="commit">Commit</option>
                        <option value="invest">Invest</option>
                        <option value="review">Review</option>
                        <option value="portfolio">Portfolio</option>
                    </select>
                    <select name="status" id="status" class="input-field" required>
                        <option value="">Deal Status</option>
                        <option value="active">Active</option>
                        <option value="draft">Draft</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="sector" class="block text-gray-700 font-semibold mb-2">Sector *</label>
                        <input type="text" id="sector" name="sector" placeholder="Sector" class="input-field" value="{{ old('sector') }}" required>
                        @error('sector')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="investment_stage" class="block text-gray-700 font-semibold mb-2">Investment Stage *</label>
                        <select id="investment_stage" name="investment_stage" class="input-field" required>
                            <option value="">Investment Stage</option>
                            <option value="Pre Seed" {{ old('investment_stage') == 'Pre Seed' ? 'selected' : '' }}>Pre Seed</option>
                            <option value="Seed" {{ old('investment_stage') == 'Seed' ? 'selected' : '' }}>Seed</option>
                            <option value="Series A" {{ old('investment_stage') == 'Series A' ? 'selected' : '' }}>Series A</option>
                            <option value="Series B" {{ old('investment_stage') == 'Series B' ? 'selected' : '' }}>Series B</option>
                            <option value="Series C" {{ old('investment_stage') == 'Series C' ? 'selected' : '' }}>Series C</option>
                            <option value="Series D" {{ old('investment_stage') == 'Series D' ? 'selected' : '' }}>Series D</option>
                        </select>
                        
                        @error('investment_stage')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="amount_seeking" class="block text-gray-700 font-semibold mb-2">Amount Seeking *</label>
                    <input type="number" id="amount_seeking" name="amount_seeking" placeholder="Amount Seeking" class="input-field" value="{{ old('amount_seeking') }}" required>
                    @error('amount_seeking')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="description" class="block text-gray-700 font-semibold mb-2">Description *</label>
                    <textarea id="description" name="description" placeholder="Description" rows="4" class="input-field" required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>

        <!-- Company Cover -->
        <div class="border-dashed border-2 border-gray-300 rounded-lg p-6">
            <label class="block cursor-pointer text-center">
                <div class="mb-4">
                    <img 
                        id="company-cover-preview" 
                        src="{{ asset('upload_dealcover.png') }}" 
                        alt="Upload Placeholder" 
                        class="mx-auto rounded-lg h-40 w-full object-cover"
                        style="display: block;"
                    >
                </div>
                <input type="file" name="company_cover" accept="image/*" class="hidden" id="company-cover-input">
                <p class="text-gray-500 text-sm">Attach Files</p>
                <p class="text-gray-400 text-xs">Drop files here or click <span class="text-blue-500 underline">browse</span> through your machine</p>
            </label>
        </div>

        <script>
            // Preview Company Cover
            const companyCoverInput = document.getElementById('company-cover-input');
            const companyCoverPreview = document.getElementById('company-cover-preview');
            
            companyCoverInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        companyCoverPreview.src = e.target.result;
                        companyCoverPreview.style.display = 'block'; // Ensure image is displayed
                    };
                    reader.readAsDataURL(file);
                } else {
                    // Reset to the default placeholder if no file is selected
                    companyCoverPreview.src = "{{ asset('upload_dealcover.png') }}";
                }
            });
        </script>

        <style>
            /* Add specific styling to ensure the preview looks good */
            #company-cover-preview {
                object-fit: cover; /* Ensures the image fills the area proportionally */
                border: 1px solid #e2e8f0; /* Adds a slight border for better visuals */
                padding: 0.25rem; /* Space around the image */
                background-color: #f9fafb; /* Background to match input fields */
            }
        </style>
        <div>
            <label for="pitch_deck_url" class="block text-gray-700 font-semibold mb-2">Pitch Deck URL </label>
            <input type="text" id="pitch_deck_url" name="pitch_deck_url" placeholder="Enter link here" class="input-field" value="{{ old('pitch_deck_url') }}">
            @error('pitch_deck_url')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="substack_link" class="block text-gray-700 font-semibold mb-2">Substack Link</label>
            <input type="text" id="substack_link" name="substack_link" placeholder="Enter link here" class="input-field" value="{{ old('substack_link') }}">
            @error('substack_link')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="action_link" class="block text-gray-700 font-semibold mb-2">Action Link</label>
            <input type="text" id="action_link" name="action_link" placeholder="Enter link here" class="input-field" value="{{ old('action_link') }}">
            @error('action_link')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <!-- Key Metrics Section -->
        <div id="key-metrics-section">
            <h2 class="text-lg font-bold mb-4">Key Metrics</h2>
                <div id="key-metrics-container" class="space-y-4">
                    @if(is_array(old('key_metrics')))
                        @foreach(old('key_metrics') as $index => $metric)
                            <div class="grid grid-cols-2 gap-4">
                                <input 
                                    type="text" 
                                    name="key_metrics[{{ $index }}][name]" 
                                    placeholder="Metric Name" 
                                    class="input-field" 
                                    value="{{ $metric['name'] ?? '' }}" 
                                    
                                >
                                <input 
                                    type="text" 
                                    name="key_metrics[{{ $index }}][value]" 
                                    placeholder="Metric Value" 
                                    class="input-field" 
                                    value="{{ $metric['value'] ?? '' }}" 
                                    
                                >
                            </div>
        </div>
            @endforeach
        @else
            <!-- Default empty field -->
            <div class="grid grid-cols-2 gap-4">
                <input 
                    type="text" 
                    name="key_metrics[0][name]" 
                    placeholder="Metric Name" 
                    class="input-field" 
                    required
                >
                <input 
                    type="text" 
                    name="key_metrics[0][value]" 
                    placeholder="Metric Value" 
                    class="input-field" 
                    required
                >
            </div>
        @endif
    </div>

    <button 
        type="button" 
        id="add-key-metric-btn" 
        class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg mt-4">
        + Add Key Metric
    </button>
</div>

<script>
    // Initialize a counter for unique key metric IDs
    let metricCounter = document.querySelectorAll('#key-metrics-container .grid').length;

    // Add another key metric dynamically
    document.getElementById('add-key-metric-btn').addEventListener('click', function () {
        const container = document.getElementById('key-metrics-container');
        const newField = `
            <div class="grid grid-cols-2 gap-4">
                <input 
                    type="text" 
                    name="key_metrics[${metricCounter}][name]" 
                    placeholder="Metric Name" 
                    class="input-field" 
                    required
                >
                <input 
                    type="text" 
                    name="key_metrics[${metricCounter}][value]" 
                    placeholder="Metric Value" 
                    class="input-field" 
                    required
                >
            </div>`;
        container.insertAdjacentHTML('beforeend', newField);
        metricCounter++;
    });
</script>


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


@endsection