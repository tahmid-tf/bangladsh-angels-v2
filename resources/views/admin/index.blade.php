@extends('layouts.admin')
@section('page_title','Dashboard')
@section('page_content')
<!-- Overview Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
   
  </div>

  <!-- Charts & Member Status -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
    <!-- Pie Chart -->
    <div class="p-4 bg-white rounded-lg shadow">
      <h2 class="text-lg font-bold mb-4">Member Sign Ups</h2>
      <div class="flex justify-center">
        <canvas id="memberChart" width="400" height="200"></canvas>
        <script>
          // Data passed from the controller
          const dates = {!! json_encode($dates) !!};
          const counts = {!! json_encode($counts) !!};
      
          // Initialize the Chart.js chart
          const ctx = document.getElementById('memberChart').getContext('2d');
          new Chart(ctx, {
              type: 'line', // Use 'bar', 'pie', etc., for different chart types
              data: {
                  labels: dates,
                  datasets: [{
                      label: 'Member Registrations',
                      data: counts,
                      backgroundColor: 'rgba(75, 192, 192, 0.2)',
                      borderColor: 'rgba(75, 192, 192, 1)',
                      borderWidth: 1
                  }]
              },
              options: {
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

    <!-- Line Chart -->
    <div class="p-4 bg-white rounded-lg shadow">
      <h2 class="text-lg font-bold mb-4">Subscriptions</h2>
      <div class="flex justify-center">
        <canvas id="subscriptionChart" width="400" height="200"></canvas>
        <script>
          // Data passed from the controller
          const subDates = {!! json_encode($subscriptionDates) !!};
          const subCounts = {!! json_encode($subsCounts) !!};
      
          // Initialize the Chart.js chart
          const ctx2 = document.getElementById('subscriptionChart').getContext('2d');
          new Chart(ctx2, {
              type: 'bar', // Use 'bar', 'pie', etc., for different chart types
              data: {
                  labels: subDates,
                  datasets: [{
                      label: 'Number of Members who subscribed',
                      data: subCounts,
                      backgroundColor: 'rgba(75, 192, 192, 0.2)',
                      borderColor: 'rgba(75, 192, 192, 1)',
                      borderWidth: 1
                  }]
              },
              options: {
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
    <!-- Line Chart -->
    <div class="p-4 bg-white rounded-lg shadow">
      <h2 class="text-lg font-bold mb-4">Deals Added</h2>
      <div class="flex justify-center">
        <canvas id="dealChart" width="400" height="200"></canvas>
        <script>
  // Data passed from the controller
          const dealDates = {!! json_encode($dealDates) !!};
          const dealCounts = {!! json_encode($dCounts) !!};
          // Initialize the Chart.js chart
          
          const ctx3 = document.getElementById('dealChart').getContext('2d');

          new Chart(ctx3, {
              type: 'bar', // Use 'bar', 'pie', etc., for different chart types
              data: {
                  labels: dealDates,
                  datasets: [{
                      label: 'Number of Deals that have been added',
                      data: dealCounts,
                      backgroundColor: 'rgba(75, 192, 192, 0.2)',
                      borderColor: 'rgba(75, 192, 192, 1)',
                      borderWidth: 1
                  }]
              },
              options: {
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

@endsection