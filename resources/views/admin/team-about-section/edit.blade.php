@extends('layouts.admin')
@section('page_title', 'Team About section | Dashboard')
@section('page_content')
<div class="container w-full p-6 max-w-4xl">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 p-4 bg-white shadow mb-6 rounded-lg">
        <div>
            <h1 class="text-lg md:text-xl font-bold">Team page — About section</h1>
            <p class="text-sm text-gray-600 mt-1">Update the About content and image shown near the bottom of the public team page.</p>
        </div>
        <a href="{{ route('team') }}#about-us" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold text-[#0a5554] hover:underline">View section →</a>
    </div>

    @if (session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('admin.team-about-section.update') }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="kicker" class="block text-sm font-semibold text-gray-700 mb-1">Section label</label>
            <input type="text" name="kicker" id="kicker" value="{{ old('kicker', $section->kicker) }}" required maxlength="160"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">
        </div>

        <div>
            <label for="heading" class="block text-sm font-semibold text-gray-700 mb-1">Heading</label>
            <input type="text" name="heading" id="heading" value="{{ old('heading', $section->heading) }}" required maxlength="255"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">
        </div>

        <div>
            <label for="body_text" class="block text-sm font-semibold text-gray-700 mb-1">Body content</label>
            <textarea name="body_text" id="body_text" rows="12" required maxlength="12000"
                      class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">{{ old('body_text', implode("\n\n", $section->paragraphs())) }}</textarea>
            <p class="mt-1 text-xs text-gray-500">Separate paragraphs with a blank line.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="image_alt" class="block text-sm font-semibold text-gray-700 mb-1">Image description</label>
                <input type="text" name="image_alt" id="image_alt" value="{{ old('image_alt', $section->image_alt) }}" required maxlength="255"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">
                <p class="mt-1 text-xs text-gray-500">Used by screen readers and when the image cannot load.</p>
            </div>
            <div>
                <label for="image_badge" class="block text-sm font-semibold text-gray-700 mb-1">Image badge text</label>
                <input type="text" name="image_badge" id="image_badge" value="{{ old('image_badge', $section->image_badge) }}" required maxlength="160"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">
            </div>
        </div>

        <div>
            <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Section image</label>
            <img src="{{ $section->imageUrl() }}" alt="" class="w-full max-w-md aspect-[3/2] object-cover rounded-lg border border-gray-200 mb-4">
            <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp,image/gif"
                   class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-green-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-[#0a5554] hover:file:bg-green-100">
            <p class="mt-1 text-xs text-gray-500">JPEG, PNG, WebP, or GIF, maximum 8&nbsp;MB. Leave empty to keep the current image.</p>
            @if ($section->getFirstMedia(\App\Models\TeamAboutSection::MEDIA_IMAGE))
                <label class="mt-3 flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300 text-green-600 focus:ring-green-600" @checked(old('remove_image'))>
                    Remove uploaded image and restore the original photo
                </label>
            @endif
        </div>

        <div>
            <button type="submit" class="px-6 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">Save changes</button>
        </div>
    </form>
</div>
@endsection
