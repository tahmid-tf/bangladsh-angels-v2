@extends('layouts.admin')
@section('page_title', 'Founder pitches | Dashboard')
@section('page_content')
<div class="container w-full p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-4 bg-white shadow mb-6">
        <div>
            <h1 class="text-lg md:text-xl font-bold">Founder pitch submissions</h1>
            <p class="text-sm text-gray-600 mt-1">One-line descriptions and pitch decks from the public Startups page.</p>
        </div>
        <a href="{{ route('startups').'#send-pitch' }}" target="_blank" rel="noopener noreferrer" class="mt-3 md:mt-0 text-sm text-[#0a5554] font-semibold hover:underline">
            View form on site →
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if ($submissions->isEmpty())
            <p class="p-8 text-center text-gray-600">No submissions yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 font-semibold text-gray-700">Submitted</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Email</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">One-line</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Member</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Details</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Deck</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($submissions as $row)
                            <tr class="hover:bg-gray-50/80">
                                <td class="px-4 py-3 whitespace-nowrap text-gray-600">{{ $row->created_at->format('M j, Y g:i A') }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $row->contact_email }}</td>
                                <td class="px-4 py-3 text-gray-800 max-w-xs truncate" title="{{ $row->one_line }}">{{ $row->one_line }}</td>
                                <td class="px-4 py-3 text-gray-600">
                                    @if ($row->user)
                                        <a href="{{ route('member.edit', $row->user) }}" class="text-[#0a5554] hover:underline">{{ $row->user->name }}</a>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.founder-pitches.show', $row) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-[#0a5554] text-white text-xs font-semibold hover:bg-[#084646]">
                                        View details
                                    </a>
                                </td>
                                <td class="px-4 py-3">
                                    @if ($row->getFirstMedia(\App\Models\FounderPitchSubmission::MEDIA_PITCH_DECK))
                                        <a href="{{ route('admin.founder-pitches.deck', $row) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-green-600 text-white text-xs font-semibold hover:bg-green-700">
                                            Download PDF
                                        </a>
                                    @else
                                        <span class="text-amber-600 text-xs">Missing file</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 border-t border-gray-100 bg-gray-50">
                {{ $submissions->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
