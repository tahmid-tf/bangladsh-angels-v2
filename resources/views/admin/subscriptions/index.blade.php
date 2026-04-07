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

  <!-- Membership tiers & pricing -->
  <div class="p-6 bg-white shadow mt-4">
    <h2 class="text-lg font-semibold text-gray-800 mb-1">Membership tiers &amp; pricing</h2>
    <p class="text-sm text-gray-600 mb-4">Active tiers and prices are shown on the public plans page. Slugs stay fixed for payments and member records.</p>

    @if ($errors->has('tiers'))
      <div class="mb-4 text-red-600 text-sm">{{ $errors->first('tiers') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.subscription-tiers.update') }}">
      @csrf
      <div class="space-y-6">
        @foreach ($tiers as $tier)
          <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex flex-wrap items-center gap-2 mb-3">
              <span class="text-xs font-mono bg-gray-100 text-gray-700 px-2 py-1 rounded">slug: {{ $tier->slug }}</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Display name</label>
                <input type="text" name="tiers[{{ $tier->id }}][name]" value="{{ old('tiers.'.$tier->id.'.name', $tier->name) }}"
                  class="w-full border-gray-300 rounded-lg shadow-sm" required maxlength="100">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Yearly price (USD)</label>
                <input type="number" name="tiers[{{ $tier->id }}][price_yearly]" step="0.01" min="0"
                  value="{{ old('tiers.'.$tier->id.'.price_yearly', $tier->price_yearly) }}"
                  class="w-full border-gray-300 rounded-lg shadow-sm" required>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort order</label>
                <input type="number" name="tiers[{{ $tier->id }}][sort_order]" min="0"
                  value="{{ old('tiers.'.$tier->id.'.sort_order', $tier->sort_order) }}"
                  class="w-full border-gray-300 rounded-lg shadow-sm" required>
              </div>
              <div class="flex flex-col gap-3 justify-end">
                <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                  <input type="hidden" name="tiers[{{ $tier->id }}][is_active]" value="0">
                  <input type="checkbox" name="tiers[{{ $tier->id }}][is_active]" value="1"
                    {{ old('tiers.'.$tier->id.'.is_active', $tier->is_active ? '1' : '0') === '1' ? 'checked' : '' }}>
                  Active on plans page
                </label>
                <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                  <input type="hidden" name="tiers[{{ $tier->id }}][is_highlighted]" value="0">
                  <input type="checkbox" name="tiers[{{ $tier->id }}][is_highlighted]" value="1"
                    {{ old('tiers.'.$tier->id.'.is_highlighted', $tier->is_highlighted ? '1' : '0') === '1' ? 'checked' : '' }}>
                  Show &quot;Popular&quot; badge
                </label>
              </div>
            </div>
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Included features (one per line)</label>
                <textarea name="tiers[{{ $tier->id }}][features_included]" rows="6"
                  class="w-full border-gray-300 rounded-lg shadow-sm text-sm font-mono">{{ old('tiers.'.$tier->id.'.features_included', $tier->features_included) }}</textarea>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Excluded features (one per line, shown with ✘)</label>
                <textarea name="tiers[{{ $tier->id }}][features_excluded]" rows="6"
                  class="w-full border-gray-300 rounded-lg shadow-sm text-sm font-mono">{{ old('tiers.'.$tier->id.'.features_excluded', $tier->features_excluded) }}</textarea>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <button type="submit" class="mt-6 bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 shadow">
        Save tiers &amp; prices
      </button>
    </form>
  </div>

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
          @foreach ($tiers->sortBy('sort_order') as $t)
            <option value="{{ $t->slug }}">{{ $t->name }}</option>
          @endforeach
        </select>
        <select id="paymentFilter" onchange="filterTable()" class="border-gray-300 rounded-lg shadow-sm text-gray-600">
          <option value="all">All Statuses</option>
          <option value="paid">Paid</option>
          <option value="unpaid">Unpaid</option>
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

  <!-- Unified Subscriptions Table -->
  <div class="p-6 bg-white shadow mt-4 overflow-x-auto">
    <table id="subscriptionTable" class="min-w-full border-collapse border border-gray-200 text-left text-sm">
      <thead>
          <tr class="bg-gray-100">
              <th class="px-4 py-3 font-medium text-gray-600">Member</th>
              <th class="px-4 py-3 font-medium text-gray-600">Current Plan</th>
              <th class="px-4 py-3 font-medium text-gray-600">Start Date</th>
              <th class="px-4 py-3 font-medium text-gray-600">Expiry Date</th>
              <th class="px-4 py-3 font-medium text-gray-600">Amount</th>
              <th class="px-4 py-3 font-medium text-gray-600">Payment Status</th>
              <th class="px-4 py-3 font-medium text-gray-600">Transaction ID</th>
              <th class="px-4 py-3 font-medium text-gray-600">Payment Method</th>
              <th class="px-4 py-3 font-medium text-gray-600">Actions</th>
          </tr>
      </thead>
      <tbody>
        <!-- Subscriptions with payment records -->
        @forelse($subscriptions as $subscription)
          @if ($subscription->user->id !== auth()->user()->id)
            <tr class="border-t hover:bg-gray-50" data-payment="{{ $subscription->payment_id ? 'paid' : 'unpaid' }}">
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-3">
                        <img src="{{ $subscription->user->getProfilePhotoUrl() }}" alt="Profile" class="rounded-full w-10 h-10">
                        <div>
                            <p class="font-medium">{{ $subscription->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $subscription->user->email }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-3">
                    <span class="plan-value">{{ ucfirst($subscription->plan) }}</span>
                </td>
                <td class="px-4 py-3 text-sm">
                    {{ $subscription->start_date ? \Carbon\Carbon::parse($subscription->start_date)->format('M d, Y') : \Carbon\Carbon::parse($subscription->created_at)->format('M d, Y') }}
                </td>
                <td class="px-4 py-3 text-sm">
                    {{ $subscription->end_date ? \Carbon\Carbon::parse($subscription->end_date)->format('M d, Y') : 'N/A' }}
                </td>
                <td class="px-4 py-3">
                    @if($subscription->payment)
                        {{ $subscription->payment->currency }} {{ number_format($subscription->payment->amount, 2) }}
                    @else
                        ${{ number_format($subscription->price, 2) }}
                    @endif
                </td>
                <td class="px-4 py-3">
                    @if($subscription->payment_id)
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Paid</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Unpaid</span>
                    @endif
                </td>
                <td class="px-4 py-3 text-sm">
                    @if($subscription->payment)
                        <span class="text-xs font-mono">{{ $subscription->payment->transaction_id ?? $subscription->payment->merchant_txnid ?? 'N/A' }}</span>
                    @else
                        <span class="text-gray-400">No payment</span>
                    @endif
                </td>
                <td class="px-4 py-3">
                    @if($subscription->payment)
                        {{ ucfirst($subscription->payment->payment_method) }}
                    @else
                        <span class="text-gray-400">N/A</span>
                    @endif
                </td>
                <td class="px-4 py-3 text-sm text-center">
                    <div class="flex space-x-2">
                        <a href="{{route('member.edit', $subscription->user->id)}}" class="text-blue-500 hover:text-blue-700">
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
            <td colspan="9" class="px-4 py-6 text-center text-gray-500">No subscription records found</td>
          </tr>
        @endforelse
        
        <!-- Users with subscriptions but no subscription record -->
        @foreach($usersWithoutSubscriptions as $user)
          @if($user->id !== auth()->user()->id)
            <tr class="border-t hover:bg-gray-50" data-payment="unpaid">
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-3">
                        <img src="{{ $user->getProfilePhotoUrl() }}" alt="Profile" class="rounded-full w-10 h-10">
                        <div>
                            <p class="font-medium">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-3">
                    <span class="plan-value">{{ ucfirst($user->account_status) }}</span>
                </td>
                <td class="px-4 py-3 text-sm">
                    {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('M d, Y') : 'N/A' }}
                </td>
                <td class="px-4 py-3 text-sm">
                    N/A
                </td>
                <td class="px-4 py-3">
                    N/A
                </td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Unpaid</span>
                </td>
                <td class="px-4 py-3 text-sm">
                    <span class="text-gray-400">No payment</span>
                </td>
                <td class="px-4 py-3">
                    <span class="text-gray-400">N/A</span>
                </td>
                <td class="px-4 py-3 text-sm text-center">
                    <div class="flex space-x-2">
                        <a href="{{route('member.edit', $user->id)}}" class="text-blue-500 hover:text-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>
  </div>

  <script>
    function filterTable() {
      const planFilter = document.getElementById('planFilter').value;
      const paymentFilter = document.getElementById('paymentFilter').value;
      const searchInput = document.getElementById('searchInput').value.toLowerCase();
      const table = document.getElementById('subscriptionTable');
      const rows = table.getElementsByTagName('tr');

      for (let i = 1; i < rows.length; i++) { // Start at 1 to skip header row
        const row = rows[i];
        const planCell = row.querySelector('.plan-value');
        
        if (!planCell) continue; // Skip if no plan cell found (empty row)
        
        const planText = planCell.textContent.toLowerCase();
        const rowText = row.textContent.toLowerCase();
        const paymentStatus = row.getAttribute('data-payment');
        
        const planMatch = planFilter === 'all' || planText.includes(planFilter);
        const paymentMatch = paymentFilter === 'all' || paymentFilter === paymentStatus;
        const searchMatch = rowText.includes(searchInput);
        
        if (planMatch && paymentMatch && searchMatch) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      }
    }
  </script>
@endsection