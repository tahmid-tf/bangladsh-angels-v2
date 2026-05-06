@extends('layouts.admin')
@section('page_title', 'Founder pitch details | Dashboard')
@section('page_content')
<div class="container w-full p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-4 bg-white shadow mb-6">
        <div>
            <h1 class="text-lg md:text-xl font-bold">Founder pitch details</h1>
            <p class="text-sm text-gray-600 mt-1">Submission #{{ $submission->id }}</p>
        </div>
        <a href="{{ route('admin.founder-pitches') }}" class="mt-3 md:mt-0 text-sm text-[#0a5554] font-semibold hover:underline">
            ← Back to submissions
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
            <div class="p-5 border-b md:border-b-0 md:border-r border-gray-100">
                <p class="text-xs uppercase tracking-wide text-gray-500">Contact email</p>
                <p class="mt-1 text-gray-900 font-medium break-all">{{ $submission->contact_email }}</p>
            </div>
            <div class="p-5 border-b border-gray-100">
                <p class="text-xs uppercase tracking-wide text-gray-500">Linked member</p>
                @if ($submission->user)
                    <a href="{{ route('member.edit', $submission->user) }}" class="mt-1 inline-flex text-[#0a5554] font-semibold hover:underline">
                        {{ $submission->user->name }} ({{ $submission->user->email }})
                    </a>
                @else
                    <p class="mt-1 text-gray-600">No linked member account</p>
                @endif
            </div>
            <div class="p-5 border-b md:border-b-0 md:border-r border-gray-100">
                <p class="text-xs uppercase tracking-wide text-gray-500">Submitted at</p>
                <p class="mt-1 text-gray-900">{{ $submission->created_at->format('M j, Y g:i A') }}</p>
            </div>
            <div class="p-5 border-b border-gray-100">
                <p class="text-xs uppercase tracking-wide text-gray-500">Last updated</p>
                <p class="mt-1 text-gray-900">{{ $submission->updated_at->format('M j, Y g:i A') }}</p>
            </div>
        </div>

        <div class="p-5 border-b border-gray-100">
            <p class="text-xs uppercase tracking-wide text-gray-500">One-line pitch</p>
            <p class="mt-2 text-gray-900 whitespace-pre-wrap leading-relaxed">{{ $submission->one_line }}</p>
        </div>

        <div class="p-5">
            <p class="text-xs uppercase tracking-wide text-gray-500">Pitch deck</p>
            @php($deck = $submission->getFirstMedia(\App\Models\FounderPitchSubmission::MEDIA_PITCH_DECK))
            @if ($deck)
                <div class="mt-2 flex flex-col md:flex-row md:items-center gap-3">
                    <span class="text-sm text-gray-700">
                        {{ $deck->file_name }}
                        @if ($deck->size)
                            ({{ number_format($deck->size / 1024, 1) }} KB)
                        @endif
                    </span>
                    <a href="{{ route('admin.founder-pitches.deck', $submission) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-green-600 text-white text-xs font-semibold hover:bg-green-700 w-fit">
                        Download PDF
                    </a>
                </div>
            @else
                <p class="mt-2 text-amber-600 text-sm">Pitch deck file is missing.</p>
            @endif
        </div>
    </div>
</div>
@endsection
