@extends('layouts.admin')
@section('page_title', 'Homepage programs | Dashboard')
@section('page_content')
<div class="container w-full p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 p-4 bg-white shadow mb-6">
        <div>
            <h1 class="text-lg md:text-xl font-bold">Homepage — Programs</h1>
            <p class="text-sm text-gray-600 mt-1">Manage up to five program cards. Their sort order controls their position on the landing page.</p>
        </div>
        <div class="flex flex-wrap items-center gap-4">
            <span class="text-sm font-semibold text-gray-600">{{ $cards->count() }} / {{ \App\Models\LandingProgramCard::MAX_CARDS }} cards</span>
            @if ($cards->count() < \App\Models\LandingProgramCard::MAX_CARDS)
                <a href="{{ route('admin.landing-program-cards.create') }}" class="px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition">Add program</a>
            @else
                <span class="px-4 py-2 bg-gray-100 text-gray-500 text-sm font-semibold rounded-lg">Maximum reached</span>
            @endif
            <a href="{{ route('home') }}#programs" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold text-[#0a5554] hover:underline">View section →</a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-6 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 font-semibold text-gray-700">Order</th>
                        <th class="px-4 py-3 font-semibold text-gray-700">Program</th>
                        <th class="px-4 py-3 font-semibold text-gray-700">Appearance</th>
                        <th class="px-4 py-3 font-semibold text-gray-700">Primary action</th>
                        <th class="px-4 py-3 font-semibold text-gray-700"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($cards as $card)
                        <tr class="hover:bg-gray-50/80">
                            <td class="px-4 py-3 text-gray-600">{{ $card->sort_order }}</td>
                            <td class="px-4 py-3">
                                <strong class="block text-gray-900">{{ $card->title }}</strong>
                                <span class="text-xs text-gray-500">{{ $card->eyebrow }}</span>
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ \App\Models\LandingProgramCard::THEMES[$card->theme] ?? 'White' }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $card->primary_label }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-right">
                                <a href="{{ route('admin.landing-program-cards.edit', $card) }}" class="text-[#0a5554] font-semibold hover:underline mr-4">Edit</a>
                                <form method="post" action="{{ route('admin.landing-program-cards.destroy', $card) }}" class="inline" onsubmit="return confirm('Remove this program card from the homepage?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 font-semibold hover:underline">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-gray-600">No program cards yet. Add one to populate the homepage section.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
