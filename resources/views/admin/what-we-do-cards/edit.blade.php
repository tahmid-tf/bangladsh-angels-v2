@extends('layouts.admin')
@section('page_title', 'Edit What We Do card | Dashboard')
@section('page_content')
<div class="container w-full p-6 max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('admin.what-we-do-cards') }}" class="text-sm font-semibold text-[#0a5554] hover:underline">← Back to cards</a>
        <h1 class="text-2xl font-bold mt-4 text-gray-900">Edit: {{ $card->title }}</h1>
        <p class="text-sm text-gray-500 mt-1">Slug: <code class="bg-gray-100 px-1 rounded text-xs">{{ $card->slug }}</code> (fixed)</p>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('admin.what-we-do-cards.update', $card) }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Badge title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $card->title) }}" required maxlength="255"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">
        </div>

        <div>
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="8" required maxlength="8000"
                      class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">{{ old('description', $card->description) }}</textarea>
        </div>

        <div>
            <label for="cta_link" class="block text-sm font-semibold text-gray-700 mb-1">CTA link (optional)</label>
            <input type="text" name="cta_link" id="cta_link" value="{{ old('cta_link', $card->cta_link) }}" maxlength="2048"
                   placeholder="https://example.com or /startups or #contact"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">
            <p class="mt-1 text-xs text-gray-500">If provided, a CTA button will appear on the landing What We Do card. Leave empty to hide the button.</p>
        </div>

        <div>
            <span class="block text-sm font-semibold text-gray-700 mb-2">Cover image</span>
            <p class="text-xs text-gray-500 mb-3">Shown in the card. JPEG, PNG, or WebP, max 5&nbsp;MB. Leave empty to keep the current image.</p>
            <div class="flex items-start gap-4 mb-3">
                <img src="{{ $card->coverImageUrl() }}" alt="Current cover" class="h-24 w-40 object-cover rounded-lg border border-gray-200" width="160" height="96" loading="lazy">
            </div>
            <input type="file" name="cover" id="cover" accept="image/jpeg,image/png,image/webp,image/gif"
                   class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-green-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-[#0a5554] hover:file:bg-green-100">
            @if ($card->getFirstMedia(\App\Models\WhatWeDoCard::MEDIA_COVER))
                <label class="mt-4 flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="remove_cover" value="1" class="rounded border-gray-300 text-green-600 focus:ring-green-600" @checked(old('remove_cover'))>
                    Remove uploaded image (fallback will apply)
                </label>
            @endif
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                Save changes
            </button>
            <a href="{{ route('admin.what-we-do-cards') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
