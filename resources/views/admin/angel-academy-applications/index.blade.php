@extends('layouts.admin')
@section('page_title', 'Angel Academy applications | Dashboard')
@section('page_content')
<div class="container w-full p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-4 bg-white shadow mb-6">
        <div>
            <h1 class="text-lg md:text-xl font-bold">Angel Academy — Apply to the Network</h1>
            <p class="text-sm text-gray-600 mt-1">Submissions from the public fellowship application form.</p>
        </div>
        <a href="{{ route('angel-academy.apply') }}" target="_blank" rel="noopener noreferrer" class="mt-3 md:mt-0 text-sm text-[#0a5554] font-semibold hover:underline">
            View form on site →
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if ($applications->isEmpty())
            <p class="p-8 text-center text-gray-600">No applications yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 font-semibold text-gray-700">Submitted</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Name</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Email</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">WhatsApp</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Member</th>
                            <th class="px-4 py-3 font-semibold text-gray-700">Details</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($applications as $row)
                            <tr class="hover:bg-gray-50/80">
                                <td class="px-4 py-3 whitespace-nowrap text-gray-600">{{ $row->created_at->format('M j, Y g:i A') }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $row->name }}</td>
                                <td class="px-4 py-3 text-gray-800 break-all">{{ $row->email }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $row->contact_number }}</td>
                                <td class="px-4 py-3 text-gray-600">
                                    @if ($row->user)
                                        <a href="{{ route('member.edit', $row->user) }}" class="text-[#0a5554] hover:underline">{{ $row->user->name }}</a>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.angel-academy-applications.show', $row) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-[#0a5554] text-white text-xs font-semibold hover:bg-[#084646]">
                                        View details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 border-t border-gray-100 bg-gray-50">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
