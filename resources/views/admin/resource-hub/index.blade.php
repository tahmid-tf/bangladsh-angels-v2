@extends('layouts.admin')
@section('page_title', 'Resources page cards | Dashboard')
@section('page_content')
<div class="container w-full p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-4 bg-white shadow mb-6">
        <div>
            <h1 class="text-lg md:text-xl font-bold">Resources page (BAN /ban-resources)</h1>
            <p class="text-sm text-gray-600 mt-1">Edit each card’s title, one-liner, CTA button text, logo, and link.</p>
        </div>
        <a href="{{ route('resources') }}" target="_blank" rel="noopener noreferrer" class="mt-3 md:mt-0 text-sm font-semibold text-[#0a5554] hover:underline">View public page →</a>
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
                    <th class="px-4 py-3 font-semibold text-gray-700">Button</th>
                    <th class="px-4 py-3 font-semibold text-gray-700">Link</th>
                    <th class="px-4 py-3 font-semibold text-gray-700"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($cards as $card)
                    <tr class="hover:bg-gray-50/80">
                        <td class="px-4 py-3 text-gray-600">{{ $card->sort_order }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $card->title }}</td>
                        <td class="px-4 py-3 text-gray-600 max-w-[10rem] truncate" title="{{ $card->cta_label }}">{{ $card->cta_label ?: '—' }}</td>
                        <td class="px-4 py-3 text-gray-600 max-w-md truncate" title="{{ $card->link }}">{{ $card->link }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.resource-hub.edit', $card) }}" class="text-[#0a5554] font-semibold hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
