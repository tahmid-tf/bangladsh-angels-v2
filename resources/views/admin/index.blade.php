@extends('layouts.admin')
@section('page_title','Dashboard')
@section('page_content')
<!-- Overview Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <a href="{{route('admin.members')}}">
      <div class="p-4 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold">{{ count($users) }}</h2>
        <p class="text-gray-500">Member Count</p>
      </div>
    </a>
    <a href="{{route('admin.deals')}}">
      <div class="p-4 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold">{{ count($deals)}}</h2>
        <p class="text-gray-500">Active Deals</p>
      </div>
    </a>
    
    <div class="p-4 bg-white rounded-lg shadow">
      <h2 class="text-xl font-bold">28,471</h2>
      <p class="text-gray-500">Total Portfolio Companies</p>
    </div>
  </div>

  <!-- Charts & Member Status -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Pie Chart -->
    <div class="p-4 bg-white rounded-lg shadow">
      <h2 class="text-lg font-bold mb-4">Current Member Status</h2>
      <div class="flex justify-center">
        <img src="https://via.placeholder.com/150" alt="Pie Chart" class="w-full max-w-xs">
      </div>
    </div>

    <!-- Line Chart -->
    <div class="p-4 bg-white rounded-lg shadow">
      <h2 class="text-lg font-bold mb-4">Payment Analytics</h2>
      <div>
        <img src="https://via.placeholder.com/300x150" alt="Line Chart" class="w-full">
      </div>
    </div>
  </div>

  <!-- Member Management -->
  <section>
    <h2 class="text-lg font-bold mb-4">Member Status</h2>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="min-w-full text-left text-sm">
        <thead>
          <tr>
            <th class="px-4 py-2">Member</th>
            <th class="px-4 py-2">Portfolio Count</th>
            <th class="px-4 py-2">Total Investment</th>
            <th class="px-4 py-2">Subscription</th>
            <th class="px-4 py-2">Country</th>
            <th class="px-4 py-2">Payment Status</th>
            <th class="px-4 py-2">Active</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="px-4 py-2">Bill Sanders</td>
            <td class="px-4 py-2">738</td>
            <td class="px-4 py-2">$1,242,093</td>
            <td class="px-4 py-2">Advanced</td>
            <td class="px-4 py-2">🇩🇪</td>
            <td class="px-4 py-2">Paid</td>
            <td class="px-4 py-2"><input type="checkbox" checked></td>
          </tr>
          <tr>
            <td class="px-4 py-2">Tanya Hill</td>
            <td class="px-4 py-2">196</td>
            <td class="px-4 py-2">$1,152,016</td>
            <td class="px-4 py-2">Institutional</td>
            <td class="px-4 py-2">🇬🇧</td>
            <td class="px-4 py-2">Overdue</td>
            <td class="px-4 py-2"><input type="checkbox"></td>
          </tr>
          <!-- Add more rows as needed -->
        </tbody>
      </table>
    </div>
  </section>

  <!-- Deals Management -->
  <section>
    <h2 class="text-lg font-bold mb-4">Deals Management</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <!-- Deal Card -->
      <div class="p-4 bg-white rounded-lg shadow">
        <h3 class="font-bold text-lg">Jatri</h3>
        <p class="text-gray-500 text-sm">Investment Stage: Pre Seed</p>
        <p class="text-gray-500 text-sm">Amount Seeking: ৳9,80,000</p>
        <button class="bg-green-600 text-white px-4 py-2 mt-4 rounded-full">Follow</button>
      </div>
      <!-- Repeat for more cards -->
    </div>
  </section>
@endsection