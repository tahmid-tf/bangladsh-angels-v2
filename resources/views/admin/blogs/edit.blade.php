@extends('layouts.admin')
@section('page_title', 'Edit blog post | Dashboard')
@section('page_content')
<div class="container w-full max-w-5xl p-6">
    <a href="{{ route('admin.blogs.show', $blog) }}" class="text-sm font-semibold text-[#0a5554] hover:underline">← Back to article</a>
    <div class="mt-4 mb-6"><p class="text-xs font-bold uppercase tracking-widest text-green-700">Edit article</p><h1 class="text-2xl font-bold text-gray-950 mt-1">{{ $blog->title }}</h1><p class="text-sm text-gray-600 mt-1">Update the writing, author details, URL, or visibility.</p></div>

    @if($errors->any())<div class="mb-6 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-red-800"><p class="font-semibold">Please correct the highlighted fields.</p></div>@endif

    <form method="post" action="{{ route('admin.blogs.update', $blog) }}" class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm space-y-7">
        @csrf @method('PUT')
        @include('admin.blogs.form-fields', ['blog' => $blog])
        <div class="flex flex-wrap gap-3 border-t border-gray-100 pt-6">
            <button type="submit" class="rounded-lg bg-green-600 px-6 py-2.5 font-semibold text-white hover:bg-green-700">Save changes</button>
            <a href="{{ route('admin.blogs.show', $blog) }}" class="rounded-lg border border-gray-300 px-6 py-2.5 font-semibold text-gray-700 hover:bg-gray-50">Cancel</a>
        </div>
    </form>
</div>
@endsection
