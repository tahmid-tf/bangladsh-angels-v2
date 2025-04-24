@extends('layouts.admin')
@section('page_title','Dashboard')
@section('page_content')
<!-- Overview Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <a href="{{route('admin.members')}}">
      <div class="p-5 bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
        <div class="flex justify-between items-center mb-2">
          <h2 class="text-2xl font-bold text-gray-800">{{ count($users) }}</h2>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
        </div>
        <p class="text-gray-500">Total Members</p>
        <div class="mt-2 text-sm text-blue-600">
          <span>{{ $activeMembers }} active members</span>
        </div>
      </div>
    </a>
    
    <a href="{{route('admin.deals')}}">
      <div class="p-5 bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
        <div class="flex justify-between items-center mb-2">
          <h2 class="text-2xl font-bold text-gray-800">{{ count($deals)}}</h2>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
          </svg>
        </div>
        <p class="text-gray-500">Active Deals</p>
        <div class="mt-2 text-sm text-green-600">
          <span>Deals in progress</span>
        </div>
      </div>
    </a>
    
    <a href="{{route('admin.subscriptions')}}">
      <div class="p-5 bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
        <div class="flex justify-between items-center mb-2">
          <h2 class="text-2xl font-bold text-gray-800">{{ count($subscriptions) }}</h2>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>
        </div>
        <p class="text-gray-500">Total Subscriptions</p>
        <div class="mt-2 text-sm text-purple-600">
          <span>Active membership plans</span>
        </div>
      </div>
    </a>
    
    <div class="p-5 bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
      <div class="flex justify-between items-center mb-2">
        <h2 class="text-2xl font-bold text-gray-800">BDT {{ number_format($totalRevenue, 2) }}</h2>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
      <p class="text-gray-500">Total Revenue</p>
      <div class="mt-2 text-sm text-amber-600">
        <span>{{ $completedPayments }} completed payments</span>
      </div>
    </div>
  </div>

  <!-- Charts Section -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
    <!-- Member Sign-ups Chart -->
    <div class="p-5 bg-white rounded-lg shadow">
      <h2 class="text-lg font-bold mb-4 text-gray-800">Member Sign Ups</h2>
      <div class="flex justify-center">
        <canvas id="memberChart" width="400" height="200"></canvas>
        <script>
          // Data passed from the controller
          const dates = {!! json_encode($dates) !!};
          const counts = {!! json_encode($counts) !!};
      
          // Initialize the Chart.js chart
          const ctx = document.getElementById('memberChart').getContext('2d');
          new Chart(ctx, {
              type: 'line', 
              data: {
                  labels: dates,
                  datasets: [{
                      label: 'Member Registrations',
                      data: counts,
                      backgroundColor: 'rgba(59, 130, 246, 0.2)',
                      borderColor: 'rgba(59, 130, 246, 1)',
                      borderWidth: 2,
                      tension: 0.3
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  scales: {
                      x: {
                          title: {
                              display: true,
                              text: 'Date'
                          }
                      },
                      y: {
                          beginAtZero: true,
                          title: {
                              display: true,
                              text: 'Total Members'
                          }
                      }
                  }
              }
          });
      </script>
      </div>
    </div>

    <!-- Monthly Revenue Chart -->
    <div class="p-5 bg-white rounded-lg shadow">
      <h2 class="text-lg font-bold mb-4 text-gray-800">Monthly Revenue</h2>
      <div class="flex justify-center">
        <canvas id="revenueChart" width="400" height="200"></canvas>
        <script>
          // Data passed from the controller
          const revenueLabels = {!! json_encode($revenueLabels) !!};
          const revenueData = {!! json_encode($revenueData) !!};
      
          // Initialize the Chart.js chart
          const revenueCtx = document.getElementById('revenueChart').getContext('2d');
          new Chart(revenueCtx, {
              type: 'bar', 
              data: {
                  labels: revenueLabels,
                  datasets: [{
                      label: 'Monthly Revenue',
                      data: revenueData,
                      backgroundColor: 'rgba(245, 158, 11, 0.2)',
                      borderColor: 'rgba(245, 158, 11, 1)',
                      borderWidth: 2
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  scales: {
                      x: {
                          title: {
                              display: true,
                              text: 'Month'
                          }
                      },
                      y: {
                          beginAtZero: true,
                          title: {
                              display: true,
                              text: 'Revenue'
                          }
                      }
                  }
              }
          });
      </script>
      </div>
    </div>
    
    <!-- Subscription Distribution -->
    <div class="p-5 bg-white rounded-lg shadow">
      <h2 class="text-lg font-bold mb-4 text-gray-800">Subscription Plans</h2>
      <div class="flex justify-center">
        <canvas id="planChart" width="400" height="200"></canvas>
        <script>
          // Data passed from the controller
          const planLabels = {!! json_encode($planLabels) !!};
          const planData = {!! json_encode($planData) !!};
      
          // Initialize the Chart.js chart
          const planCtx = document.getElementById('planChart').getContext('2d');
          new Chart(planCtx, {
              type: 'pie',
              data: {
                  labels: planLabels,
                  datasets: [{
                      data: planData,
                      backgroundColor: [
                          'rgba(168, 85, 247, 0.7)',
                          'rgba(59, 130, 246, 0.7)',
                          'rgba(16, 185, 129, 0.7)',
                          'rgba(249, 115, 22, 0.7)',
                      ],
                      borderColor: [
                          'rgba(168, 85, 247, 1)',
                          'rgba(59, 130, 246, 1)',
                          'rgba(16, 185, 129, 1)',
                          'rgba(249, 115, 22, 1)',
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                      legend: {
                          position: 'right',
                      },
                      title: {
                          display: true,
                          text: 'Distribution by Plan Type'
                      }
                  }
              }
          });
      </script>
      </div>
    </div>
    
    <!-- Payment Method Distribution -->
    <div class="p-5 bg-white rounded-lg shadow">
      <h2 class="text-lg font-bold mb-4 text-gray-800">Payment Methods</h2>
      <div class="flex justify-center">
        <canvas id="methodChart" width="400" height="200"></canvas>
        <script>
          // Data passed from the controller
          const methodLabels = {!! json_encode($methodLabels) !!};
          const methodData = {!! json_encode($methodData) !!};
      
          // Initialize the Chart.js chart
          const methodCtx = document.getElementById('methodChart').getContext('2d');
          new Chart(methodCtx, {
              type: 'doughnut',
              data: {
                  labels: methodLabels,
                  datasets: [{
                      data: methodData,
                      backgroundColor: [
                          'rgba(16, 185, 129, 0.7)',
                          'rgba(245, 158, 11, 0.7)',
                          'rgba(59, 130, 246, 0.7)',
                          'rgba(236, 72, 153, 0.7)',
                      ],
                      borderColor: [
                          'rgba(16, 185, 129, 1)',
                          'rgba(245, 158, 11, 1)',
                          'rgba(59, 130, 246, 1)',
                          'rgba(236, 72, 153, 1)',
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                      legend: {
                          position: 'right',
                      },
                      title: {
                          display: true,
                          text: 'Distribution by Payment Method'
                      }
                  }
              }
          });
      </script>
      </div>
    </div>
    
    <!-- Subscriptions Over Time -->
    <div class="p-5 bg-white rounded-lg shadow">
      <h2 class="text-lg font-bold mb-4 text-gray-800">Subscriptions</h2>
      <div class="flex justify-center">
        <canvas id="subscriptionChart" width="400" height="200"></canvas>
        <script>
          // Data passed from the controller
          const subDates = {!! json_encode($subscriptionDates) !!};
          const subCounts = {!! json_encode($subsCounts) !!};
      
          // Initialize the Chart.js chart
          const ctx2 = document.getElementById('subscriptionChart').getContext('2d');
          new Chart(ctx2, {
              type: 'bar',
              data: {
                  labels: subDates,
                  datasets: [{
                      label: 'Number of Members who subscribed',
                      data: subCounts,
                      backgroundColor: 'rgba(168, 85, 247, 0.2)',
                      borderColor: 'rgba(168, 85, 247, 1)',
                      borderWidth: 2
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  scales: {
                      x: {
                          title: {
                              display: true,
                              text: 'Date'
                          }
                      },
                      y: {
                          beginAtZero: true,
                          title: {
                              display: true,
                              text: 'Total Subscriptions'
                          }
                      }
                  }
              }
          });
      </script>
      </div>
    </div>
    
    <!-- Deals Over Time -->
    <div class="p-5 bg-white rounded-lg shadow">
      <h2 class="text-lg font-bold mb-4 text-gray-800">Deals Added</h2>
      <div class="flex justify-center">
        <canvas id="dealChart" width="400" height="200"></canvas>
        <script>
          // Data passed from the controller
          const dealDates = {!! json_encode($dealDates) !!};
          const dealCounts = {!! json_encode($dCounts) !!};
          
          // Initialize the Chart.js chart
          const ctx3 = document.getElementById('dealChart').getContext('2d');
          new Chart(ctx3, {
              type: 'bar',
              data: {
                  labels: dealDates,
                  datasets: [{
                      label: 'Number of Deals Added',
                      data: dealCounts,
                      backgroundColor: 'rgba(16, 185, 129, 0.2)',
                      borderColor: 'rgba(16, 185, 129, 1)',
                      borderWidth: 2
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  scales: {
                      x: {
                          title: {
                              display: true,
                              text: 'Date'
                          }
                      },
                      y: {
                          beginAtZero: true,
                          title: {
                              display: true,
                              text: 'Total Deals'
                          }
                      }
                  }
              }
          });
      </script>
      </div>
    </div>
  </div>

  <!-- Recent Activity Section -->
  <div class="grid grid-cols-1 gap-6 mt-6">
    <div class="p-5 bg-white rounded-lg shadow">
      <h2 class="text-lg font-bold mb-4 text-gray-800">Recent Activity</h2>
      
      <div class="flex mb-4">
        <div class="w-1/2 pr-4">
          <h3 class="font-bold text-md mb-2 text-gray-700">Recent Payments</h3>
          <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
              <thead>
                <tr>
                  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Member
                  </th>
                  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Amount
                  </th>
                  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Date
                  </th>
                  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Status
                  </th>
                </tr>
              </thead>
              <tbody>
                @forelse($payments->sortByDesc('payment_date')->take(5) as $payment)
                <tr>
                  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                    {{ $payment->user->name ?? 'Unknown' }}
                  </td>
                  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                    {{ $payment->currency }} {{ number_format($payment->amount, 2) }}
                  </td>
                  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                    {{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') : 'N/A' }}
                  </td>
                  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                    @if($payment->status == 'completed')
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Completed</span>
                    @elseif($payment->status == 'failed')
                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Failed</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">{{ ucfirst($payment->status) }}</span>
                    @endif
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="4" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-gray-500">
                    No payment records found
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        
        <div class="w-1/2 pl-4">
          <h3 class="font-bold text-md mb-2 text-gray-700">Recent Subscriptions</h3>
          <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
              <thead>
                <tr>
                  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Member
                  </th>
                  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Plan
                  </th>
                  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Date
                  </th>
                  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Status
                  </th>
                </tr>
              </thead>
              <tbody>
                @forelse($subscriptions->sortByDesc('created_at')->take(5) as $subscription)
                <tr>
                  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                    {{ $subscription->user->name ?? 'Unknown' }}
                  </td>
                  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                    {{ ucfirst($subscription->plan) }}
                  </td>
                  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                    {{ \Carbon\Carbon::parse($subscription->created_at)->format('M d, Y') }}
                  </td>
                  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                    @if($subscription->payment_id)
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Paid</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Unpaid</span>
                    @endif
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="4" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-gray-500">
                    No subscription records found
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
    </div>
  </div>

@endsection