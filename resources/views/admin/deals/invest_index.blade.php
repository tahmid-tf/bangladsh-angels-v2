@extends('layouts.admin')
@section('page_title','Deals | Dashboard')
@section('page_content')
<section class="container mx-auto p-6">
    <!-- Header -->
    <header class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Deals ({{count($deals)}})</h1>
            <p class="text-gray-500">Dashboard &gt; Deals</p>
        </div>
        <a href="{{route('deal.add')}}" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">
            + Add new deal
        </a>
    </header>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex flex-wrap items-center gap-4">
            <!-- Tabs -->
            <div class="flex space-x-4">
                <a href="{{route('admin.deals')}}" class="px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-full">All</a>
                <a href="{{route('admin.deals.invest')}}" class="px-4 py-2 bg-green-100 text-green-700 rounded-full">Invest</a>
                <a href="{{route('admin.deals.commit')}}" class="px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-full">Commit</a>
                <a href="{{route('admin.deals.review')}}" class="px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-full">Review</a>
                <a href="{{route('admin.deals.portfolio')}}" class="px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-full">Portfolio</a>
            </div>

            

            <input
                type="text"
                placeholder="Search..."
                class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200 focus:border-green-500"
            />
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600 font-semibold">Name</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-semibold">Investment stage</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-semibold">Amount Seeking</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-semibold">Description</th>
                    <th class="px-4 py-2 text-center text-gray-600 font-semibold">Key Metrics</th>
                    <th class="px-4 py-2 text-center text-gray-600 font-semibold">View</th>
                    <th class="px-4 py-2 text-center text-gray-600 font-semibold">Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deals as $deal)
                <tr class="border-t">
                    <td class="px-4 py-2 flex items-center space-x-4">
                        <img src="{{ $deal->getLogoUrl() }}" alt="{{ $deal->title }} Logo" class="h-[30px] rounded-full">
                        <div>
                            <p class="font-semibold">{{ $deal->title }}</p>
                            <p class="text-sm text-gray-500">{{ $deal->sector }}</p>
                        </div>
                    </td>
                    <td class="px-4 py-2">{{ $deal->investment_stage }}</td>
                    <td class="px-4 py-2">${{ number_format($deal->amount_seeking, 2) }}</td>
                    <td class="px-4 py-2">{{ $deal->description }}</td>
                    <td class="px-4 py-2 text-left">
                        @foreach($deal->getKeyMetrics() as $metric)
                            <li>
                                <strong>{{ $metric['name'] ?? 'Unnamed Metric' }}:</strong> 
                                {{ $metric['value'] ?? 'No Value Provided' }}
                            </li>
                        @endforeach
                    </td>
                    <td class="px-4 py-2 text-center">
                        <a href="{{route('deal.view',$deal->id)}}">
                            <svg version="1.1" id="Layer_1" fill="#999" class="h-[30px]" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="122.879px" height="119.799px" viewBox="0 0 122.879 119.799" enable-background="new 0 0 122.879 119.799" xml:space="preserve"><g><path d="M49.988,0h0.016v0.007C63.803,0.011,76.298,5.608,85.34,14.652c9.027,9.031,14.619,21.515,14.628,35.303h0.007v0.033v0.04 h-0.007c-0.005,5.557-0.917,10.905-2.594,15.892c-0.281,0.837-0.575,1.641-0.877,2.409v0.007c-1.446,3.66-3.315,7.12-5.547,10.307 l29.082,26.139l0.018,0.016l0.157,0.146l0.011,0.011c1.642,1.563,2.536,3.656,2.649,5.78c0.11,2.1-0.543,4.248-1.979,5.971 l-0.011,0.016l-0.175,0.203l-0.035,0.035l-0.146,0.16l-0.016,0.021c-1.565,1.642-3.654,2.534-5.78,2.646 c-2.097,0.111-4.247-0.54-5.971-1.978l-0.015-0.011l-0.204-0.175l-0.029-0.024L78.761,90.865c-0.88,0.62-1.778,1.209-2.687,1.765 c-1.233,0.755-2.51,1.466-3.813,2.115c-6.699,3.342-14.269,5.222-22.272,5.222v0.007h-0.016v-0.007 c-13.799-0.004-26.296-5.601-35.338-14.645C5.605,76.291,0.016,63.805,0.007,50.021H0v-0.033v-0.016h0.007 c0.004-13.799,5.601-26.296,14.645-35.338C23.683,5.608,36.167,0.016,49.955,0.007V0H49.988L49.988,0z M50.004,11.21v0.007h-0.016 h-0.033V11.21c-10.686,0.007-20.372,4.35-27.384,11.359C15.56,29.578,11.213,39.274,11.21,49.973h0.007v0.016v0.033H11.21 c0.007,10.686,4.347,20.367,11.359,27.381c7.009,7.012,16.705,11.359,27.403,11.361v-0.007h0.016h0.033v0.007 c10.686-0.007,20.368-4.348,27.382-11.359c7.011-7.009,11.358-16.702,11.36-27.4h-0.006v-0.016v-0.033h0.006 c-0.006-10.686-4.35-20.372-11.358-27.384C70.396,15.56,60.703,11.213,50.004,11.21L50.004,11.21z"/></g></svg>
                        </a>
                    </td>
                    <td class="px-4 py-2 text-center">
                        <a href="#">
                            <svg class="h-[25px]" fill="#999" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 117.74 122.88" style="enable-background:new 0 0 117.74 122.88" xml:space="preserve"><style type="text/css">.st0{fill-rule:evenodd;clip-rule:evenodd;}</style><g><path class="st0" d="M94.62,2c-1.46-1.36-3.14-2.09-5.02-1.99c-1.88,0-3.56,0.73-4.92,2.2L73.59,13.72l31.07,30.03l11.19-11.72 c1.36-1.36,1.88-3.14,1.88-5.02s-0.73-3.66-2.09-4.92L94.62,2L94.62,2L94.62,2z M41.44,109.58c-4.08,1.36-8.26,2.62-12.35,3.98 c-4.08,1.36-8.16,2.72-12.35,4.08c-9.73,3.14-15.07,4.92-16.22,5.23c-1.15,0.31-0.42-4.18,1.99-13.6l7.74-29.61l0.64-0.66 l30.56,30.56L41.44,109.58L41.44,109.58L41.44,109.58z M22.2,67.25l42.99-44.82l31.07,29.92L52.75,97.8L22.2,67.25L22.2,67.25z"/></g></svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>

   
</section>

<style>
    .toggle-checkbox {
        width: 1.5rem;
        height: 0.75rem;
        appearance: none;
        background: #d1d5db;
        border-radius: 9999px;
        position: relative;
        cursor: pointer;
        transition: background 0.3s;
    }

    .toggle-checkbox:checked {
        background: #34d399;
    }
</style>

@endsection