@extends('layouts.admin')
@section('page_title','Deals | Dashboard')
@section('page_content')<header class="flex justify-between items-center p-6 bg-white shadow">
    <h1 class="text-xl font-bold">Investments</h1>
</header>

<div class="p-6 bg-white shadow mt-4">
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse border border-gray-200 text-left text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-4 font-medium text-gray-600">Deal</th>
                    <th class="px-6 py-4 font-medium text-gray-600">Total Investors</th>
                    <th class="px-6 py-4 font-medium text-gray-600">Investment Stage</th>
                    <th class="px-6 py-4 font-medium text-gray-600">Amount Seeking</th>
                    <th class="px-6 py-4 font-medium text-gray-600">Investors</th>
                    <th class="px-6 py-4 font-medium text-gray-600">Investment Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($investments as $dealId => $dealInvestments)
                    @php
                        $deal = $dealInvestments->first()->deal; // Fetch deal data
                        $investorCount = $dealInvestments->count(); // Count investors per deal
                        $dealCover = $deal->getFirstMediaUrl('company_cover', 'thumb') ?? asset('default-deal-cover.jpg');
                        $dealDescription = Str::limit($deal->description, 100, '...');
                        $investmentStage = $deal->investment_stage ?? 'Not Provided';
                        $amountSeeking = $deal->amount_seeking ? number_format($deal->amount_seeking, 2) . ' USD' : 'Not Disclosed';
                    @endphp
                    <tr class="border-t">
                        <!-- Deal Title with Cover Image & Brief Description -->
                        <td class="px-6 py-4 flex items-center space-x-4">
                            <img src="{{ $dealCover }}" 
                                 alt="Company Cover" 
                                 class="h-16 w-16 object-cover rounded-lg shadow-md">

                            <div>
                                <a href="{{ route('deal.public.view', $deal->id) }}" class="text-blue-600 font-semibold hover:underline">
                                    {{ $deal->title }}
                                </a>
                                <p class="text-sm text-gray-500">{{ $dealDescription }}</p>
                            </div>
                        </td>

                        <!-- Total Investors -->
                        <td class="px-6 py-4 font-bold text-center">
                            {{ $investorCount }}
                        </td>

                        <!-- Investment Stage -->
                        <td class="px-6 py-4 text-center">
                            {{ ucfirst($investmentStage) }}
                        </td>

                        <!-- Amount Seeking -->
                        <td class="px-6 py-4 text-center">
                            {{ $amountSeeking }}
                        </td>

                        <!-- Investor Details with Profile Photos -->
                        <td class="px-6 py-4">
                            <ul class="list-disc ml-4 space-y-3">
                                @foreach ($dealInvestments as $investment)
                                    <li class="flex items-center space-x-4">
                                        <!-- Profile Photo -->
                                        <img src="{{ $investment->user->getProfilePhotoUrl() }}" 
                                             alt="Profile Photo" 
                                             class="h-10 w-10 object-cover rounded-full shadow-sm">

                                        <div>
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
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </td>

                        <!-- Investment Type -->
                        <td class="px-6 py-4 text-center">
                            {{ ucfirst($dealInvestments->first()->type) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection