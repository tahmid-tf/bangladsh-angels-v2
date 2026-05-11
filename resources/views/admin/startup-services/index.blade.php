@extends('layouts.admin')
@section('page_title', 'Startups — Our services | Dashboard')
@section('page_content')
<div class="container w-full p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 p-4 bg-white shadow mb-6">
        <div>
            <h1 class="text-lg md:text-xl font-bold">Startups page — Our services</h1>
            <p class="text-sm text-gray-600 mt-1">Manage service cards on the public <code class="text-xs bg-gray-100 px-1 rounded">/startups</code> page (title, intro, bullets, CTA, logo, optional brochure URL or PDF upload).</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.startup-services.create') }}" class="inline-flex items-center justify-center rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700 transition">
                Add service
            </a>
            <a href="{{ route('startups') }}#our-services" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold text-[#0a5554] hover:underline">View public section →</a>
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
                    <th class="px-4 py-3 font-semibold text-gray-700">Logo</th>
                    <th class="px-4 py-3 font-semibold text-gray-700">Title</th>
                    <th class="px-4 py-3 font-semibold text-gray-700">CTA</th>
                    <th class="px-4 py-3 font-semibold text-gray-700"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($services as $svc)
                    <tr class="hover:bg-gray-50/80">
                        <td class="px-4 py-3 text-gray-600">{{ $svc->sort_order }}</td>
                        <td class="px-4 py-3">
                            @if ($svc->logoUrl())
                                <img src="{{ $svc->logoUrl() }}" alt="" class="h-10 w-10 rounded-full object-cover border border-gray-200">
                            @else
                                <span class="text-gray-400 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $svc->title }}</td>
                        <td class="px-4 py-3 text-gray-600 max-w-[10rem] truncate" title="{{ $svc->cta_label }}">{{ $svc->cta_label }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <a href="{{ route('admin.startup-services.edit', $svc) }}" class="text-[#0a5554] font-semibold hover:underline">Edit</a>
                            <span class="mx-2 text-gray-300">|</span>
                            <form method="post" action="{{ route('admin.startup-services.destroy', $svc) }}" class="inline" onsubmit="return confirm('Remove this service from the Startups page?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 font-semibold hover:underline">Remove</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-gray-600">
                            No services yet. <a href="{{ route('admin.startup-services.create') }}" class="font-semibold text-[#0a5554] hover:underline">Add your first service</a>
                            or run <code class="text-xs bg-gray-100 px-1 rounded">php artisan db:seed --class=StartupServiceSeeder</code> for defaults.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
