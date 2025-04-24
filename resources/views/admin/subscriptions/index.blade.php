@extends('layouts.admin')
@section('page_title','Subscriptions | Dashboard')
@section('page_content')

<!-- Header Section -->
<header class="flex justify-between items-center p-6 bg-white shadow">
    <h1 class="text-xl font-bold">Subscriptions ({{count($subscriptions)}})</h1>
    <a href="{{route('member.add')}}" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">
      + Add New Member
    </a>
  </header>

  <!-- Filters and Search -->
  <div class="p-6 bg-white shadow mt-4">
    <div class="flex flex-wrap items-center justify-between">
      <!-- Tabs -->
      <div class="flex space-x-4 mb-4 sm:mb-0">
        <a href="{{route('admin.members')}}" class="px-4 py-2 bg-green-100 text-green-700 font-semibold rounded-lg">All Members</a>
        <a href="{{route('admin.subscriptions')}}" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg">Subscriptions</a>
      </div>

      <!-- Filter and Search -->
      <div class="flex items-center space-x-4">
        <select id="planFilter" onchange="filterTable()" class="border-gray-300 rounded-lg shadow-sm text-gray-600">
          <option value="all">All Plans</option>
          <option value="core">Core</option>
          <option value="advanced">Advanced</option>
          <option value="institutional">Institutional</option>
        </select>
        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search..." class="border-gray-300 rounded-lg shadow-sm px-4 py-2">
      </div>
    </div>
  </div>
  @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M14.59 5.41L10 10l-4.59-4.59L4 7l6 6 6-6z" />
            </svg>
        </span>
    </div>
  @endif

  <!-- Subscriptions and Payments Table -->
  <div class="p-6 bg-white shadow mt-4 overflow-x-auto">
    <table id="subscriptionTable" class="min-w-full border-collapse border border-gray-200 text-left text-sm">
      <thead>
          <tr class="bg-gray-100">
              <th class="px-4 py-3 font-medium text-gray-600">Member</th>
              <th class="px-4 py-3 font-medium text-gray-600">Current Plan</th>
              <th class="px-4 py-3 font-medium text-gray-600">Payment Date</th>
              <th class="px-4 py-3 font-medium text-gray-600">Expiry Date</th>
              <th class="px-4 py-3 font-medium text-gray-600">Amount</th>
              <th class="px-4 py-3 font-medium text-gray-600">Transaction ID</th>
              <th class="px-4 py-3 font-medium text-gray-600">Payment Method</th>
              <th class="px-4 py-3 font-medium text-gray-600">Status</th>
              <th class="px-4 py-3 font-medium text-gray-600">Actions</th>
          </tr>
      </thead>
      <tbody>
        @php
          // Get all payments with users and sort by payment date
          $payments = \App\Models\Payment::with('user')->orderByDesc('payment_date')->get();
        @endphp
          
        @forelse($payments as $payment)
          @if ($payment->user && $payment->user->id !== auth()->user()->id)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-3">
                        <img src="{{ $payment->user->getProfilePhotoUrl() }}" alt="Profile" class="rounded-full w-10 h-10">
                        <div>
                            <p class="font-medium">{{ $payment->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $payment->user->email }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-3">
                    <span class="plan-value">{{ ucfirst($payment->subscription_plan) }}</span>
                </td>
                <td class="px-4 py-3 text-sm">
                    {{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') : 'N/A' }}
                </td>
                <td class="px-4 py-3 text-sm">
                    {{ $payment->expiry_date ? \Carbon\Carbon::parse($payment->expiry_date)->format('M d, Y') : 'N/A' }}
                </td>
                <td class="px-4 py-3">
                    {{ $payment->currency }} {{ number_format($payment->amount, 2) }}
                </td>
                <td class="px-4 py-3 text-sm">
                    <span class="text-xs font-mono">{{ $payment->transaction_id ?? $payment->merchant_txnid ?? 'N/A' }}</span>
                </td>
                <td class="px-4 py-3">
                    {{ ucfirst($payment->payment_method) }}
                </td>
                <td class="px-4 py-3">
                    @if($payment->status == 'completed')
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">{{ ucfirst($payment->status) }}</span>
                    @elseif($payment->status == 'failed')
                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">{{ ucfirst($payment->status) }}</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">{{ ucfirst($payment->status) }}</span>
                    @endif
                </td>
                <td class="px-4 py-3 text-sm text-center">
                    <div class="flex space-x-2">
                        <a href="{{route('member.edit', $payment->user->id)}}" class="text-blue-500 hover:text-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>
          @endif
        @empty
          <tr>
            <td colspan="9" class="px-4 py-6 text-center text-gray-500">No payment records found</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Original Subscriptions Table -->
  <div class="p-6 bg-white shadow mt-4 overflow-x-auto">
    <h2 class="text-lg font-semibold mb-4">Subscription Records</h2>
    <table class="min-w-full border-collapse border border-gray-200 text-left text-sm">
      <thead>
          <tr class="bg-gray-100">
              <th class="px-4 py-3 font-medium text-gray-600">Name and Membership</th>
              <th class="px-4 py-3 font-medium text-gray-600">Designation</th>
              <th class="px-4 py-3 font-medium text-gray-600">Organization</th>
              <th class="px-4 py-3 font-medium text-gray-600">Phone</th>
              <th class="px-4 py-3 font-medium text-gray-600">Email</th>
              <th class="px-4 py-3 font-medium text-gray-600">Joining Date</th>
              <th class="px-4 py-3 font-medium text-gray-600">Renewed</th>
              <th class="px-4 py-3 font-medium text-gray-600">Subscription</th>
              <th class="px-4 py-3 font-medium text-gray-600">Requested</th>
              <th class="px-4 py-3 font-medium text-gray-600">Status</th>
          </tr>
      </thead>
      <tbody>
        
          @foreach ($subscriptions as $subscription)
            @if ($subscription->user->id!==auth()->user()->id && !$subscription->user->isFree())
              <tr class="border-t">
                  <td class="px-4 py-3">
                      <div class="flex items-center space-x-4">
                          <img src="{{ $subscription->user->getProfilePhotoUrl() }}" alt="Profile" class="rounded-full w-10 h-10">
                          <div>
                              <p class="font-medium">{{ $subscription->user->name }}</p>
                              <p class="text-sm text-gray-500">{{ $subscription->user->role == 'investor' ? 'BAN Individual Member' : ucfirst($subscription->user->role) }}</p>
                          </div>
                      </div>
                  </td>
                  <td class="px-4 py-3">{{ $subscription->user->designation ?? '-' }}</td>
                  <td class="px-4 py-3">{{ $subscription->user->company_name ?? '-' }}</td>
                  <td class="px-4 py-3">{{ $subscription->user->phone ?? '-' }}</td>
                  <td class="px-4 py-3 text-sm text-gray-600">{{ $subscription->user->email }}</td>
                  <td class="px-4 py-3 text-sm text-gray-600">
                      {{ $subscription->user->joinedAt() }}
                  </td>
                  <td class="px-4 py-3 text-sm text-gray-600">
                      {{ $subscription->user->renewedAt() }}
                  </td>
                  <td class="px-4 py-3 text-sm text-gray-600">
                    {{ ucfirst($subscription->user->status()) }}
                  </td>
                  <td class="px-4 py-3 text-sm text-gray-600">
                    {{ ucfirst($subscription->plan) . " Tier" }}
                  </td>
                  <td class="px-4 py-3">
                    <form id="status-form-{{ $subscription->user->id }}" method="POST" action="{{route('update.account.status',$subscription->user->id)}}">
                      @csrf
                      @method('PATCH')
                      <input type="hidden" name="user_id" value="{{$subscription->user->id}}">
                      <input type="hidden" name="account_status" id="account_status-{{ $subscription->user->id }}">
                      <label class="relative inline-flex cursor-pointer items-center">
                          <input 
                              type="checkbox" 
                              class="peer sr-only" 
                              onchange="submitStatusForm(this, {{ $subscription->user->id }})"
                              {{ $subscription->user->account_status !== 'free' ? 'checked' : '' }}
                          />
                          <div class="peer h-6 w-11 rounded-full border bg-slate-200 after:absolute after:left-[2px] after:top-0.5 after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-slate-800 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:ring-green-300"></div>
                      </label>
                    </form>
                  </td>
              </tr>
            @endif
          @endforeach
      </tbody>
    </table>
  </div>

  <script>
    function submitStatusForm(checkbox, userId) {
      const form = document.getElementById('status-form-' + userId);
      const accountStatusInput = document.getElementById('account_status-' + userId);

      if (checkbox.checked) {
          accountStatusInput.value = 'core'; // Set the status when the switch is ON
      } else {
          accountStatusInput.value = 'free'; // Set the status when the switch is OFF
      }

      form.submit(); // Submit the form
    }

    function filterTable() {
      const planFilter = document.getElementById('planFilter').value;
      const searchInput = document.getElementById('searchInput').value.toLowerCase();
      const table = document.getElementById('subscriptionTable');
      const rows = table.getElementsByTagName('tr');

      for (let i = 1; i < rows.length; i++) { // Start at 1 to skip header row
        const row = rows[i];
        const planCell = row.querySelector('.plan-value');
        
        if (!planCell) continue; // Skip if no plan cell found (empty row)
        
        const planText = planCell.textContent.toLowerCase();
        const rowText = row.textContent.toLowerCase();
        
        const planMatch = planFilter === 'all' || planText.includes(planFilter);
        const searchMatch = rowText.includes(searchInput);
        
        if (planMatch && searchMatch) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      }
    }
  </script>
@endsection