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
        <a href="{{route('admin.members')}}" class="px-4 py-2 text-gray-500 hover:text-green-700">All</a>
        <a href="{{route('admin.active.members')}}" class="px-4 py-2 text-gray-500 hover:text-green-700">Active</a>
        <a href="{{route('admin.inactive.members')}}" class="px-4 py-2 bg-green-100 text-green-700 font-semibold rounded-lg">Inactive</a>

      </div>

      <!-- Role Filter and Search -->
      <div class="flex items-center space-x-4">
        <select class="border-gray-300 rounded-lg shadow-sm text-gray-600">
          <option>Role</option>
          <option>Admin</option>
          <option>Investor</option>
        </select>
        <input type="text" placeholder="Search..." class="border-gray-300 rounded-lg shadow-sm px-4 py-2">
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

  <!-- Members Table -->
  <div class="p-6 bg-white shadow mt-4 overflow-x-auto">
    <table class="min-w-full border-collapse border border-gray-200 text-left text-sm">
      <thead>
          <tr class="bg-gray-100">
              <th class="px-6 py-4 font-medium text-gray-600">Name and Membership</th>
              <th class="px-6 py-4 font-medium text-gray-600">Designation</th>
              <th class="px-6 py-4 font-medium text-gray-600">Organization</th>
              <th class="px-6 py-4 font-medium text-gray-600">Phone/WhatsApp</th>
              <th class="px-6 py-4 font-medium text-gray-600">Email</th>
              <th class="px-6 py-4 font-medium text-gray-600">Joining Date</th>
              <th class="px-6 py-4 font-medium text-gray-600">Renewed</th>
              <th class="px-6 py-4 font-medium text-gray-600">Subscription</th>
              <th class="px-6 py-4 font-medium text-gray-600">Payment Status</th>
              <th class="px-6 py-4 font-medium text-gray-600">Edit</th>
              <th class="px-6 py-4 font-medium text-gray-600">Status</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($users as $user)
          @if ($user->id!==auth()->user()->id)
            <tr class="border-t">
              <td class="px-6 py-4">
                  <div class="flex items-center space-x-4">
                      <img src="{{ $user->getProfilePhotoUrl() }}" alt="Profile" class="rounded-full w-10 h-10">
                      <div>
                          <p class="font-medium">{{ $user->name }}</p>
                          <p class="text-sm text-gray-500">{{ $user->role == 'investor' ? 'BAN Individual Member' : ucfirst($user->role) }}</p>
                      </div>
                  </div>
              </td>
              <td class="px-6 py-4">{{ $user->designation ?? '-' }}</td>
              <td class="px-6 py-4">{{ $user->company_name ?? '-' }}</td>
              <td class="px-6 py-4">{{ $user->phone ?? '-' }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">
                  {{ $user->joinedAt() }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-600">
                  {{ $user->renewedAt() }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-600">
                {{ ucfirst($user->status()) }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-600">
                {{ ucfirst($user->paymentStatus()) }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-600 text-center">
                <a href="{{route('member.edit',$user->id)}}">
                  <svg class="h-[25px]" fill="#999" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 117.74 122.88" style="enable-background:new 0 0 117.74 122.88" xml:space="preserve"><style type="text/css">.st0{fill-rule:evenodd;clip-rule:evenodd;}</style><g><path class="st0" d="M94.62,2c-1.46-1.36-3.14-2.09-5.02-1.99c-1.88,0-3.56,0.73-4.92,2.2L73.59,13.72l31.07,30.03l11.19-11.72 c1.36-1.36,1.88-3.14,1.88-5.02s-0.73-3.66-2.09-4.92L94.62,2L94.62,2L94.62,2z M41.44,109.58c-4.08,1.36-8.26,2.62-12.35,3.98 c-4.08,1.36-8.16,2.72-12.35,4.08c-9.73,3.14-15.07,4.92-16.22,5.23c-1.15,0.31-0.42-4.18,1.99-13.6l7.74-29.61l0.64-0.66 l30.56,30.56L41.44,109.58L41.44,109.58L41.44,109.58z M22.2,67.25l42.99-44.82l31.07,29.92L52.75,97.8L22.2,67.25L22.2,67.25z"/></g></svg>
                </a>
              </td>
              <td>
                
              <form id="status-form" method="POST" action="{{route('update.account.status',$user->id)}}">
                  @csrf
                  @method('PATCH')
                  <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                  <input type="hidden" name="account_status" id="account_status">
                  <label class="relative inline-flex cursor-pointer items-center">
                      <input 
                          id="switch" 
                          type="checkbox" 
                          class="peer sr-only" 
                          onchange="submitStatusForm(this)"
                          {{ $user->account_status !== 'free' ? 'checked' : '' }}
                      />
                      <div class="peer h-6 w-11 rounded-full border bg-slate-200 after:absolute after:left-[2px] after:top-0.5 after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-slate-800 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:ring-green-300"></div>
                  </label>
              </form>
              <script>
                function submitStatusForm(checkbox) {
                const form = document.getElementById('status-form');
                const accountStatusInput = document.getElementById('account_status');

                if (checkbox.checked) {
                    accountStatusInput.value = 'core'; // Set the status when the switch is ON
                } else {
                    accountStatusInput.value = 'free'; // Set the status when the switch is OFF
                }

                form.submit(); // Submit the form
            }

              </script>
              
              </td>
          </tr>
          @endif
          
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