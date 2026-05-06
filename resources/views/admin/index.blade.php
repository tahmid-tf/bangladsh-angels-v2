@extends('layouts.admin')
@section('page_title', 'Dashboard')
@section('page_content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<section class="container mx-auto p-4 md:p-6">
    <div class="bg-white rounded-xl shadow p-4 md:p-5 mb-5">
        <h1 class="text-lg md:text-xl font-bold text-gray-900">Admin Dashboard</h1>
        <p class="text-sm text-gray-600 mt-1">Overview of members, deals, subscriptions, revenue, and recent platform activity.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 md:gap-5">
        <a href="{{ route('admin.members') }}" class="bg-white rounded-xl shadow p-4 hover:shadow-md transition-shadow">
            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Members</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ count($users) }}</p>
            <p class="text-sm text-[#0a5554] mt-2">{{ $activeMembers }} active</p>
        </a>

        <a href="{{ route('admin.deals') }}" class="bg-white rounded-xl shadow p-4 hover:shadow-md transition-shadow">
            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Deals</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ count($deals) }}</p>
            <p class="text-sm text-[#0a5554] mt-2">Currently tracked</p>
        </a>

        <a href="{{ route('admin.subscriptions') }}" class="bg-white rounded-xl shadow p-4 hover:shadow-md transition-shadow">
            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Subscriptions</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ count($subscriptions) }}</p>
            <p class="text-sm text-[#0a5554] mt-2">Active plans</p>
        </a>

        <div class="bg-white rounded-xl shadow p-4">
            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Total Revenue</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">BDT {{ number_format($totalRevenue, 2) }}</p>
            <p class="text-sm text-[#0a5554] mt-2">{{ $completedPayments }} completed payments</p>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 mt-5">
        <div class="bg-white rounded-xl shadow p-4 md:p-5">
            <h2 class="text-base font-semibold text-gray-900 mb-3">Member Sign Ups</h2>
            <div class="relative h-64">
                <canvas id="memberChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-4 md:p-5">
            <h2 class="text-base font-semibold text-gray-900 mb-3">Monthly Revenue</h2>
            <div class="relative h-64">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-4 md:p-5">
            <h2 class="text-base font-semibold text-gray-900 mb-3">Subscription Plans</h2>
            <div class="relative h-64">
                <canvas id="planChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-4 md:p-5">
            <h2 class="text-base font-semibold text-gray-900 mb-3">Payment Methods</h2>
            <div class="relative h-64">
                <canvas id="methodChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-4 md:p-5">
            <h2 class="text-base font-semibold text-gray-900 mb-3">Subscriptions Over Time</h2>
            <div class="relative h-64">
                <canvas id="subscriptionChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-4 md:p-5">
            <h2 class="text-base font-semibold text-gray-900 mb-3">Deals Added Over Time</h2>
            <div class="relative h-64">
                <canvas id="dealChart"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-4 md:p-5 mt-5">
        <h2 class="text-base font-semibold text-gray-900 mb-4">Recent Activity</h2>
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
            <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Recent Payments</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold text-gray-600">Member</th>
                                <th class="px-3 py-2 text-left font-semibold text-gray-600">Amount</th>
                                <th class="px-3 py-2 text-left font-semibold text-gray-600">Date</th>
                                <th class="px-3 py-2 text-left font-semibold text-gray-600">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($payments->sortByDesc('payment_date')->take(5) as $payment)
                                <tr>
                                    <td class="px-3 py-2 text-gray-800">{{ $payment->user->name ?? 'Unknown' }}</td>
                                    <td class="px-3 py-2 text-gray-700">{{ $payment->currency }} {{ number_format($payment->amount, 2) }}</td>
                                    <td class="px-3 py-2 text-gray-700">{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') : 'N/A' }}</td>
                                    <td class="px-3 py-2">
                                        @if($payment->status == 'completed')
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Completed</span>
                                        @elseif($payment->status == 'failed')
                                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">Failed</span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded-full bg-amber-100 text-amber-700">{{ ucfirst($payment->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-3 py-5 text-center text-gray-500">No payment records found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Recent Subscriptions</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold text-gray-600">Member</th>
                                <th class="px-3 py-2 text-left font-semibold text-gray-600">Plan</th>
                                <th class="px-3 py-2 text-left font-semibold text-gray-600">Date</th>
                                <th class="px-3 py-2 text-left font-semibold text-gray-600">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($subscriptions->sortByDesc('created_at')->take(5) as $subscription)
                                <tr>
                                    <td class="px-3 py-2 text-gray-800">{{ $subscription->user->name ?? 'Unknown' }}</td>
                                    <td class="px-3 py-2 text-gray-700">{{ ucfirst($subscription->plan) }}</td>
                                    <td class="px-3 py-2 text-gray-700">{{ \Carbon\Carbon::parse($subscription->created_at)->format('M d, Y') }}</td>
                                    <td class="px-3 py-2">
                                        @if($subscription->payment_id)
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Paid</span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded-full bg-amber-100 text-amber-700">Unpaid</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-3 py-5 text-center text-gray-500">No subscription records found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const dates = {!! json_encode($dates) !!};
    const counts = {!! json_encode($counts) !!};
    const revenueLabels = {!! json_encode($revenueLabels) !!};
    const revenueData = {!! json_encode($revenueData) !!};
    const planLabels = {!! json_encode($planLabels) !!};
    const planData = {!! json_encode($planData) !!};
    const methodLabels = {!! json_encode($methodLabels) !!};
    const methodData = {!! json_encode($methodData) !!};
    const subDates = {!! json_encode($subscriptionDates) !!};
    const subCounts = {!! json_encode($subsCounts) !!};
    const dealDates = {!! json_encode($dealDates) !!};
    const dealCounts = {!! json_encode($dCounts) !!};

    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
    };

    new Chart(document.getElementById('memberChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: 'Member Registrations',
                data: counts,
                backgroundColor: 'rgba(10, 85, 84, 0.12)',
                borderColor: 'rgba(10, 85, 84, 1)',
                borderWidth: 2,
                tension: 0.3
            }]
        },
        options: commonOptions
    });

    new Chart(document.getElementById('revenueChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: revenueLabels,
            datasets: [{
                label: 'Monthly Revenue',
                data: revenueData,
                backgroundColor: 'rgba(16, 185, 129, 0.2)',
                borderColor: 'rgba(16, 185, 129, 1)',
                borderWidth: 2
            }]
        },
        options: commonOptions
    });

    new Chart(document.getElementById('planChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: planLabels,
            datasets: [{
                data: planData,
                backgroundColor: ['rgba(10, 85, 84, 0.75)', 'rgba(59, 130, 246, 0.75)', 'rgba(16, 185, 129, 0.75)', 'rgba(249, 115, 22, 0.75)'],
                borderWidth: 1
            }]
        },
        options: {
            ...commonOptions,
            plugins: {
                legend: { position: window.innerWidth < 768 ? 'bottom' : 'right' }
            }
        }
    });

    new Chart(document.getElementById('methodChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: methodLabels,
            datasets: [{
                data: methodData,
                backgroundColor: ['rgba(16, 185, 129, 0.75)', 'rgba(245, 158, 11, 0.75)', 'rgba(59, 130, 246, 0.75)', 'rgba(236, 72, 153, 0.75)'],
                borderWidth: 1
            }]
        },
        options: {
            ...commonOptions,
            plugins: {
                legend: { position: window.innerWidth < 768 ? 'bottom' : 'right' }
            }
        }
    });

    new Chart(document.getElementById('subscriptionChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: subDates,
            datasets: [{
                label: 'Subscriptions',
                data: subCounts,
                backgroundColor: 'rgba(10, 85, 84, 0.2)',
                borderColor: 'rgba(10, 85, 84, 1)',
                borderWidth: 2
            }]
        },
        options: commonOptions
    });

    new Chart(document.getElementById('dealChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: dealDates,
            datasets: [{
                label: 'Deals Added',
                data: dealCounts,
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 2
            }]
        },
        options: commonOptions
    });
</script>

@endsection