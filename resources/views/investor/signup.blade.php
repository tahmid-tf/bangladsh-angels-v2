@extends('layouts.guest')
@section('page_title','Sign up as an Investor')
@section('page_content')
<section class="bg-[#0a5554] py-12 text-white">
    <!-- Hero Section -->
    <div class="container mx-auto px-6 lg:flex lg:items-center lg:space-x-12">
        <!-- Text Content -->
        <div class="lg:w-1/2">
            <h1 class="text-4xl font-extrabold mb-4">Become an Angel investor</h1>
            <p class="text-lg leading-relaxed">
                Join a Global network of over 450 executives and operators who have built and expanded companies all over the world.
            </p>
        </div>

        <!-- Image Placeholder -->
        <div class="lg:w-1/2 mt-6 lg:mt-0">
            <img src="{{asset('investor_cover.webp')}}" alt="Investors" class="w-full h-auto rounded-lg">
        </div>
    </div>
</section>

<!-- Investor Application Form -->
<section class="container mx-auto px-6 py-12 bg-white rounded-lg shadow-lg mt-8">
    <h2 class="text-2xl font-bold mb-8">Investor Application</h2>
    <!-- Error Message Section -->
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{route('member.apply')}}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Full Name -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="full_name">Let's start with an easy one, what is your name? *</label>
                <input type="text" id="full_name" name="full_name" placeholder="Full Name" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="{{ old('full_name') }}" required>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="email">Can you enter an email where we can contact you? *</label>
                <input type="email" id="email" name="email" placeholder="Email" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="{{ old('email') }}" required>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="password">Let's input a password now. *</label>
                <input type="password" id="password" name="password" placeholder="Enter a password for logging into the platform" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
            </div>

            <!-- Re-enter Password -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="re_password">Can you re-enter the password? *</label>
                <input type="password" id="re_password" name="password_confirmation" placeholder="Re-enter password" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
            </div>

            <!-- Company Name -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="company_name">And what is the name of your company? *</label>
                <input type="text" id="company_name" name="company_name" placeholder="Company Name" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="{{ old('company_name') }}" required>
            </div>

            <!-- Designation -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="designation">What is your designation in there? *</label>
                <input type="text" id="designation" name="designation" placeholder="Designation in the company" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="{{ old('designation') }}" required>
            </div>

            <!-- Website Link -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="website">Where can I find more info about your company? *</label>
                <input type="text" id="website" name="website" placeholder="What is the link to your website?" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="{{ old('website') }}" required>
            </div>

            <!-- Primary Country -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="primary_country">What is the primary country you are in business? *</label>
                <select id="primary_country" name="primary_country" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
                    <option value="">Select Primary Country</option>
                    <option value="Bangladesh" {{ old('primary_country') == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                    <option value="India" {{ old('primary_country') == 'India' ? 'selected' : '' }}>India</option>
                    <option value="USA" {{ old('primary_country') == 'USA' ? 'selected' : '' }}>USA</option>
                </select>
            </div>

            <!-- Phone Number -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="phone">Phone Number *</label>
                <input type="text" id="phone" name="phone" placeholder="Phone Number / WhatsApp" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="{{ old('phone') }}" required>
            </div>

            <!-- Gender -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="gender">Gender *</label>
                <select id="gender" name="gender" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Secondary Countries -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="secondary_countries">In which other countries are you currently active?</label>
                <input type="text" id="secondary_countries" name="secondary_countries" placeholder="Add Secondary Countries" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="{{ old('secondary_countries') }}">
            </div>

            <!-- LinkedIn -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="linkedin">LinkedIn *</label>
                <input type="text" id="linkedin" name="linkedin" placeholder="Please add the link to your LinkedIn profile" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="{{ old('linkedin') }}" required>
            </div>

            <!-- Investment Expertise -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="investment_expertise">What is your level of investment expertise? *</label>
                <select id="investment_expertise" name="investment_expertise" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
                    <option value="">Select level of investment expertise</option>
                    <option value="beginner" {{ old('investment_expertise') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="intermediate" {{ old('investment_expertise') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="expert" {{ old('investment_expertise') == 'expert' ? 'selected' : '' }}>Expert</option>
                </select>
            </div>

            <!-- Strategic Investment Analyst -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="strategic_analyst">Strategic Investment Analyst</label>
                <select id="strategic_analyst" name="strategic_analyst" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                    <option value="">Select Analyst</option>
                    <option value="TL" {{ old('strategic_analyst') == 'TL' ? 'selected' : '' }}>TL</option>
                    <option value="FS" {{ old('strategic_analyst') == 'FS' ? 'selected' : '' }}>FS</option>
                    <option value="TB" {{ old('strategic_analyst') == 'TB' ? 'selected' : '' }}>TB</option>
                </select>
            </div>

            <!-- Photo Upload -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="photo">Upload Your Photo</label>
                <input type="file" id="photo" name="profile_photo" accept="image/*" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
            </div>
        </div>

        <!-- Agreement and Newsletter -->
        <div class="mt-6">
            <label class="flex items-center space-x-2">
                <input type="checkbox" class="rounded border-gray-300 text-green-500 focus:ring-green-400" name="terms" required>
                <span class="text-gray-700">I agree to the <a href="#" class="text-green-500 underline">terms and conditions</a> and <a href="#" class="text-green-500 underline">privacy policy</a>.</span>
            </label>
            <label class="flex items-center space-x-2 mt-2">
                <input type="checkbox" class="rounded border-gray-300 text-green-500 focus:ring-green-400" name="newsletter">
                <span class="text-gray-700">I want to sign up for the newsletter to receive exclusive deals directly in my inbox.</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="mt-8 text-right">
            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition">
                Sign Up
            </button>
        </div>
    </form>
</section>
@endsection