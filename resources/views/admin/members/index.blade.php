@extends('layouts.admin')
@section('page_title','Members | Dashboard')
@section('page_content')
<!-- Header Section -->
<header class="flex justify-between items-center p-6 bg-white shadow">
    <h1 class="text-xl font-bold">Members ({{count($users)}})</h1>
    <a href="{{route('member.add')}}" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">
      + Add New Member
    </a>
  </header>

  <!-- Filters and Search -->
  <div class="p-6 bg-white shadow mt-4">
    <div class="flex flex-wrap items-center justify-between">
      <!-- Tabs -->
      <div class="flex space-x-4 mb-4 sm:mb-0">
        <button class="px-4 py-2 bg-green-100 text-green-700 font-semibold rounded-lg">All</button>
        <button class="px-4 py-2 text-gray-500 hover:text-green-700">Active</button>
        <button class="px-4 py-2 text-gray-500 hover:text-green-700">Inactive</button>
      </div>

      <!-- Role Filter and Search -->
      <div class="flex items-center space-x-4">
        <select class="border-gray-300 rounded-lg shadow-sm text-gray-600">
          <option>Role</option>
          <option>Admin</option>
          <option>Investor</option>
          <option>Seeker</option>
        </select>
        <input type="text" placeholder="Search..." class="border-gray-300 rounded-lg shadow-sm px-4 py-2">
      </div>
    </div>
  </div>

  <!-- Members Table -->
  <div class="p-6 bg-white shadow mt-4 overflow-x-auto">
    <table class="min-w-full border-collapse border border-gray-200 text-left text-sm">
      <thead>
          <tr class="bg-gray-100">
              <th class="px-6 py-4 font-medium text-gray-600">Name and Membership</th>
              <th class="px-6 py-4 font-medium text-gray-600">Strategic Investment Analyst</th>
              <th class="px-6 py-4 font-medium text-gray-600">Designation</th>
              <th class="px-6 py-4 font-medium text-gray-600">Organization</th>
              <th class="px-6 py-4 font-medium text-gray-600">Phone/WhatsApp</th>
              <th class="px-6 py-4 font-medium text-gray-600">Email</th>
              <th class="px-6 py-4 font-medium text-gray-600">Joining Date</th>
              <th class="px-6 py-4 font-medium text-gray-600">Renewed</th>
              <th class="px-6 py-4 font-medium text-gray-600">Subscription</th>
              <th class="px-6 py-4 font-medium text-gray-600">Payment Status</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($users as $user)
          <tr class="border-t">
              <td class="px-6 py-4">
                  <div class="flex items-center space-x-4">
                      <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://via.placeholder.com/40' }}" alt="Profile" class="rounded-full w-10 h-10">
                      <div>
                          <p class="font-medium">{{ $user->name }}</p>
                          <p class="text-sm text-gray-500">{{ $user->role == 'investor' ? 'BAN Individual Member' : ucfirst($user->role) }}</p>
                      </div>
                  </div>
              </td>
              <td class="px-6 py-4 text-center">
                  @if ($user->strategic_investment_analyst)
                  <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-full text-xs">{{ $user->strategic_investment_analyst }}</span>
                  @else
                  <span class="text-gray-400 text-xs">-</span>
                  @endif
              </td>
              <td class="px-6 py-4">{{ $user->designation ?? '-' }}</td>
              <td class="px-6 py-4">{{ $user->company_name ?? '-' }}</td>
              <td class="px-6 py-4">{{ $user->phone ?? '-' }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">
                  {{ $user->created_at ? $user->created_at->format('Y Q') : '-' }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-600">
                  {{ $user->updated_at ? $user->updated_at->format('Y Q') : '-' }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-600">
                {{ ucfirst($user->status()) }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-600">
                {{ ucfirst($user->paymentStatus()) }}
              </td>
          </tr>
          @endforeach
      </tbody>
  </table>
  

    <!-- Pagination -->
    <div class="flex justify-between items-center mt-4">
      <p class="text-sm text-gray-600">Rows per page:</p>
      <select class="border-gray-300 rounded-lg text-sm">
        <option>5</option>
        <option>10</option>
        <option>20</option>
      </select>
      <p class="text-sm text-gray-600">6-10 of 11</p>
      <div class="flex space-x-2">
        <button class="px-2 py-1 text-gray-500 hover:text-green-600">&larr;</button>
        <button class="px-2 py-1 text-gray-500 hover:text-green-600">&rarr;</button>
      </div>
    </div>
  </div>
@endsection