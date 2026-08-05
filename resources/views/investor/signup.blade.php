@extends('layouts.guest')
@section('page_title', 'Investor Sign Up | Bangladesh Angels Network Limited')

@push('head_meta')
    <x-seo-meta
        title="Investor Sign Up | Bangladesh Angels Network Limited"
        description="Apply to become an angel investor with Bangladesh Angels Network — join 450+ executives backing early-stage startups in Bangladesh and beyond."
        :canonical="route('investor.signup')"
        :image="asset('investor_cover.webp')"
    />
@endpush
<br>
@section('page_content')
<section class="bg-[#0a5554] rounded-3xl py-12 text-white">
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
<section class="container mx-auto px-6 py-12 bg-white rounded-2xl border border-green-100/70 shadow-xl mt-8">
    <div class="mb-8 border-b border-green-100 pb-6">
        <h2 class="text-2xl font-bold text-[#0f3d34]">Investor Application</h2>
        <p class="mt-2 text-sm text-gray-600">Please complete the form below. Fields marked with * are required.</p>
    </div>
    @php
        $selectedPlan = old('selected_plan', 'free');
        $googleSignup = session('google_signup');
        $usingGoogleSignup = is_array($googleSignup) && filled($googleSignup['google_id'] ?? null);
    @endphp

    @if (session('info'))
        <div class="mb-6 p-4 rounded-lg bg-blue-50 border border-blue-200 text-blue-900 text-sm">{{ session('info') }}</div>
    @endif

    @if ($errors->has('google'))
        <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800 text-sm">{{ $errors->first('google') }}</div>
    @endif

    <div class="mb-8 rounded-xl border border-gray-200 bg-gray-50 p-5">
        <x-google-auth-button intent="signup" class="max-w-md" />
        <p class="mt-3 text-xs text-gray-500">Use Google to pre-fill your name and email, then complete the rest of the investor application.</p>
    </div>

    @if ($usingGoogleSignup)
        <div class="mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm">
            Signed in with Google as <strong>{{ $googleSignup['email'] }}</strong>. Complete the remaining fields below and submit your application.
        </div>
    @endif

    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Choose your tier</h3>
        <p class="text-sm text-gray-600 mb-4">Free is selected by default. You can upgrade now and continue to secure payment after email verification.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
            <label class="block cursor-pointer rounded-xl border-2 p-4 transition {{ $selectedPlan === 'free' ? 'border-[#0f3d34] bg-[#eaf6f3]' : 'border-gray-200 bg-white' }}">
                <input class="sr-only plan-radio" type="radio" name="selected_plan" value="free" data-price="0" {{ $selectedPlan === 'free' ? 'checked' : '' }}>
                <p class="text-sm font-semibold uppercase text-gray-500">Free</p>
                <p class="mt-1 text-xl font-bold text-[#0f3d34]">$0 <span class="text-sm font-normal text-gray-500">/yr</span></p>
                <p class="mt-2 text-sm text-gray-600">Create your investor account and start with the free tier.</p>
            </label>

            @foreach ($tiers as $tier)
                @php
                    $tierValueCopy = match (strtolower((string) $tier->slug)) {
                        'core' => 'Designed for angels getting started with curated opportunities.',
                        'advanced' => 'Ideal for active investors who want deeper access and insights.',
                        'institutional' => 'Built for professional investors managing larger portfolios.',
                        default => 'Access premium investor features with this plan.',
                    };
                @endphp
                <label class="block cursor-pointer rounded-xl border-2 p-4 transition {{ $selectedPlan === $tier->slug ? 'border-[#0f3d34] bg-[#eaf6f3]' : 'border-gray-200 bg-white' }}">
                    <input class="sr-only plan-radio" type="radio" name="selected_plan" value="{{ $tier->slug }}" data-price="{{ (float) $tier->price_yearly }}" {{ $selectedPlan === $tier->slug ? 'checked' : '' }}>
                    <p class="text-sm font-semibold uppercase text-gray-500">{{ $tier->name }}</p>
                    <p class="mt-1 text-xl font-bold text-[#0f3d34]">${{ number_format((float) $tier->price_yearly, 0) }} <span class="text-sm font-normal text-gray-500">/yr</span></p>
                    <p class="mt-2 text-sm text-gray-600">{{ $tierValueCopy }}</p>
                </label>
            @endforeach
        </div>
    </div>

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
    <form id="investor-signup-form" method="POST" action="{{route('member.apply')}}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        <input type="hidden" id="selected_plan" name="selected_plan" value="{{ $selectedPlan }}">
        <input type="hidden" id="selected_plan_price" name="selected_plan_price" value="{{ old('selected_plan_price', '0') }}">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Full Name -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:col-span-2">
                <div class="flex flex-col">
                    <label class="block text-gray-700 font-semibold mb-2" for="first_name">First Name <span class="text-red-500">*</span></label>
                    <input type="text" id="first_name" placeholder="John" value="{{ old('first_name', $usingGoogleSignup ? ($googleSignup['first_name'] ?? '') : '') }}" name="first_name" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
                    @error('first_name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label class="block text-gray-700 font-semibold mb-2" for="last_name">Last Name <span class="text-red-500">*</span></label>
                    <input type="text" id="last_name" placeholder="Doe" value="{{ old('last_name', $usingGoogleSignup ? ($googleSignup['last_name'] ?? '') : '') }}" name="last_name" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
                    @error('last_name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="email">Email <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" placeholder="Email" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 {{ $usingGoogleSignup ? 'bg-gray-100' : '' }}" value="{{ old('email', $usingGoogleSignup ? ($googleSignup['email'] ?? '') : '') }}" {{ $usingGoogleSignup ? 'readonly' : '' }} required>
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>    
                <label class="block text-gray-700 font-semibold mb-2" for="address">Preferred Address <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    id="address"
                    name="address" 
                    placeholder="Address" 
                    value="{{ old('address') }}" 
                    class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200"
                    required
                >
                @error('address')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            @unless ($usingGoogleSignup)
            <div class="md:col-span-2 rounded-xl border border-green-100 bg-green-50/40 p-5">
                <h3 class="text-base font-bold text-[#0f3d34] mb-4">Account Access</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="password">Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Enter a secure password" class="w-full p-3 pr-12 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
                            <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700" aria-label="Show password" aria-pressed="false">
                                <svg id="eye-open-password" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 3c-4.5 0-8.06 2.95-9.5 7 1.44 4.05 5 7 9.5 7s8.06-2.95 9.5-7c-1.44-4.05-5-7-9.5-7Zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                    <path d="M10 8a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                                </svg>
                                <svg id="eye-closed-password" xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M3.28 2.22a.75.75 0 0 0-1.06 1.06l1.68 1.68A10.94 10.94 0 0 0 .5 10c1.44 4.05 5 7 9.5 7 1.94 0 3.72-.55 5.22-1.48l1.5 1.5a.75.75 0 1 0 1.06-1.06l-14.5-14.5ZM10 14a4 4 0 0 1-4-4c0-.72.19-1.4.52-1.98l5.46 5.46A3.98 3.98 0 0 1 10 14Zm9.5-4c-.62 1.75-1.73 3.28-3.17 4.4l-2.03-2.03A4 4 0 0 0 8.63 6.7L6.96 5.03A10.7 10.7 0 0 1 10 4c4.5 0 8.06 2.95 9.5 6Z" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">Use at least 8 characters with uppercase, lowercase, number, and special character.</p>
                        @error('password')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="re_password">Confirm Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" id="re_password" name="password_confirmation" placeholder="Re-enter your password" class="w-full p-3 pr-12 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
                            <button type="button" id="toggle-password-confirmation" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700" aria-label="Show password confirmation" aria-pressed="false">
                                <svg id="eye-open-confirmation" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 3c-4.5 0-8.06 2.95-9.5 7 1.44 4.05 5 7 9.5 7s8.06-2.95 9.5-7c-1.44-4.05-5-7-9.5-7Zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                    <path d="M10 8a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                                </svg>
                                <svg id="eye-closed-confirmation" xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M3.28 2.22a.75.75 0 0 0-1.06 1.06l1.68 1.68A10.94 10.94 0 0 0 .5 10c1.44 4.05 5 7 9.5 7 1.94 0 3.72-.55 5.22-1.48l1.5 1.5a.75.75 0 1 0 1.06-1.06l-14.5-14.5ZM10 14a4 4 0 0 1-4-4c0-.72.19-1.4.52-1.98l5.46 5.46A3.98 3.98 0 0 1 10 14Zm9.5-4c-.62 1.75-1.73 3.28-3.17 4.4l-2.03-2.03A4 4 0 0 0 8.63 6.7L6.96 5.03A10.7 10.7 0 0 1 10 4c4.5 0 8.06 2.95 9.5 6Z" />
                                </svg>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            @endunless

            <!-- Company Name -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="company_name">Company Name <span class="text-red-500">*</span></label>
                <input type="text" id="company_name" name="company_name" placeholder="Company Name" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="{{ old('company_name') }}" required>
                @error('company_name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Designation -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="designation">Designation <span class="text-red-500">*</span></label>
                <input type="text" id="designation" name="designation" placeholder="Designation in the company" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="{{ old('designation') }}" required>
                @error('designation')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Primary Country -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="primary_country">Country <span class="text-red-500">*</span></label>
                <select id="country" name="primary_country" value="{{old('primary_country')}}" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
                    <option value="">Select Primary Country</option>
                    <option value="Afghanistan">Afghanistan</option>
                    <option value="Åland Islands">Åland Islands</option>
                    <option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antarctica">Antarctica</option>
                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Aruba">Aruba</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaijan">Azerbaijan</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Belize">Belize</option>
                    <option value="Benin">Benin</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Bouvet Island">Bouvet Island</option>
                    <option value="Brazil">Brazil</option>
                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Canada">Canada</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Cayman Islands">Cayman Islands</option>
                    <option value="Central African Republic">Central African Republic</option>
                    <option value="Chad">Chad</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Christmas Island">Christmas Island</option>
                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Congo">Congo</option>
                    <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cote D'ivoire">Cote D'ivoire</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czech Republic</option>
                    <option value="Denmark">Denmark</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egypt">Egypt</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                    <option value="Faroe Islands">Faroe Islands</option>
                    <option value="Fiji">Fiji</option>
                    <option value="Finland">Finland</option>
                    <option value="France">France</option>
                    <option value="French Guiana">French Guiana</option>
                    <option value="French Polynesia">French Polynesia</option>
                    <option value="French Southern Territories">French Southern Territories</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Germany">Germany</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Greece">Greece</option>
                    <option value="Greenland">Greenland</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guam">Guam</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guernsey">Guernsey</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guinea-bissau">Guinea-bissau</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                    <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Isle of Man">Isle of Man</option>
                    <option value="Israel">Israel</option>
                    <option value="Italy">Italy</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japan">Japan</option>
                    <option value="Jersey">Jersey</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                    <option value="Korea, Republic of">Korea, Republic of</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macao">Macao</option>
                    <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Maldives">Maldives</option>
                    <option value="Mali">Mali</option>
                    <option value="Malta">Malta</option>
                    <option value="Marshall Islands">Marshall Islands</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                    <option value="Moldova, Republic of">Moldova, Republic of</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montenegro">Montenegro</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="Namibia">Namibia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Netherlands">Netherlands</option>
                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                    <option value="New Caledonia">New Caledonia</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Niue">Niue</option>
                    <option value="Norfolk Island">Norfolk Island</option>
                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                    <option value="Norway">Norway</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Palau">Palau</option>
                    <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Philippines">Philippines</option>
                    <option value="Pitcairn">Pitcairn</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Reunion">Reunion</option>
                    <option value="Romania">Romania</option>
                    <option value="Russian Federation">Russian Federation</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="Saint Helena">Saint Helena</option>
                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                    <option value="Saint Lucia">Saint Lucia</option>
                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                    <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                    <option value="Samoa">Samoa</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Serbia">Serbia</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Slovakia">Slovakia</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                    <option value="Spain">Spain</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                    <option value="Swaziland">Swaziland</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                    <option value="Taiwan">Taiwan</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Timor-leste">Timor-leste</option>
                    <option value="Togo">Togo</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Uganda">Uganda</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Emirates">United Arab Emirates</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="United States">United States</option>
                    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                    <option value="Uruguay">Uruguay</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Viet Nam">Viet Nam</option>
                    <option value="Virgin Islands, British">Virgin Islands, British</option>
                    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                    <option value="Western Sahara">Western Sahara</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option>
                </select>
                @error('primary_country')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone Number -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="phone">Phone Number <span class="text-red-500">*</span></label>
                <div class="flex space-x-2">
                    <select name="country_code" class="w-1/4 p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                        <option data-countryCode="BD" value="880">🇧🇩 (+880)</option>
                        <option data-countryCode="GB" value="44" selected>🇬🇧 (+44)</option>
                        <option data-countryCode="US" value="1">🇺🇸 (+1)</option>
                        <optgroup label="Other countries">
                            <option data-countryCode="DZ" value="213">🇩🇿 (+213)</option>
                            <option data-countryCode="AD" value="376">🇦🇩 (+376)</option>
                            <option data-countryCode="AO" value="244">🇦🇴 (+244)</option>
                            <option data-countryCode="AI" value="1264">🇦🇮 (+1264)</option>
                            <option data-countryCode="AG" value="1268">🇦🇬 (+1268)</option>
                            <option data-countryCode="AR" value="54">🇦🇷 (+54)</option>
                            <option data-countryCode="AM" value="374">🇦🇲 (+374)</option>
                            <option data-countryCode="AW" value="297">🇦🇼 (+297)</option>
                            <option data-countryCode="AU" value="61">🇦🇺 (+61)</option>
                            <option data-countryCode="AT" value="43">🇦🇹 (+43)</option>
                            <option data-countryCode="AZ" value="994">🇦🇿 (+994)</option>
                            <option data-countryCode="BS" value="1242">🇧🇸 (+1242)</option>
                            <option data-countryCode="BH" value="973">🇧🇭 (+973)</option>
                            <option data-countryCode="BB" value="1246">🇧🇧 (+1246)</option>
                            <option data-countryCode="BY" value="375">🇧🇾 (+375)</option>
                            <option data-countryCode="BE" value="32">🇧🇪 (+32)</option>
                            <option data-countryCode="BZ" value="501">🇧🇿 (+501)</option>
                            <option data-countryCode="BJ" value="229">🇧🇯 (+229)</option>
                            <option data-countryCode="BM" value="1441">🇧🇲 (+1441)</option>
                            <option data-countryCode="BT" value="975">🇧🇹 (+975)</option>
                            <option data-countryCode="BO" value="591">🇧🇴 (+591)</option>
                            <option data-countryCode="BA" value="387">🇧🇦 (+387)</option>
                            <option data-countryCode="BW" value="267">🇧🇼 (+267)</option>
                            <option data-countryCode="BR" value="55">🇧🇷 (+55)</option>
                            <option data-countryCode="BN" value="673">🇧🇳 (+673)</option>
                            <option data-countryCode="BG" value="359">🇧🇬 (+359)</option>
                            <option data-countryCode="BF" value="226">🇧🇫 (+226)</option>
                            <option data-countryCode="BI" value="257">🇧🇮 (+257)</option>
                            <option data-countryCode="KH" value="855">🇰🇭 (+855)</option>
                            <option data-countryCode="CM" value="237">🇨🇲 (+237)</option>
                            <option data-countryCode="CA" value="1">🇨🇦 (+1)</option>
                            <option data-countryCode="CL" value="56">🇨🇱 (+56)</option>
                            <option data-countryCode="CN" value="86">🇨🇳 (+86)</option>
                            <option data-countryCode="CO" value="57">🇨🇴 (+57)</option>
                            <option data-countryCode="CR" value="506">🇨🇷 (+506)</option>
                            <option data-countryCode="HR" value="385">🇭🇷 (+385)</option>
                            <option data-countryCode="CU" value="53">🇨🇺 (+53)</option>
                            <option data-countryCode="CY" value="357">🇨🇾 (+357)</option>
                            <option data-countryCode="CZ" value="420">🇨🇿 (+420)</option>
                            <option data-countryCode="DK" value="45">🇩🇰 (+45)</option>
                            <option data-countryCode="DO" value="1809">🇩🇴 (+1809)</option>
                            <option data-countryCode="EG" value="20">🇪🇬 (+20)</option>
                            <option data-countryCode="SV" value="503">🇸🇻 (+503)</option>
                            <option data-countryCode="ET" value="251">🇪🇹 (+251)</option>
                            <option data-countryCode="FI" value="358">🇫🇮 (+358)</option>
                            <option data-countryCode="FR" value="33">🇫🇷 (+33)</option>
                            <option data-countryCode="DE" value="49">🇩🇪 (+49)</option>
                            <option data-countryCode="GH" value="233">🇬🇭 (+233)</option>
                            <option data-countryCode="GR" value="30">🇬🇷 (+30)</option>
                            <option data-countryCode="HK" value="852">🇭🇰 (+852)</option>
                            <option data-countryCode="HU" value="36">🇭🇺 (+36)</option>
                            <option data-countryCode="IS" value="354">🇮🇸 (+354)</option>
                            <option data-countryCode="IN" value="91">🇮🇳 (+91)</option>
                            <option data-countryCode="ID" value="62">🇮🇩 (+62)</option>
                            <option data-countryCode="IE" value="353">🇮🇪 (+353)</option>
                            <option data-countryCode="IL" value="972">🇮🇱 (+972)</option>
                            <option data-countryCode="IT" value="39">🇮🇹 (+39)</option>
                            <option data-countryCode="JP" value="81">🇯🇵 (+81)</option>
                            <option data-countryCode="MY" value="60">🇲🇾 (+60)</option>
                            <option data-countryCode="MX" value="52">🇲🇽 (+52)</option>
                            <option data-countryCode="NL" value="31">🇳🇱 (+31)</option>
                            <option data-countryCode="NZ" value="64">🇳🇿 (+64)</option>
                            <option data-countryCode="PK" value="92">🇵🇰 (+92)</option>
                            <option data-countryCode="PH" value="63">🇵🇭 (+63)</option>
                            <option data-countryCode="PL" value="48">🇵🇱 (+48)</option>
                            <option data-countryCode="PT" value="351">🇵🇹 (+351)</option>
                            <option data-countryCode="RU" value="7">🇷🇺 (+7)</option>
                            <option data-countryCode="SA" value="966">🇸🇦 (+966)</option>
                            <option data-countryCode="ZA" value="27">🇿🇦 (+27)</option>
                            <option data-countryCode="ES" value="34">🇪🇸 (+34)</option>
                            <option data-countryCode="SE" value="46">🇸🇪 (+46)</option>
                            <option data-countryCode="CH" value="41">🇨🇭 (+41)</option>
                            <option data-countryCode="TH" value="66">🇹🇭 (+66)</option>
                            <option data-countryCode="TR" value="90">🇹🇷 (+90)</option>
                            <option data-countryCode="AE" value="971">🇦🇪 (+971)</option>
                            <option data-countryCode="GB" value="44">🇬🇧 (+44)</option>
                            <option data-countryCode="US" value="1">🇺🇸 (+1)</option>
                        </optgroup>
                    </select>
                    <input type="text" id="phone" name="phone" placeholder="Phone Number / WhatsApp" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="{{ old('phone') }}" required>
                </div>
                @error('country_code')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
                @error('phone')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gender -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="gender">Gender <span class="text-red-500">*</span></label>
                <select id="gender" name="gender" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- LinkedIn -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="linkedin">LinkedIn <span class="text-gray-500 font-normal">(optional)</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                        <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"/>
                        </svg>
                    </span>
                    <input type="text" id="linkedin" name="linkedin" placeholder="Please add the link to your LinkedIn profile" class="w-full p-3 pl-10 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="{{ old('linkedin') }}">
                </div>
                @error('linkedin')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Investment Expertise -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="investment_expertise">Level of Investment Expertise <span class="text-red-500">*</span></label>
                <select id="investment_expertise" name="investment_expertise" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
                    <option value="">Select level of investment expertise</option>
                    <option value="beginner" {{ old('investment_expertise') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="intermediate" {{ old('investment_expertise') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="expert" {{ old('investment_expertise') == 'expert' ? 'selected' : '' }}>Expert</option>
                </select>
                @error('investment_expertise')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Agreement and Newsletter -->
        <div class="mt-6 rounded-xl border border-gray-200 bg-gray-50 p-4">
            <label class="flex items-start space-x-2">
                <input type="checkbox" class="rounded border-gray-300 text-green-500 focus:ring-green-400" name="terms" required>
                <span class="text-gray-700">I agree to the <a href="{{ asset('MoU.pdf') }}" class="text-green-500 underline" target="_blank">terms and conditions</a> and privacy policy.</span>
            </label>
            @error('terms')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="mt-8 flex justify-end">
            <button type="submit" class="bg-[#0f3d34] hover:bg-[#156755] text-white px-8 py-3 rounded-lg transition flex items-center justify-center font-semibold shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                </svg>
                Submit Application
            </button>
        </div>
    </form>
</section>
<script>
    (function () {
        const planRadios = document.querySelectorAll('.plan-radio');
        const planInput = document.getElementById('selected_plan');
        const planPriceInput = document.getElementById('selected_plan_price');
        const togglePasswordButton = document.getElementById('toggle-password');
        const togglePasswordConfirmationButton = document.getElementById('toggle-password-confirmation');
        const passwordInput = document.getElementById('password');
        const confirmationInput = document.getElementById('re_password');
        const eyeOpenPassword = document.getElementById('eye-open-password');
        const eyeClosedPassword = document.getElementById('eye-closed-password');
        const eyeOpenConfirmation = document.getElementById('eye-open-confirmation');
        const eyeClosedConfirmation = document.getElementById('eye-closed-confirmation');

        function syncPlan() {
            const checked = document.querySelector('.plan-radio:checked');
            if (!checked) {
                return;
            }

            if (planInput) {
                planInput.value = checked.value;
            }
            if (planPriceInput) {
                planPriceInput.value = checked.getAttribute('data-price') || '0';
            }

            document.querySelectorAll('.plan-radio').forEach((radio) => {
                const card = radio.closest('label');
                if (!card) {
                    return;
                }
                if (radio.checked) {
                    card.classList.add('border-[#0f3d34]', 'bg-[#eaf6f3]');
                    card.classList.remove('border-gray-200', 'bg-white');
                } else {
                    card.classList.remove('border-[#0f3d34]', 'bg-[#eaf6f3]');
                    card.classList.add('border-gray-200', 'bg-white');
                }
            });
        }

        planRadios.forEach((radio) => {
            radio.addEventListener('change', syncPlan);
        });

        if (togglePasswordButton && passwordInput && eyeOpenPassword && eyeClosedPassword) {
            togglePasswordButton.addEventListener('click', function () {
                const shouldShowPassword = passwordInput.type === 'password';
                passwordInput.type = shouldShowPassword ? 'text' : 'password';
                togglePasswordButton.setAttribute('aria-label', shouldShowPassword ? 'Hide password' : 'Show password');
                togglePasswordButton.setAttribute('aria-pressed', shouldShowPassword ? 'true' : 'false');
                eyeOpenPassword.classList.toggle('hidden', shouldShowPassword);
                eyeClosedPassword.classList.toggle('hidden', !shouldShowPassword);
            });
        }

        if (togglePasswordConfirmationButton && confirmationInput && eyeOpenConfirmation && eyeClosedConfirmation) {
            togglePasswordConfirmationButton.addEventListener('click', function () {
                const shouldShowPassword = confirmationInput.type === 'password';
                confirmationInput.type = shouldShowPassword ? 'text' : 'password';
                togglePasswordConfirmationButton.setAttribute('aria-label', shouldShowPassword ? 'Hide password confirmation' : 'Show password confirmation');
                togglePasswordConfirmationButton.setAttribute('aria-pressed', shouldShowPassword ? 'true' : 'false');
                eyeOpenConfirmation.classList.toggle('hidden', shouldShowPassword);
                eyeClosedConfirmation.classList.toggle('hidden', !shouldShowPassword);
            });
        }

        syncPlan();
    })();
</script>
<style>
    #investor-signup-form input[type="text"],
    #investor-signup-form input[type="email"],
    #investor-signup-form input[type="password"],
    #investor-signup-form input[type="date"],
    #investor-signup-form input[type="time"],
    #investor-signup-form input[type="number"],
    #investor-signup-form select,
    #investor-signup-form textarea {
        background-color: #f7fbf9;
        border-color: #a9c4bc;
        color: #111827;
    }

    #investor-signup-form input::placeholder,
    #investor-signup-form textarea::placeholder {
        color: #6b7280;
    }

    #investor-signup-form input:focus,
    #investor-signup-form select:focus,
    #investor-signup-form textarea:focus {
        background-color: #ffffff;
        border-color: #0f6a4b;
        box-shadow: 0 0 0 3px rgba(15, 106, 75, 0.16);
    }
</style>
@endsection