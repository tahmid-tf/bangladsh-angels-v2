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
            <button type="button" class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg shadow">Save as draft</button>
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
                        <img src="{{ asset('upload_dealcover.png') }}" alt="Upload Placeholder" class="mx-auto rounded-full h-24 w-24">
                    </div>
                    <input type="file" name="logo" accept="image/*" class="hidden">
                    <p class="text-gray-500 text-sm">Upload logo</p>
                    <p class="text-gray-400 text-xs">Allowed: *.jpeg, *.png, *.gif (Max: 3.1 MB)</p>
                </label>
            </div>

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
                    <div>
                        <label for="company_name" class="block text-gray-700 font-semibold mb-2">Company Name *</label>
                        <input type="text" id="company_name" name="company_name" placeholder="Company Name" class="input-field" value="{{ old('company_name') }}" required>
                        @error('company_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="type">Deal Type *</label>
                    <select name="type" id="type" class="input-field" required>
                        <option value="">Select Type</option>
                        <option value="commit">Commit</option>
                        <option value="invest">Invest</option>
                        <option value="review">Review</option>
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
                            <option value="Growth" {{ old('investment_stage') == 'Growth' ? 'selected' : '' }}>Growth</option>
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
                    <img src="{{ asset('upload_dealcover.png') }}" alt="Upload Placeholder" class="mx-auto rounded-lg">
                </div>
                <input type="file" name="company_cover" accept="image/*" class="hidden">
                <p class="text-gray-500 text-sm">Attach Files</p>
                <p class="text-gray-400 text-xs">Drop files here or click <span class="text-blue-500 underline">browse</span> through your machine</p>
            </label>
        </div>

        <!-- Key Metrics -->
        <div>
            <h2 class="text-lg font-bold mb-4">Key Metrics</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @php
                    $metrics = ['growth_traction', 'impact_metrics', 'future_plans', 'partnerships', 'revenue_highlights', 'market_opportunity'];
                @endphp
                @foreach ($metrics as $metric)
                    <div>
                        <label for="{{ $metric }}" class="block text-gray-700 font-semibold mb-2">{{ ucfirst(str_replace('_', ' ', $metric)) }}</label>
                        <input type="text" id="{{ $metric }}" name="key_metrics[{{ $metric }}]" placeholder="{{ ucfirst(str_replace('_', ' ', $metric)) }}" class="input-field" value="{{ old("key_metrics.$metric") }}">
                        @error("key_metrics.$metric")
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach
            </div>
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


@endsection