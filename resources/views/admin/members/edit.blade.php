@extends('layouts.admin')
@section('page_title', 'Edit Member | Bangladesh Angels Network')
@section('page_content')
<form id="edit-member-form" class="bg-white p-6 rounded-lg shadow space-y-6" method="POST" action="{{route('member.update',$user->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Use PUT for updating the user -->

    <header class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Edit Member</h1>
            <p class="text-gray-500">Dashboard > Members > Edit</p>
        </div>
        <div class="flex space-x-4">
            <a href="{{ route('member.remove', $user->id) }}" onclick="return confirm('Are you sure you want to remove this member?');"
                class="text-red-500 hover:underline">Delete</a>
            <button type="submit" id="edit-member-btn" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">Save Changes</button>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left: Upload Photo and Active Status -->
        <div class="space-y-6">
            <div class="text-center border-dashed border-2 border-gray-300 rounded-lg p-6">
                <label class="block cursor-pointer">
                    <div class="mb-4">
                        <img src="{{ $user->getProfilePhotoUrl() }}" alt="Profile Photo" class="mx-auto rounded-full h-24 w-24">
                    </div>
                    <input type="file" name="profile_photo" accept="image/*" class="hidden">
                    <p class="text-gray-500 text-sm">Upload new photo</p>
                    <p class="text-gray-400 text-xs">Allowed: *.jpeg, *.png, *.gif (Max: 3.1 MB)</p>
                </label>
            </div>

            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">Active Status</span>
                <input type="checkbox" name="active_status" class="toggle-input" {{ $user->active_status ? 'checked' : '' }}>
            </div>
        </div>

        <!-- Middle: General Information -->
        <div class="space-y-4 lg:col-span-2">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="full_name" placeholder="Full Name" class="border border-gray-300 p-2 rounded w-full" value="{{ old('full_name', $user->name) }}" required>
                <input type="email" name="email" placeholder="Email Address" class="border border-gray-300 p-2 rounded w-full" value="{{ old('email', $user->email) }}" required>
                <input type="text" name="phone" placeholder="Phone Number / WhatsApp" class="border border-gray-300 p-2 rounded w-full" value="{{ old('phone', $user->phone) }}" required>
                <select name="gender" class="border border-gray-300 p-2 rounded w-full" required>
                    <option value="">Gender</option>
                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="organization" placeholder="Organization" class="border border-gray-300 p-2 rounded w-full" value="{{ old('organization', $user->company_name) }}">
                <input type="text" name="designation" placeholder="Designation" class="border border-gray-300 p-2 rounded w-full" value="{{ old('designation', $user->designation) }}">
                <input type="date" name="joining_date" placeholder="Joining Date" class="border border-gray-300 p-2 rounded w-full" value="{{ old('joining_date', $user->joining_date) }}" required>
                <input type="text" name="renewed" placeholder="Renewed" class="border border-gray-300 p-2 rounded w-full" value="{{ old('renewed', $user->renewed) }}">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="country" placeholder="Country" class="border border-gray-300 p-2 rounded w-full" value="{{ old('country', $user->country) }}" required>
                <input type="text" name="preference_sector" placeholder="Preference Sector" class="border border-gray-300 p-2 rounded w-full" value="{{ old('preference_sector', $user->preference_sector) }}">
                <select name="strategic_analyst" class="border border-gray-300 p-2 rounded w-full">
                    <option value="">Strategic Investment Analyst</option>
                    <option value="TL" {{ old('strategic_analyst', $user->strategic_analyst) == 'TL' ? 'selected' : '' }}>TL</option>
                    <option value="FS" {{ old('strategic_analyst', $user->strategic_analyst) == 'FS' ? 'selected' : '' }}>FS</option>
                    <option value="TB" {{ old('strategic_analyst', $user->strategic_analyst) == 'TB' ? 'selected' : '' }}>TB</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Investment Portfolio -->
    <div>
        <h2 class="text-lg font-bold mb-4">Investment Portfolio</h2>
        <div id="portfolio-container" class="space-y-4">
            @if ($user->portfolio && $user->portfolio->isNotEmpty())
                @foreach ($user->portfolio as $investment)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="company_name[]" placeholder="Enter Company Name" class="border border-gray-300 p-2 rounded w-full" value="{{ $investment->company_name }}">
                        <input type="number" name="investment_amount[]" placeholder="Enter Amount" class="border border-gray-300 p-2 rounded w-full" value="{{ $investment->investment_amount }}">
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
