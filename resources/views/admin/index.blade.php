@extends('layouts.admin')

@section('page_title', 'Admin Dashboard')

@section('page_content')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>

<section class="admin-dashboard" aria-labelledby="dashboard-title">
    <div class="admin-dashboard__welcome">
        <div class="admin-dashboard__welcome-copy">
            <p class="admin-dashboard__eyebrow">Platform overview</p>
            <h1 id="dashboard-title">Welcome back, {{ auth()->user()->name }}.</h1>
            <p>Monitor membership, deal flow, subscriptions, and revenue from one focused workspace.</p>
        </div>

        <div class="admin-dashboard__welcome-actions" aria-label="Quick actions">
            <a href="{{ route('member.add') }}" class="admin-dashboard__action admin-dashboard__action--primary">
                <span class="admin-dashboard__action-mark" aria-hidden="true">+</span>
                Add member
            </a>
            <a href="{{ route('deal.add') }}" class="admin-dashboard__action">
                <span class="admin-dashboard__action-mark" aria-hidden="true">+</span>
                Add deal
            </a>
            <a href="{{ route('admin.mail') }}" class="admin-dashboard__action">
                <span class="admin-dashboard__action-mark" aria-hidden="true">↗</span>
                New campaign
            </a>
        </div>
    </div>

    <div class="admin-dashboard__metrics" aria-label="Key platform metrics">
        <a href="{{ route('admin.members') }}" class="admin-metric">
            <div class="admin-metric__top">
                <p class="admin-metric__label">Total members</p>
                <span class="admin-metric__mark" aria-hidden="true">M</span>
            </div>
            <p class="admin-metric__value">{{ number_format(count($users)) }}</p>
            <div class="admin-metric__bottom">
                <p class="admin-metric__detail">{{ number_format($activeMembers) }} active members</p>
                <span class="admin-metric__link" aria-hidden="true">→</span>
            </div>
        </a>

        <a href="{{ route('admin.deals') }}" class="admin-metric admin-metric--blue">
            <div class="admin-metric__top">
                <p class="admin-metric__label">Deal flow</p>
                <span class="admin-metric__mark" aria-hidden="true">D</span>
            </div>
            <p class="admin-metric__value">{{ number_format(count($deals)) }}</p>
            <div class="admin-metric__bottom">
                <p class="admin-metric__detail">Deals currently tracked</p>
                <span class="admin-metric__link" aria-hidden="true">→</span>
            </div>
        </a>

        <a href="{{ route('admin.subscriptions') }}" class="admin-metric admin-metric--plum">
            <div class="admin-metric__top">
                <p class="admin-metric__label">Subscriptions</p>
                <span class="admin-metric__mark" aria-hidden="true">S</span>
            </div>
            <p class="admin-metric__value">{{ number_format(count($subscriptions)) }}</p>
            <div class="admin-metric__bottom">
                <p class="admin-metric__detail">Plans on record</p>
                <span class="admin-metric__link" aria-hidden="true">→</span>
            </div>
        </a>

        <div class="admin-metric admin-metric--gold">
            <div class="admin-metric__top">
                <p class="admin-metric__label">Total revenue</p>
                <span class="admin-metric__mark" aria-hidden="true">৳</span>
            </div>
            <p class="admin-metric__value admin-metric__value--currency">BDT {{ number_format($totalRevenue, 2) }}</p>
            <div class="admin-metric__bottom">
                <p class="admin-metric__detail">{{ number_format($completedPayments) }} completed payments</p>
            </div>
        </div>
    </div>

    <div class="admin-dashboard__section-heading">
        <div>
            <h2>Performance overview</h2>
            <p>Membership growth and completed payment revenue.</p>
        </div>
        <span class="admin-dashboard__date">Updated {{ now()->format('M d, Y') }}</span>
    </div>

    <div class="admin-dashboard__chart-grid">
        <article class="admin-panel">
            <div class="admin-panel__header">
                <div>
                    <h3>Member sign-ups</h3>
                    <p>Registration volume over time</p>
                </div>
                <span class="admin-panel__legend">Members</span>
            </div>
            <div class="admin-panel__chart">
                <canvas id="memberChart" aria-label="Member sign-ups over time" role="img"></canvas>
            </div>
        </article>

        <article class="admin-panel">
            <div class="admin-panel__header">
                <div>
                    <h3>Monthly revenue</h3>
                    <p>Revenue from completed payments</p>
                </div>
                <span class="admin-panel__legend">BDT</span>
            </div>
            <div class="admin-panel__chart">
                <canvas id="revenueChart" aria-label="Monthly completed payment revenue" role="img"></canvas>
            </div>
        </article>
    </div>

    <div class="admin-dashboard__section-heading">
        <div>
            <h2>Portfolio insights</h2>
            <p>Operational activity and payment distribution at a glance.</p>
        </div>
    </div>

    <div class="admin-dashboard__insight-grid">
        <article class="admin-panel admin-dashboard__trend-pair">
            <div class="admin-dashboard__trend">
                <h3>Subscriptions over time</h3>
                <p>New subscriptions by date</p>
                <div class="admin-dashboard__trend-chart">
                    <canvas id="subscriptionChart" aria-label="Subscriptions over time" role="img"></canvas>
                </div>
            </div>

            <div class="admin-dashboard__trend">
                <h3>Deals added over time</h3>
                <p>New opportunities by date</p>
                <div class="admin-dashboard__trend-chart">
                    <canvas id="dealChart" aria-label="Deals added over time" role="img"></canvas>
                </div>
            </div>
        </article>

        <div class="admin-dashboard__donuts">
            <article class="admin-panel admin-panel--donut">
                <div class="admin-panel__header">
                    <div>
                        <h3>Plan mix</h3>
                        <p>Subscriptions by plan</p>
                    </div>
                </div>
                <div class="admin-panel__chart">
                    <canvas id="planChart" aria-label="Subscription distribution by plan" role="img"></canvas>
                </div>
            </article>

            <article class="admin-panel admin-panel--donut">
                <div class="admin-panel__header">
                    <div>
                        <h3>Payment mix</h3>
                        <p>Completed payments by method</p>
                    </div>
                </div>
                <div class="admin-panel__chart">
                    <canvas id="methodChart" aria-label="Completed payments by method" role="img"></canvas>
                </div>
            </article>
        </div>
    </div>

    <div class="admin-dashboard__section-heading">
        <div>
            <h2>Recent activity</h2>
            <p>The latest financial and membership updates.</p>
        </div>
    </div>

    <div class="admin-dashboard__activity-grid">
        <article class="admin-panel admin-activity-card">
            <div class="admin-activity-card__header">
                <h3>Recent payments</h3>
                <span class="admin-dashboard__date">Latest 5</span>
            </div>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th scope="col">Member</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments->sortByDesc('payment_date')->take(5) as $payment)
                            @php($paymentMember = $payment->user->name ?? 'Unknown')
                            <tr>
                                <td>
                                    <div class="admin-table__member">
                                        <span class="admin-table__avatar" aria-hidden="true">{{ strtoupper(substr($paymentMember, 0, 1)) }}</span>
                                        <span>{{ $paymentMember }}</span>
                                    </div>
                                </td>
                                <td class="admin-table__amount">{{ $payment->currency }} {{ number_format($payment->amount, 2) }}</td>
                                <td>{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') : 'N/A' }}</td>
                                <td>
                                    @if($payment->status === 'completed')
                                        <span class="admin-status">Completed</span>
                                    @elseif($payment->status === 'failed')
                                        <span class="admin-status admin-status--danger">Failed</span>
                                    @else
                                        <span class="admin-status admin-status--warning">{{ ucfirst($payment->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="admin-table__empty">No payment records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </article>

        <article class="admin-panel admin-activity-card">
            <div class="admin-activity-card__header">
                <h3>Recent subscriptions</h3>
                <a href="{{ route('admin.subscriptions') }}">View all →</a>
            </div>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th scope="col">Member</th>
                            <th scope="col">Plan</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subscriptions->sortByDesc('created_at')->take(5) as $subscription)
                            @php($subscriptionMember = $subscription->user->name ?? 'Unknown')
                            <tr>
                                <td>
                                    <div class="admin-table__member">
                                        <span class="admin-table__avatar" aria-hidden="true">{{ strtoupper(substr($subscriptionMember, 0, 1)) }}</span>
                                        <span>{{ $subscriptionMember }}</span>
                                    </div>
                                </td>
                                <td class="admin-table__amount">{{ ucfirst($subscription->plan) }}</td>
                                <td>{{ \Carbon\Carbon::parse($subscription->created_at)->format('M d, Y') }}</td>
                                <td>
                                    @if($subscription->payment_id)
                                        <span class="admin-status">Paid</span>
                                    @else
                                        <span class="admin-status admin-status--warning">Unpaid</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="admin-table__empty">No subscription records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </article>
    </div>
</section>

<script>
    const dashboardData = {
        memberDates: @json($dates),
        memberCounts: @json($counts),
        revenueLabels: @json($revenueLabels),
        revenue: @json($revenueData),
        planLabels: @json($planLabels),
        plans: @json($planData),
        methodLabels: @json($methodLabels),
        methods: @json($methodData),
        subscriptionDates: @json($subscriptionDates),
        subscriptions: @json($subsCounts),
        dealDates: @json($dealDates),
        deals: @json($dCounts),
    };

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const chartPalette = ['#0f7a5a', '#3e72b4', '#b57d24', '#74518f', '#2f9c95', '#ca5d76', '#71834a'];

    Chart.defaults.color = '#71827c';
    Chart.defaults.font.family = 'Manrope, Figtree, ui-sans-serif, system-ui, sans-serif';
    Chart.defaults.font.size = 11;
    Chart.defaults.animation.duration = prefersReducedMotion ? 0 : 550;

    const compactNumber = new Intl.NumberFormat('en', { notation: 'compact', maximumFractionDigits: 1 });
    const chartEvents = ['mousemove', 'mouseout', 'click', 'touchstart', 'touchmove'];

    const cartesianOptions = (isCurrency = false) => ({
        responsive: true,
        maintainAspectRatio: false,
        events: chartEvents,
        interaction: {
            intersect: false,
            mode: 'index',
            axis: 'x',
        },
        hover: {
            intersect: false,
            mode: 'index',
        },
        plugins: {
            legend: { display: false },
            tooltip: {
                enabled: true,
                mode: 'index',
                intersect: false,
                position: 'nearest',
                backgroundColor: '#102a25',
                titleColor: '#ffffff',
                bodyColor: '#dff4ea',
                padding: 12,
                cornerRadius: 10,
                displayColors: false,
                callbacks: isCurrency ? {
                    label: (context) => `BDT ${Number(context.parsed.y || 0).toLocaleString()}`,
                } : {},
            },
        },
        scales: {
            x: {
                border: { display: false },
                grid: { display: false },
                ticks: {
                    color: '#87958f',
                    maxRotation: 0,
                    autoSkipPadding: 18,
                    maxTicksLimit: 7,
                },
            },
            y: {
                beginAtZero: true,
                border: { display: false },
                grid: { color: 'rgba(16, 42, 37, 0.07)' },
                ticks: {
                    color: '#87958f',
                    padding: 8,
                    callback: (value) => isCurrency ? compactNumber.format(value) : value,
                },
            },
        },
    });

    const doughnutOptions = {
        responsive: true,
        maintainAspectRatio: false,
        events: chartEvents,
        interaction: {
            mode: 'nearest',
            intersect: true,
        },
        hover: {
            mode: 'nearest',
            intersect: true,
        },
        cutout: '70%',
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    pointStyle: 'circle',
                    boxWidth: 7,
                    boxHeight: 7,
                    padding: 14,
                    color: '#60736c',
                    font: { size: 10, weight: 600 },
                },
            },
            tooltip: {
                enabled: true,
                mode: 'nearest',
                intersect: true,
                position: 'nearest',
                backgroundColor: '#102a25',
                bodyColor: '#ffffff',
                padding: 11,
                cornerRadius: 10,
                displayColors: true,
            },
        },
    };

    new Chart(document.getElementById('memberChart'), {
        type: 'line',
        data: {
            labels: dashboardData.memberDates,
            datasets: [{
                label: 'Member registrations',
                data: dashboardData.memberCounts,
                backgroundColor: 'rgba(15, 122, 90, 0.1)',
                borderColor: '#0f7a5a',
                borderWidth: 2.5,
                fill: true,
                tension: 0.38,
                pointRadius: 0,
                pointHoverRadius: 4,
                pointHitRadius: 16,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#0f7a5a',
                pointBorderWidth: 2,
            }],
        },
        options: cartesianOptions(),
    });

    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels: dashboardData.revenueLabels,
            datasets: [{
                label: 'Monthly revenue',
                data: dashboardData.revenue,
                backgroundColor: '#bce7d3',
                borderColor: '#0f7a5a',
                borderWidth: 1,
                borderRadius: 7,
                borderSkipped: false,
                maxBarThickness: 38,
            }],
        },
        options: cartesianOptions(true),
    });

    new Chart(document.getElementById('subscriptionChart'), {
        type: 'line',
        data: {
            labels: dashboardData.subscriptionDates,
            datasets: [{
                label: 'Subscriptions',
                data: dashboardData.subscriptions,
                backgroundColor: 'rgba(116, 81, 143, 0.08)',
                borderColor: '#74518f',
                borderWidth: 2.25,
                fill: true,
                tension: 0.38,
                pointRadius: 0,
                pointHoverRadius: 4,
                pointHitRadius: 16,
            }],
        },
        options: cartesianOptions(),
    });

    new Chart(document.getElementById('dealChart'), {
        type: 'line',
        data: {
            labels: dashboardData.dealDates,
            datasets: [{
                label: 'Deals added',
                data: dashboardData.deals,
                backgroundColor: 'rgba(62, 114, 180, 0.08)',
                borderColor: '#3e72b4',
                borderWidth: 2.25,
                fill: true,
                tension: 0.38,
                pointRadius: 0,
                pointHoverRadius: 4,
                pointHitRadius: 16,
            }],
        },
        options: cartesianOptions(),
    });

    new Chart(document.getElementById('planChart'), {
        type: 'doughnut',
        data: {
            labels: dashboardData.planLabels,
            datasets: [{
                data: dashboardData.plans,
                backgroundColor: chartPalette,
                borderColor: '#ffffff',
                borderWidth: 3,
                hoverOffset: 3,
            }],
        },
        options: doughnutOptions,
    });

    new Chart(document.getElementById('methodChart'), {
        type: 'doughnut',
        data: {
            labels: dashboardData.methodLabels,
            datasets: [{
                data: dashboardData.methods,
                backgroundColor: ['#2f9c95', '#b57d24', '#3e72b4', '#ca5d76', '#74518f', '#71834a'],
                borderColor: '#ffffff',
                borderWidth: 3,
                hoverOffset: 3,
            }],
        },
        options: doughnutOptions,
    });
</script>
@endsection
