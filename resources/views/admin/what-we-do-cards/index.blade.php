@extends('layouts.admin')
@section('page_title', 'What We Do cards | Dashboard')
@section('page_content')
<div class="container w-full p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 p-4 bg-white shadow mb-6">
        <div>
            <h1 class="text-lg md:text-xl font-bold">Homepage — What We Do</h1>
            <p class="text-sm text-gray-600 mt-1">Edit each card’s title, description, and cover image. If no image is uploaded, a placeholder is shown (BWIN uses <code class="text-xs bg-gray-100 px-1 rounded">bwin.png</code> when present).</p>
        </div>
        <a href="{{ route('home') }}#what-we-do" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold text-[#0a5554] hover:underline">View section on site →</a>
    </div>

    @if (session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 font-semibold text-gray-700">Order</th>
                    <th class="px-4 py-3 font-semibold text-gray-700">Title</th>
                    <th class="px-4 py-3 font-semibold text-gray-700">Cover</th>
                    <th class="px-4 py-3 font-semibold text-gray-700"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($cards as $card)
                    <tr class="hover:bg-gray-50/80">
                        <td class="px-4 py-3 text-gray-600">{{ $card->sort_order }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $card->title }}</td>
                        <td class="px-4 py-3">
                            <img src="{{ $card->coverImageUrl() }}" alt="" class="h-12 w-20 object-cover rounded border border-gray-200" width="80" height="48" loading="lazy">
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <a href="{{ route('admin.what-we-do-cards.edit', $card) }}" class="text-[#0a5554] font-semibold hover:underline">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-10 text-center text-gray-600">
                            No cards found. Run <code class="text-xs bg-gray-100 px-1 rounded">php artisan db:seed --class=WhatWeDoCardSeeder</code>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
