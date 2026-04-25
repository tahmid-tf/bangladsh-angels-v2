@extends('layouts.admin')
@section('page_title', 'Resources page (/deckvue) cards | Dashboard')
@section('page_content')
<div class="container w-full p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 p-4 bg-white shadow mb-6">
        <div>
            <h1 class="text-lg md:text-xl font-bold">Public resources page (/deckvue)</h1>
            <p class="text-sm text-gray-600 mt-1">Edits the partner cards on the public Resources page (<code class="text-xs bg-gray-100 px-1 rounded">/deckvue</code>): card title, one-line description, button text, link, and optional logo. Upload a new file to replace the logo, or use &ldquo;Remove current logo&rdquo; on edit.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.resource-hub.create') }}" class="inline-flex items-center justify-center rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700 transition">
                Add card
            </a>
            <a href="{{ route('resources') }}" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold text-[#0a5554] hover:underline">View public page →</a>
        </div>
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
                @forelse ($cards as $card)
                    <tr class="hover:bg-gray-50/80">
                        <td class="px-4 py-3 text-gray-600">{{ $card->sort_order }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $card->title }}</td>
                        <td class="px-4 py-3 text-gray-600 max-w-[10rem] truncate" title="{{ $card->cta_label }}">{{ $card->cta_label ?: '—' }}</td>
                        <td class="px-4 py-3 text-gray-600 max-w-md truncate" title="{{ $card->link }}">{{ $card->link }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <a href="{{ route('admin.resource-hub.edit', $card) }}" class="text-[#0a5554] font-semibold hover:underline">Edit</a>
                            <span class="mx-2 text-gray-300">|</span>
                            <form method="post" action="{{ route('admin.resource-hub.destroy', $card) }}" class="inline" onsubmit="return confirm('Remove this card from the public resources page?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 font-semibold hover:underline">Remove</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-gray-600">
                            No cards yet. <a href="{{ route('admin.resource-hub.create') }}" class="font-semibold text-[#0a5554] hover:underline">Add your first card</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
