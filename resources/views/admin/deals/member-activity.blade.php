@extends('layouts.admin')
@section('page_title', $deal->title.' — Member activity | Dashboard')

@section('page_content')
<section class="container mx-auto p-4 md:p-6 max-w-6xl">
    <div class="bg-white rounded-xl shadow p-4 md:p-5 mb-5">
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
            <div class="flex gap-4 min-w-0">
                <img src="{{ $deal->getLogoUrl() }}" alt="" class="w-14 h-14 rounded-full object-cover shrink-0 ring-2 ring-gray-100">
                <div class="min-w-0">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Admin only</p>
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900 mt-1">{{ $deal->title }}</h1>
                    <p class="text-sm text-gray-600 mt-1">{{ $deal->sector ?: 'Sector not set' }} · Deal type: <span class="font-medium text-gray-800">{{ $deal->type }}</span> · Status: <span class="font-medium text-gray-800">{{ $deal->status }}</span></p>
                </div>
            </div>
            <div class="flex flex-wrap gap-2 shrink-0">
                <a href="{{ route('deal.view', $deal) }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-[#0a5554] text-white text-sm font-semibold hover:bg-[#084646]">
                    Public page
                </a>
                <a href="{{ route('edit.deal', $deal->id) }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-100 text-gray-800 text-sm font-semibold hover:bg-gray-200">
                    Edit deal
                </a>
                <a href="{{ route('admin.investments') }}" class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-200 text-gray-700 text-sm font-semibold hover:bg-gray-50">
                    ← Investments index
                </a>
            </div>
        </div>

        <dl class="mt-6 grid grid-cols-2 sm:grid-cols-4 gap-3 text-center">
            <div class="rounded-lg bg-emerald-50 border border-emerald-100 px-3 py-3">
                <dt class="text-xs font-semibold text-emerald-800 uppercase tracking-wide">Interested</dt>
                <dd class="text-2xl font-bold text-emerald-900 mt-1">{{ $interested->count() }}</dd>
            </div>
            <div class="rounded-lg bg-teal-50 border border-teal-100 px-3 py-3">
                <dt class="text-xs font-semibold text-teal-800 uppercase tracking-wide">Invest</dt>
                <dd class="text-2xl font-bold text-teal-900 mt-1">{{ $investRows->count() }}</dd>
            </div>
            <div class="rounded-lg bg-violet-50 border border-violet-100 px-3 py-3">
                <dt class="text-xs font-semibold text-violet-800 uppercase tracking-wide">Review / WhatsApp</dt>
                <dd class="text-2xl font-bold text-violet-900 mt-1">{{ $reviewRows->count() }}</dd>
            </div>
            <div class="rounded-lg bg-amber-50 border border-amber-100 px-3 py-3">
                <dt class="text-xs font-semibold text-amber-800 uppercase tracking-wide">Committed</dt>
                <dd class="text-2xl font-bold text-amber-900 mt-1">{{ $deal->commits->count() }}</dd>
            </div>
        </dl>
    </div>

    <div class="space-y-8">
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Interested <span class="text-gray-500 font-normal normal-case">(express interest)</span></h2>
                <span class="text-xs font-semibold text-gray-500">{{ $interested->count() }} {{ \Illuminate\Support\Str::plural('member', $interested->count()) }}</span>
            </div>
            @if ($interested->isEmpty())
                <p class="px-4 py-8 text-center text-sm text-gray-500">No interested members yet.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-50 text-xs font-semibold text-gray-600 uppercase border-b border-gray-100">
                            <tr>
                                <th class="px-4 py-2">Member</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2 whitespace-nowrap">Recorded</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($interested as $row)
                                <tr class="hover:bg-gray-50/80">
                                    <td class="px-4 py-2 font-medium text-gray-900">{{ $row->user?->name ?? '—' }}</td>
                                    <td class="px-4 py-2 text-gray-600 break-all">{{ $row->user?->email ?? '—' }}</td>
                                    <td class="px-4 py-2 text-gray-600 whitespace-nowrap">{{ $row->created_at?->format('M j, Y g:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Invest <span class="text-gray-500 font-normal normal-case">(investment record)</span></h2>
                <span class="text-xs font-semibold text-gray-500">{{ $investRows->count() }} {{ \Illuminate\Support\Str::plural('member', $investRows->count()) }}</span>
            </div>
            @if ($investRows->isEmpty())
                <p class="px-4 py-8 text-center text-sm text-gray-500">No invest-type investment rows for this deal.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-50 text-xs font-semibold text-gray-600 uppercase border-b border-gray-100">
                            <tr>
                                <th class="px-4 py-2">Member</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2 whitespace-nowrap">Recorded</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($investRows as $row)
                                <tr class="hover:bg-gray-50/80">
                                    <td class="px-4 py-2 font-medium text-gray-900">{{ $row->user?->name ?? '—' }}</td>
                                    <td class="px-4 py-2 text-gray-600 break-all">{{ $row->user?->email ?? '—' }}</td>
                                    <td class="px-4 py-2 text-gray-600 whitespace-nowrap">{{ $row->created_at?->format('M j, Y g:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Review / WhatsApp signal</h2>
                <span class="text-xs font-semibold text-gray-500">{{ $reviewRows->count() }} {{ \Illuminate\Support\Str::plural('member', $reviewRows->count()) }}</span>
            </div>
            @if ($reviewRows->isEmpty())
                <p class="px-4 py-8 text-center text-sm text-gray-500">No review signals for this deal.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-50 text-xs font-semibold text-gray-600 uppercase border-b border-gray-100">
                            <tr>
                                <th class="px-4 py-2">Member</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2 whitespace-nowrap">Recorded</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($reviewRows as $row)
                                <tr class="hover:bg-gray-50/80">
                                    <td class="px-4 py-2 font-medium text-gray-900">{{ $row->user?->name ?? '—' }}</td>
                                    <td class="px-4 py-2 text-gray-600 break-all">{{ $row->user?->email ?? '—' }}</td>
                                    <td class="px-4 py-2 text-gray-600 whitespace-nowrap">{{ $row->created_at?->format('M j, Y g:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Committed <span class="text-gray-500 font-normal normal-case">(amount & deadline)</span></h2>
                <span class="text-xs font-semibold text-gray-500">{{ $deal->commits->count() }} {{ \Illuminate\Support\Str::plural('commitment', $deal->commits->count()) }}</span>
            </div>
            @if ($deal->commits->isEmpty())
                <p class="px-4 py-8 text-center text-sm text-gray-500">No recorded commitments for this deal.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-50 text-xs font-semibold text-gray-600 uppercase border-b border-gray-100">
                            <tr>
                                <th class="px-4 py-2">Member</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2 whitespace-nowrap">Amount</th>
                                <th class="px-4 py-2 whitespace-nowrap">Deadline</th>
                                <th class="px-4 py-2 whitespace-nowrap">Submitted</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($deal->commits as $commit)
                                <tr class="hover:bg-gray-50/80">
                                    <td class="px-4 py-2 font-medium text-gray-900">{{ $commit->user?->name ?? '—' }}</td>
                                    <td class="px-4 py-2 text-gray-600 break-all">{{ $commit->user?->email ?? '—' }}</td>
                                    <td class="px-4 py-2 text-gray-800 whitespace-nowrap">${{ number_format((float) $commit->amount, 2) }}</td>
                                    <td class="px-4 py-2 text-gray-600 whitespace-nowrap">{{ $commit->deadline ? \Carbon\Carbon::parse($commit->deadline)->format('M j, Y') : '—' }}</td>
                                    <td class="px-4 py-2 text-gray-600 whitespace-nowrap">{{ $commit->created_at?->format('M j, Y g:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Commit Submissions</h2>
                <span class="text-xs font-semibold text-gray-500">{{ $deal->commitSubmissions->count() }} {{ \Illuminate\Support\Str::plural('submission', $deal->commitSubmissions->count()) }}</span>
            </div>
            @if ($deal->commitSubmissions->isEmpty())
                <p class="px-4 py-8 text-center text-sm text-gray-500">No commit form submissions for this deal yet.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-50 text-xs font-semibold text-gray-600 uppercase border-b border-gray-100">
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2 whitespace-nowrap">WhatsApp</th>
                                <th class="px-4 py-2">Company</th>
                                <th class="px-4 py-2 whitespace-nowrap">Proposed amount</th>
                                <th class="px-4 py-2 whitespace-nowrap">Submitted</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($deal->commitSubmissions as $submission)
                                <tr class="hover:bg-gray-50/80">
                                    <td class="px-4 py-2 font-medium text-gray-900">{{ $submission->name }}</td>
                                    <td class="px-4 py-2 text-gray-600 break-all">
                                        <a href="mailto:{{ $submission->email }}" class="hover:underline">{{ $submission->email }}</a>
                                    </td>
                                    <td class="px-4 py-2 text-gray-600 whitespace-nowrap">{{ $submission->whatsapp_number }}</td>
                                    <td class="px-4 py-2 text-gray-600">{{ $submission->company_name }}</td>
                                    <td class="px-4 py-2 text-gray-800 whitespace-nowrap">{{ $submission->currency }} {{ number_format((float) $submission->amount, 2) }}</td>
                                    <td class="px-4 py-2 text-gray-600 whitespace-nowrap">{{ $submission->updated_at?->format('M j, Y g:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
