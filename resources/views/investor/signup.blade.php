@extends('layouts.guest')
@section('page_title','Sign up as an Investor')
@section('page_content')
<section class="bg-green-700 py-12 text-white">
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
            <img src="https://via.placeholder.com/500x250" alt="Investors" class="w-full h-auto rounded-lg">
        </div>
    </div>
</section>

<!-- Investor Application Form -->
<section class="container mx-auto px-6 py-12 bg-white rounded-lg shadow-lg mt-8">
    <h2 class="text-2xl font-bold mb-8">Investor Application</h2>
    <form action="#" method="POST">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Full Name -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="full_name">Let's start with an easy one, what is your name? *</label>
                <input type="text" id="full_name" placeholder="Full Name" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="email">Can you enter an email where we can contact you? *</label>
                <input type="email" id="email" placeholder="Email" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="password">Let's input a password now. *</label>
                <input type="password" id="password" placeholder="Enter a password for logging into the platform" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
            </div>

            <!-- Re-enter Password -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="re_password">Can you re-enter the password? *</label>
                <input type="password" id="re_password" placeholder="Re-enter password" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
            </div>

            <!-- Company Name -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="company_name">And what is the name of your company? *</label>
                <input type="text" id="company_name" placeholder="Company Name" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
            </div>

            <!-- Designation -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="designation">What is your designation in there? *</label>
                <input type="text" id="designation" placeholder="Designation in the company" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
            </div>

            <!-- Website Link -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="website">Where can I find more info about your company? *</label>
                <input type="text" id="website" placeholder="What is the link to your website?" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
            </div>

            <!-- Primary Country -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="primary_country">What is the primary country you are in business? *</label>
                <select id="primary_country" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                    <option>Select Primary Country</option>
                    <option>Bangladesh</option>
                    <option>India</option>
                    <option>USA</option>
                </select>
            </div>

            <!-- LinkedIn -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="linkedin">LinkedIn *</label>
                <input type="text" id="linkedin" placeholder="Please add the link to your LinkedIn profile" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
            </div>

            <!-- Investment Expertise -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="investment_expertise">What is your level of investment expertise? *</label>
                <select id="investment_expertise" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                    <option>Select level of investment expertise</option>
                    <option>Beginner</option>
                    <option>Intermediate</option>
                    <option>Expert</option>
                </select>
            </div>
        </div>

        <!-- Agreement and Newsletter -->
        <div class="mt-6">
            <label class="flex items-center space-x-2">
                <input type="checkbox" class="rounded border-gray-300 text-green-500 focus:ring-green-400">
                <span class="text-gray-700">I agree to the <a href="#" class="text-green-500 underline">terms and conditions</a> and <a href="#" class="text-green-500 underline">privacy policy</a>.</span>
            </label>
            <label class="flex items-center space-x-2 mt-2">
                <input type="checkbox" class="rounded border-gray-300 text-green-500 focus:ring-green-400">
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