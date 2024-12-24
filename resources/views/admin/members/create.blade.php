@extends('layouts.admin')
@section('page_title','Add a new member | Bangladesh Angels Network')
@section('page_content')
<!-- Header -->
<form id="add-member-form" class="bg-white p-6 rounded-lg shadow space-y-6" method="POST" action="{{route('member.create')}}" enctype="multipart/form-data">

<header class="flex justify-between items-center mb-6">
    <div>
      <h1 class="text-2xl font-bold">Add New Member</h1>
      <p class="text-gray-500">Dashboard > Members > Add new member</p>
    </div>
    <div class="flex space-x-4">
      <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg shadow">Save as Draft</button>
      <button type="submit" id="add-member-btn" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">Add Member</button>
    </div>
  </header>

  <!-- Validation Errors -->
  @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Form -->
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Left: Upload Photo and Active Status -->
      <div class="space-y-6">
        <div class="text-center border-dashed border-2 border-gray-300 rounded-lg p-6">
          <label class="block cursor-pointer">
            <div class="mb-4">
              <img src="https://via.placeholder.com/150" alt="Upload Placeholder" class="mx-auto rounded-full h-24 w-24">
            </div>
            <input type="file" name="photo" accept="image/*" class="hidden">
            <p class="text-gray-500 text-sm">Upload photo</p>
            <p class="text-gray-400 text-xs">Allowed: *.jpeg, *.png, *.gif (Max: 3.1 MB)</p>
          </label>
        </div>

        <div class="flex items-center space-x-2">
          <span class="text-sm text-gray-600">Active Status</span>
          <input type="checkbox" name="active_status" class="toggle-input" {{ old('active_status', true) ? 'checked' : '' }}>
        </div>
      </div>

      <!-- Middle: General Information -->
      <div class="space-y-4 lg:col-span-2">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <input type="text" name="full_name" placeholder="Full Name" class="border border-gray-300 p-2 rounded w-full" value="{{ old('full_name') }}" required>
          <input type="email" name="email" placeholder="Email Address" class="border border-gray-300 p-2 rounded w-full" value="{{ old('email') }}" required>
          <input type="text" name="phone" placeholder="Phone Number / WhatsApp" class="border border-gray-300 p-2 rounded w-full" value="{{ old('phone') }}" required>
          <select name="gender" class="border border-gray-300 p-2 rounded w-full" required>
            <option value="">Gender</option>
            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
          </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <input type="text" name="organization" placeholder="Organization" class="border border-gray-300 p-2 rounded w-full" value="{{ old('organization') }}">
          <input type="text" name="designation" placeholder="Designation" class="border border-gray-300 p-2 rounded w-full" value="{{ old('designation') }}">
          <input type="date" name="joining_date" placeholder="Joining Date" class="border border-gray-300 p-2 rounded w-full" value="{{ old('joining_date') }}" required>
          <input type="text" name="renewed" placeholder="Renewed" class="border border-gray-300 p-2 rounded w-full" value="{{ old('renewed') }}">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <input type="text" name="country" placeholder="Country" class="border border-gray-300 p-2 rounded w-full" value="{{ old('country') }}" required>
          <input type="text" name="preference_sector" placeholder="Preference Sector" class="border border-gray-300 p-2 rounded w-full" value="{{ old('preference_sector') }}">
          <select name="strategic_analyst" class="border border-gray-300 p-2 rounded w-full">
            <option value="">Strategic Investment Analyst</option>
            <option value="TL" {{ old('strategic_analyst') == 'TL' ? 'selected' : '' }}>TL</option>
            <option value="FS" {{ old('strategic_analyst') == 'FS' ? 'selected' : '' }}>FS</option>
            <option value="TB" {{ old('strategic_analyst') == 'TB' ? 'selected' : '' }}>TB</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Investment Portfolio -->
    <div>
      <h2 class="text-lg font-bold mb-4">Investment Portfolio</h2>
      <div id="portfolio-container" class="space-y-4">
        @if (old('company_name'))
          @foreach (old('company_name') as $index => $company_name)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <input type="text" name="company_name[]" placeholder="Enter Company Name" class="border border-gray-300 p-2 rounded w-full" value="{{ $company_name }}">
              <input type="number" name="investment_amount[]" placeholder="Enter Amount" class="border border-gray-300 p-2 rounded w-full" value="{{ old('investment_amount.' . $index) }}">
            </div>
          @endforeach
        @else
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="company_name[]" placeholder="Enter Company Name" class="border border-gray-300 p-2 rounded w-full">
            <input type="number" name="investment_amount[]" placeholder="Enter Amount" class="border border-gray-300 p-2 rounded w-full">
          </div>
        @endif
      </div>
      <button id="add-company-btn" type="button" class="mt-4 px-4 py-2 bg-green-100 text-green-700 rounded-lg">+ Add Another Company</button>
    </div>
  </form>
  <script>
    // Add another company
    document.getElementById('add-company-btn').addEventListener('click', () => {
      const container = document.getElementById('portfolio-container');
      const newField = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <input type="text" name="company_name[]" placeholder="Enter Company Name" class="border border-gray-300 p-2 rounded w-full">
          <input type="number" name="investment_amount[]" placeholder="Enter Amount" class="border border-gray-300 p-2 rounded w-full">
        </div>
      `;
      container.insertAdjacentHTML('beforeend', newField);
    });
  </script>
@endsection