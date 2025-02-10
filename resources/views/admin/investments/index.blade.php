@extends('layouts.admin')
@section('page_title','Deals | Dashboard')
@section('page_content')<div class="overflow-x-auto">
    <table class="min-w-full border-collapse border border-gray-200 text-left text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-3 text-gray-700 font-semibold">Deal</th>
                <th class="px-4 py-3 text-gray-700 font-semibold hidden md:table-cell">Investors</th>
                <th class="px-4 py-3 text-gray-700 font-semibold">Investment Summary</th>
                <th class="px-4 py-3 text-gray-700 font-semibold">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($investments as $dealId => $dealInvestments)
                @php
                    $deal = $dealInvestments->first()->deal ?? null;
                    $statusMap = ['active' => 'Raising Now', 'closed' => 'Raising Closed', 'draft' => 'In Draft'];
                    $statusClass = ['active' => 'bg-green-100 text-green-700', 'closed' => 'bg-red-100 text-red-700', 'draft' => 'bg-gray-100 text-gray-700'];

                    $dealStatus = $statusMap[$deal->status ?? 'draft'] ?? 'Unknown';
                    $statusColorClass = $statusClass[$deal->status ?? 'draft'] ?? 'bg-gray-100 text-gray-700';

                    // Define colors for investment stages
                    $stageColors = [
                        'pre-seed' => 'bg-purple-100 text-purple-700',
                        'seed' => 'bg-blue-100 text-blue-700',
                        'series-a' => 'bg-green-100 text-green-700',
                        'series-b' => 'bg-yellow-100 text-yellow-700',
                        'growth' => 'bg-red-100 text-red-700',
                        'ipo' => 'bg-gray-100 text-gray-700'
                    ];
                    $investmentStage = strtolower($deal->investment_stage ?? 'unknown');
                    $stageColorClass = $stageColors[$investmentStage] ?? 'bg-gray-100 text-gray-700';
                    
                    $investorCount = count($dealInvestments);
                @endphp
                <tr class="border-t">
                    <!-- Deal Information with Investor Count -->
                    <td class="px-4 py-4">
                        <div class="flex items-center space-x-3">
                            <img src="{{ $deal ? $deal->getFirstMediaUrl('company_cover') : asset('default-company.jpg') }}" 
                                 class="w-16 h-16 rounded-md hidden md:block">
                            <div>
                                <a href="{{ $deal ? route('deal.public.view', $deal->id) : '#' }}" class="text-blue-600 font-semibold hover:underline">
                                    {{ $deal->title ?? 'No Title Available' }}
                                </a>
                                <p class="text-gray-500 text-xs md:text-sm">
                                    {{ $deal ? Str::limit($deal->description, 60) : 'No description available' }}
                                </p>
                                <p class="text-xs text-gray-600 font-medium mt-1">
                                    👥 {{ $investorCount }} Investor{{ $investorCount !== 1 ? 's' : '' }}
                                </p>
                            </div>
                        </div>
                    </td>

                    <!-- Investors (Prioritized on Mobile) -->
                    <td class="px-4 py-4">
                        <ul class="list-none">
                            @foreach ($dealInvestments as $investment)
                                @php $user = $investment->user ?? null; @endphp
                                <li class="flex items-start w-full my-2 bg-white rounded-lg p-3 border-box shadow-md">
                                    <img src="{{ $user->getProfilePhotoUrl() }}" 
                                         class="w-8 h-8 rounded-full mt-[10px]">
                                    <div class="w-full ml-3">
                                        <p class="font-medium w-full flex justify-between items-center">{{ $user->name ?? 'Unknown Investor' }} <small class="bg-gray-900 uppercase w-1/3 m-2 text-center text-white p-2 mx-2 border-box rounded-md">{{ ucfirst($investment->type) }}</small></p>
                                        <p class="text-xs text-gray-500">
                                            {{ $investment->created_at->diffForHumans() }}
                                        </p>
                                        <p class="text-xs text-gray-600">
                                            {{ $user->designation ?? 'No Designation' }} @ 
                                            {{ $user->company_name ?? 'No Company' }}
                                        </p>
                                        <p class="text-xs text-gray-400">{{ $user->email ?? 'No Email' }} | {{ $user->phone ?? 'No Phone' }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </td>

                    <!-- Investment Summary -->
                    <td class="px-4 py-4 hidden md:table-cell">
                        <div class="flex flex-col space-y-2">
                            <span class="text-gray-700 text-sm font-semibold">Amount Seeking:</span>
                            <span class="text-lg font-bold text-gray-800">
                                ${{ $deal->amount_seeking ? number_format($deal->amount_seeking, 2) : 'N/A' }}
                            </span>
                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $stageColorClass }}">
                                {{ ucfirst($deal->investment_stage ?? 'Unknown') }} Stage
                            </span>
                        </div>
                    </td>

                    <!-- Status Indicator -->
                    <td class="px-4 py-4">
                        <span class="px-3 py-1 rounded text-xs font-semibold {{ $statusColorClass }}">
                            {{ $dealStatus }}
                        </span>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection