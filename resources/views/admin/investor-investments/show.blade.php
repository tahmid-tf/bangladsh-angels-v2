@extends('layouts.admin')

@section('page_title', 'Investment Details')

@section('page_content')
<section class="container mx-auto p-4 md:p-6 max-w-5xl">
    @if (session('success'))
        <div role="status" class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-5">{{ session('success') }}</div>
    @endif

    <header class="bg-white rounded-xl shadow p-4 md:p-5 mb-5 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <a href="{{ route('admin.investor-investments.index') }}" class="text-sm font-semibold text-[#0a5554] hover:underline">← Investors investments</a>
            <h1 class="mt-3 text-lg md:text-xl font-bold text-gray-900">Investment details</h1>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.investor-investments.edit', $investorInvestment) }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-[#0a5554] text-white text-sm font-semibold hover:bg-[#084646]">Edit record</a>
            <form method="POST" action="{{ route('admin.investor-investments.destroy', $investorInvestment) }}" onsubmit="return confirm('Delete this investment record? This action cannot be undone.')">
                @csrf @method('DELETE')
                <button class="inline-flex items-center px-4 py-2 rounded-lg border border-red-200 bg-red-50 text-red-600 text-sm font-semibold hover:bg-red-100">Delete</button>
            </form>
        </div>
    </header>

    <article class="overflow-hidden bg-white rounded-xl shadow">
        <div class="bg-[#0a5554] p-5 md:p-6 text-white">
            <p class="text-xs font-semibold uppercase tracking-wide text-green-100">Completed investment</p>
            <p class="mt-2 text-3xl font-bold">{{ $investorInvestment->formattedAmount() }}</p>
            <p class="mt-1 text-sm text-green-100">Completed {{ $investorInvestment->completed_at->format('d F Y') }}</p>
        </div>
        <dl class="grid gap-px bg-gray-200 sm:grid-cols-2">
            <div class="bg-white p-5">
                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Investor</dt>
                <dd class="mt-2 font-bold text-gray-900">{{ $investorInvestment->investor_name }}</dd>
                <dd class="mt-1 text-sm text-gray-600">{{ $investorInvestment->investor_email }}</dd>
            </div>
            <div class="bg-white p-5">
                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Startup</dt>
                <dd class="mt-2 font-bold text-gray-900">{{ $investorInvestment->startup_name }}</dd>
            </div>
            <div class="bg-white p-5">
                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Recorded by</dt>
                <dd class="mt-2 text-sm font-semibold text-gray-700">{{ $investorInvestment->creator?->name ?? 'Former administrator' }}</dd>
                <dd class="mt-1 text-xs text-gray-500">{{ $investorInvestment->created_at->format('d M Y, g:i A') }}</dd>
            </div>
            <div class="bg-white p-5">
                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Last updated</dt>
                <dd class="mt-2 text-sm font-semibold text-gray-700">{{ $investorInvestment->updater?->name ?? 'Former administrator' }}</dd>
                <dd class="mt-1 text-xs text-gray-500">{{ $investorInvestment->updated_at->format('d M Y, g:i A') }}</dd>
            </div>
        </dl>
    </article>
</section>
@endsection
