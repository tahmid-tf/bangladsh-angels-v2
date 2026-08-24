@extends('layouts.admin')
@section('page_title', 'Homepage statistics | Dashboard')
@section('page_content')
<div class="container w-full p-6 max-w-5xl">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 p-4 bg-white shadow mb-6">
        <div>
            <h1 class="text-lg md:text-xl font-bold">Homepage — Statistics</h1>
            <p class="text-sm text-gray-600 mt-1">Update the three figures shown below the main landing-page introduction.</p>
        </div>
        <a href="{{ route('home') }}#join" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold text-[#0a5554] hover:underline">View section on site →</a>
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

    <form method="post" action="{{ route('admin.landing-page-stats.update') }}" class="bg-white rounded-lg shadow p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            @foreach ($stats as $stat)
                <fieldset class="rounded-lg border border-gray-200 p-4">
                    <legend class="px-2 text-sm font-bold text-gray-700">Statistic {{ $loop->iteration }}</legend>

                    <div class="mb-4">
                        <label for="stat-value-{{ $stat->id }}" class="block text-sm font-semibold text-gray-700 mb-1">Figure</label>
                        <input type="text" name="stats[{{ $stat->id }}][value]" id="stat-value-{{ $stat->id }}"
                               value="{{ old('stats.'.$stat->id.'.value', $stat->value) }}" required maxlength="40"
                               placeholder="500+"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">
                    </div>

                    <div>
                        <label for="stat-label-{{ $stat->id }}" class="block text-sm font-semibold text-gray-700 mb-1">Label</label>
                        <textarea name="stats[{{ $stat->id }}][label]" id="stat-label-{{ $stat->id }}" rows="3" required maxlength="120"
                                  class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-green-600 focus:ring-1 focus:ring-green-600">{{ old('stats.'.$stat->id.'.label', $stat->label) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Add a line break where you want the label to wrap.</p>
                    </div>
                </fieldset>
            @endforeach
        </div>

        <div class="mt-6">
            <button type="submit" class="px-6 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                Save changes
            </button>
        </div>
    </form>
</div>
@endsection
