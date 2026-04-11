@extends('layouts.admin')
@section('page_title', 'Add resource card | Dashboard')
@section('page_content')
<div class="container w-full p-6 max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('admin.resource-hub') }}" class="text-sm font-semibold text-[#0a5554] hover:underline">← Back to cards</a>
        <h1 class="text-2xl font-bold mt-4 text-gray-900">Add resource card</h1>
        <p class="text-sm text-gray-600 mt-2">New cards appear at the end of the list on the public resources page.</p>
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

    <form method="post" action="{{ route('admin.resource-hub.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 space-y-6">
        @csrf
        @include('admin.resource-hub.form-fields', ['card' => null])

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                Add card
            </button>
            <a href="{{ route('admin.resource-hub') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
