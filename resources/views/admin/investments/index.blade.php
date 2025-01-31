@extends('layouts.admin')
@section('page_title','Deals | Dashboard')
@section('page_content')<header class="flex justify-between items-center p-6 bg-white shadow">
    <h1 class="text-xl font-bold">Investments ({{count($totalInvestments)}})</h1>
</header>

<div class="p-6 bg-white shadow mt-4">    
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse border border-gray-200 text-left text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-4 font-medium text-gray-600">Deal Title</th>
                    <th class="px-6 py-4 font-medium text-gray-600">Total Investors</th>
                    <th class="px-6 py-4 font-medium text-gray-600">Investors</th>
                    <th class="px-6 py-4 font-medium text-gray-600">Investment Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($investments as $dealId => $dealInvestments)
                    @php
                        $deal = $dealInvestments->first()->deal; // Fetch the deal once
                        $investorCount = $dealInvestments->count(); // Count investors per deal
                    @endphp
                    <tr class="border-t">
                        <!-- Deal Title -->
                        <td class="px-6 py-4">
                            <a href="{{ route('deal.public.view', $deal->id) }}" class="text-blue-600 hover:underline">
                                {{ $deal->title }}
                            </a>
                        </td>
                        
                        <!-- Total Investors -->
                        <td class="px-6 py-4 font-bold">
                            {{ $investorCount }}
                        </td>

                        <!-- Investor Details -->
                        <td class="px-6 py-4">
                            <ul class="list-disc ml-4 space-y-2">
                                @foreach ($dealInvestments as $investment)
                                    <li class="pb-3">
                                        <!-- Name -->
                                        <span class="font-semibold">{{ $investment->user->name }}</span>
                                        
                                        <!-- Designation & Company -->
                                        <br>
                                        <span class="text-gray-500 text-sm">
                                            {{ $investment->user->designation ?? 'No Designation' }}
                                            @if(!empty($investment->user->company_name))
                                                at {{ $investment->user->company_name }}
                                            @endif
                                        </span>

                                        <!-- Contact Info -->
                                        <br>
                                        <span class="text-gray-500 text-xs">
                                            📧 
                                            @if(!empty($investment->user->email))
                                                <a href="mailto:{{ $investment->user->email }}" class="text-blue-600 hover:underline">
                                                    {{ $investment->user->email }}
                                                </a>
                                            @else
                                                <span class="text-gray-400 italic">No Email</span>
                                            @endif
                                            
                                            | 📞 
                                            @if(!empty($investment->user->phone))
                                                <a href="tel:{{ $investment->user->phone }}" class="text-blue-600 hover:underline">
                                                    {{ $investment->user->phone }}
                                                </a>
                                            @else
                                                <span class="text-gray-400 italic">No Phone</span>
                                            @endif
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>

                        <!-- Investment Type -->
                        <td class="px-6 py-4">
                            {{ ucfirst($dealInvestments->first()->type) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection