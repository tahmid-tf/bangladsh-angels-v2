@extends('layouts.admin')
@section('page_title', 'Edit resource card | Dashboard')
@section('page_content')
<div class="container w-full p-6 max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('admin.resource-hub') }}" class="text-sm font-semibold text-[#0a5554] hover:underline">← Back to cards</a>
        <h1 class="text-2xl font-bold mt-4 text-gray-900">Edit: {{ $card->title }}</h1>
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

    <form method="post" action="{{ route('admin.resource-hub.update', $card) }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $card->title) }}" required maxlength="255"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
        </div>

        <div>
            <label for="one_liner" class="block text-sm font-semibold text-gray-700 mb-1">One-liner</label>
            <textarea name="one_liner" id="one_liner" rows="4" required maxlength="2000"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">{{ old('one_liner', $card->one_liner) }}</textarea>
        </div>

        <div>
            <label for="link" class="block text-sm font-semibold text-gray-700 mb-1">Link</label>
            <input type="text" name="link" id="link" value="{{ old('link', $card->link) }}" required maxlength="2048"
                placeholder="https://… or mailto:hello@example.com"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
            <p class="mt-1 text-xs text-gray-500">Use a full URL (https://…) or a mailto: link.</p>
        </div>

        <div>
            <label for="cta_label" class="block text-sm font-semibold text-gray-700 mb-1">Button text (CTA)</label>
            <input type="text" name="cta_label" id="cta_label" value="{{ old('cta_label', $card->cta_label ?? 'Learn more') }}" required maxlength="120"
                placeholder="e.g. Book a call with us"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
        </div>

        <div>
            <label for="logo" class="block text-sm font-semibold text-gray-700 mb-1">Logo</label>
            @if ($card->logoUrl())
                <p class="text-sm text-gray-600 mb-2">Current:</p>
                <img src="{{ $card->logoUrl() }}" alt="" class="h-20 w-20 rounded-full object-cover border border-gray-200 mb-3">
            @endif
            <input type="file" name="logo" id="logo" accept="image/*"
                class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-green-50 file:px-4 file:py-2 file:font-semibold file:text-[#0a5554]">
            <p class="mt-1 text-xs text-gray-500">Optional. Square images work best. Max 4&nbsp;MB.</p>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                Save changes
            </button>
            <a href="{{ route('admin.resource-hub') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
