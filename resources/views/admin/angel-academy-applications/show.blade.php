@extends('layouts.admin')
@section('page_title', 'Angel Academy application | Dashboard')
@section('page_content')
@php($m = \App\Models\AngelAcademyNetworkApplication::class)
<div class="container w-full p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-4 bg-white shadow mb-6">
        <div>
            <h1 class="text-lg md:text-xl font-bold">Application details</h1>
            <p class="text-sm text-gray-600 mt-1">Submission #{{ $application->id }}</p>
        </div>
        <a href="{{ route('admin.angel-academy-applications') }}" class="mt-3 md:mt-0 text-sm text-[#0a5554] font-semibold hover:underline">
            ← Back to list
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
            <div class="p-5 border-b md:border-b-0 md:border-r border-gray-100">
                <p class="text-xs uppercase tracking-wide text-gray-500">Name</p>
                <p class="mt-1 text-gray-900 font-medium">{{ $application->name }}</p>
            </div>
            <div class="p-5 border-b border-gray-100">
                <p class="text-xs uppercase tracking-wide text-gray-500">Email</p>
                <p class="mt-1 text-gray-900 font-medium break-all">{{ $application->email }}</p>
            </div>
            <div class="p-5 border-b md:border-b-0 md:border-r border-gray-100">
                <p class="text-xs uppercase tracking-wide text-gray-500">Contact (WhatsApp)</p>
                <p class="mt-1 text-gray-900">{{ $application->contact_number }}</p>
            </div>
            <div class="p-5 border-b border-gray-100">
                <p class="text-xs uppercase tracking-wide text-gray-500">LinkedIn</p>
                <p class="mt-1 text-gray-900 break-all">
                    @php($li = $application->linkedin_url)
                    @php($liHref = \Illuminate\Support\Str::startsWith($li, ['http://', 'https://']) ? $li : 'https://'.ltrim($li, '/'))
                    <a href="{{ $liHref }}" target="_blank" rel="noopener noreferrer" class="text-[#0a5554] font-semibold hover:underline">
                        {{ $application->linkedin_url }}
                    </a>
                </p>
            </div>
            <div class="p-5 border-b md:border-b-0 md:border-r border-gray-100">
                <p class="text-xs uppercase tracking-wide text-gray-500">Submitted at</p>
                <p class="mt-1 text-gray-900">{{ $application->created_at->format('M j, Y g:i A') }}</p>
            </div>
            <div class="p-5 border-b border-gray-100">
                <p class="text-xs uppercase tracking-wide text-gray-500">Linked member</p>
                @if ($application->user)
                    <a href="{{ route('member.edit', $application->user) }}" class="mt-1 inline-flex text-[#0a5554] font-semibold hover:underline">
                        {{ $application->user->name }} ({{ $application->user->email }})
                    </a>
                @else
                    <p class="mt-1 text-gray-600">No linked member account</p>
                @endif
            </div>
        </div>

        <div class="p-5 border-b border-gray-100">
            <p class="text-xs uppercase tracking-wide text-gray-500">Prior startup investments</p>
            <p class="mt-1 text-gray-900">{{ $m::INVESTED_BEFORE[$application->invested_before] ?? $application->invested_before }}</p>
        </div>

        <div class="p-5 border-b border-gray-100">
            <p class="text-xs uppercase tracking-wide text-gray-500">Primary motivation</p>
            <p class="mt-1 text-gray-900">{{ $m::PRIMARY_MOTIVATION[$application->primary_motivation] ?? $application->primary_motivation }}</p>
        </div>

        <div class="p-5 border-b border-gray-100">
            <p class="text-xs uppercase tracking-wide text-gray-500">Startup stages of interest</p>
            <ul class="mt-2 list-disc pl-5 text-gray-900 space-y-1">
                @foreach ($application->startup_stages ?? [] as $stage)
                    <li>{{ $m::STARTUP_STAGES[$stage] ?? $stage }}</li>
                @endforeach
            </ul>
        </div>

        <div class="p-5 border-b border-gray-100">
            <p class="text-xs uppercase tracking-wide text-gray-500">Sectors of interest</p>
            <ul class="mt-2 list-disc pl-5 text-gray-900 space-y-1">
                @foreach ($application->sectors ?? [] as $sector)
                    <li>{{ $m::SECTORS[$sector] ?? $sector }}</li>
                @endforeach
            </ul>
            @if (filled($application->sectors_other))
                <p class="mt-3 text-sm text-gray-700"><span class="font-semibold text-gray-800">Other (specify):</span> {{ $application->sectors_other }}</p>
            @endif
        </div>

        <div class="p-5">
            <p class="text-xs uppercase tracking-wide text-gray-500">Comfortable cheque size</p>
            <p class="mt-1 text-gray-900">{{ $m::CHEQUE_SIZE[$application->cheque_size] ?? $application->cheque_size }}</p>
        </div>
    </div>
</div>
@endsection
