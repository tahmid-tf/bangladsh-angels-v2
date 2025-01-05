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

@endsection