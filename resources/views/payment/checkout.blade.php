@extends('layouts.guest')
@section('page_title','Checkout | Bangladesh Angels Network')
@section('page_content')

<!-- Page Container -->
<div class="container mx-auto px-4 py-12">
    

    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Let’s finish powering you up!</h1>
        <p class="text-gray-500">Your selected plan is shown below.</p>
    </div>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
            <button onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                ✖
            </button>
        </div>
    @endif
    
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Main Content -->
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <!-- Hidden Inputs for Plan and Price -->
        <input type="hidden" name="plan" value="{{ session('checkout.plan.name', 'Default Plan') }}">
        <input type="hidden" name="price" value="{{ session('checkout.plan.price', '0') }}">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Selected Plan Section -->
            <div class="bg-white shadow-md rounded-lg p-6 lg:col-span-3">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Selected Plan</h2>
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-xl font-bold text-gray-800">{{ session('checkout.plan.name', 'Default Plan') }}</p>
                        <p class="text-gray-500">${{ session('checkout.plan.price', '0') }} /yr</p>
                    </div>
                    <a href="{{ route('plans') }}" class="text-green-600 hover:underline">Change Plan</a>
                </div>
            </div>
              
        
            <!-- Left: Billing Address -->
            <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Billing Address -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Billing Information</h2>
                        <!-- Full Name -->
                        <div class="flex">
                            <div class="flex flex-col w-full">
                                <label class="block text-gray-700 font-semibold my-2" for="name">Full Name</label>
                                <input type="text" id="name" placeholder="John" name="name" value="{{auth()->user() && auth()->user()->name ? old('name',auth()->user()->name) : ''}}" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
                            </div>
                            
                        </div>
                <div>
                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700 font-semibold my-2" for="email">Email *</label>
                        <input type="email" id="email" name="email" placeholder="Email" class="w-full border rounded-md px-4 py-2 text-gray-700 focus:ring focus:ring-green-200" value="{{auth()->user() && auth()->user()->email ? old('email',auth()->user()->email) : ''}}" required>
                    </div>
                </div>
                <div>
                    <div>    
                        <label class="block text-gray-700 mt-3 font-semibold my-2" for="address">Billing Address *</label>
                        <input 
                            type="text" 
                            id="address"
                            name="address" 
                            placeholder="Address" 
                            value="{{auth()->user() && auth()->user()->address ? old('address',auth()->user()->address) : ''}}" 
                            class="w-full border rounded-md px-4 py-2 text-gray-700 focus:ring focus:ring-green-200"
                        >
                    </div>
                </div>
                <label class="block text-gray-700 font-semibold my-2" for="phone">Phone Number *</label>
                <span class="flex">
                    <select name="country_code" class="w-1/3 p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" id="">
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
                    <input type="text" id="phone" name="phone" placeholder="Phone Number" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="{{ old('phone') }}" required>
                </span>
                @guest
                <div>
                    <label class="block text-gray-700 font-semibold my-2" for="password">Password *</label>
                    <input type="password" id="password" name="password" placeholder="Enter a password for logging into the platform" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
                </div>
    
                <!-- Re-enter Password -->
                <div>
                    <label class="block text-gray-700 font-semibold my-2" for="re_password">Re-enter password *</label>
                    <input type="password" id="re_password" name="password_confirmation" placeholder="Re-enter password" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
                </div>
                @endguest
            <!-- Password -->
            
            <div>
                <label class="block text-gray-700 font-semibold my-2" for="investment_expertise">
                    Level of Investment Expertise *
                </label>
                <select id="investment_expertise" name="investment_expertise"
                        class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200"
                        required>
                    <option value="">Select level of investment expertise</option>
                    
                    <option value="beginner"
                        {{ (auth()->check() && auth()->user()->investment_expertise == 'beginner') ? 'selected' : '' }}>
                        Beginner
                    </option>
                    
                    <option value="intermediate"
                        {{ (auth()->check() && auth()->user()->investment_expertise == 'intermediate') ? 'selected' : '' }}>
                        Intermediate
                    </option>
                    
                    <option value="expert"
                        {{ (auth()->check() && auth()->user()->investment_expertise == 'expert') ? 'selected' : '' }}>
                        Expert
                    </option>
                </select>
            </div>
            
            </div>  

                    <!-- Payment Method -->
                    <div>
                        <!-- Company Name -->
                        <div>
                            <label class="block text-gray-700 font-semibold my-2" for="company_name">Company Name *</label>
                            <input type="text" id="company_name" name="company_name" value="{{auth()->user()->company_name}}" placeholder="Company Name" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="{{ old('company_name') }}" required>
                        </div>

                        <!-- Designation -->
                        <div>
                            <label class="block text-gray-700 font-semibold my-2" for="designation">Designation *</label>
                            <input type="text" id="designation" name="designation" placeholder="Designation in the company" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="{{auth()->user() && auth()->user()->designation ? old('designation',auth()->user()->designation) : ''}}" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold my-2" for="primary_country">Country *</label>
                            <select id="primary_country" name="primary_country" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
                                <option value="">Select Primary Country</option>
                                @foreach ([
                                    "Afghanistan", "Åland Islands", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", 
                                    "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", 
                                    "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", 
                                    "Bolivia", "Bosnia and Herzegovina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", 
                                    "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde",
                                    "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands",
                                    "Colombia", "Comoros", "Congo", "Congo, The Democratic Republic of The", "Cook Islands", "Costa Rica", "Cote D'ivoire",
                                    "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador",
                                    "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)",
                                    "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories",
                                    "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam",
                                    "Guatemala", "Guernsey", "Guinea", "Guinea-bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland",
                                    "India", "Indonesia", "Iran, Islamic Republic of", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica",
                                    "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Republic of", "Kuwait", "Kyrgyzstan",
                                    "Lao People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya",
                                    "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta",
                                    "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of",
                                    "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal",
                                    "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands",
                                    "Norway", "Oman", "Pakistan", "Palau", "Palestinian Territory, Occupied", "Panama", "Papua New Guinea", "Paraguay",
                                    "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Romania", "Russian Federation",
                                    "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and The Grenadines", "Samoa", "San Marino",
                                    "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia",
                                    "Solomon Islands", "Somalia", "South Africa", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden",
                                    "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania, United Republic of", "Thailand",
                                    "Timor-leste", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan",
                                    "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom",
                                    "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Viet Nam", "Zambia", "Zimbabwe"
                                ] as $country)
                                    <option value="{{ $country }}" {{ (auth()->user() && auth()->user()->primary_country == $country) ? 'selected' : '' }}>
                                        {{ $country }}
                                    </option>
                                @endforeach
                            </select>
                            
                        </div>
                        <!-- Gender -->
                        <div>
                            <label class="block text-gray-700 font-semibold my-2" for="gender">Gender *</label>
                            <select id="gender" name="gender" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
                                <option value="">Select Gender</option>
                                
                                <option value="male" 
                                    {{ (old('gender') ? old('gender') : (auth()->check() ? auth()->user()->gender : '')) == 'male' ? 'selected' : '' }}>
                                    Male
                                </option>
                            
                                <option value="female" 
                                    {{ (old('gender') ? old('gender') : (auth()->check() ? auth()->user()->gender : '')) == 'female' ? 'selected' : '' }}>
                                    Female
                                </option>
                            
                                <option value="other" 
                                    {{ (old('gender') ? old('gender') : (auth()->check() ? auth()->user()->gender : '')) == 'other' ? 'selected' : '' }}>
                                    Other
                                </option>
                            </select>
                            
                            
                        </div>
                        <!-- LinkedIn -->
                        <div>
                            <label class="block text-gray-700 font-semibold my-2" for="linkedin">LinkedIn *</label>
                            <input type="text" id="linkedin" name="linkedin" placeholder="Please add the link to your LinkedIn profile" class="w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="{{auth()->user() && auth()->user()->linkedin ? old('linkedin',auth()->user()->linkedin) : ''}}" required>
                        </div>
                        @guest
                        <div>
                            <label class="block text-gray-700 font-semibold my-2" for="photo">Upload Your Photo</label>
                            <input type="file" id="photo" name="profile_photo" accept="image/*" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                        </div>
                        @endguest
                        <!-- Photo Upload -->
                        
                        <h2 class="text-lg font-semibold text-gray-800 my-4">Payment Method</h2>
                        <div class="space-y-4">
                            <!-- Send Payment Details -->
                            <label class="flex items-center space-x-4">
                                <input type="radio" name="payment" value="email" class="text-green-600 focus:ring focus:ring-green-200" checked>
                                <span class="flex items-center">
                                    Send Payment details to my email
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Summary -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Summary</h2>
                <ul class="space-y-4">
                    <li class="flex justify-between text-gray-700">
                        <span>Subscription</span>
                        <span class="bg-green-100 text-green-600 text-sm font-semibold px-2 py-1 rounded-full">
                            {{ session('checkout.plan.name', 'Default Plan') }}
                        </span>
                    </li>
                    <li class="text-gray-800 text-4xl font-bold text-center">
                        ${{ session('checkout.plan.price', '0') }} <span class="text-lg font-normal text-gray-500">/yr</span>
                    </li>
                    <li class="flex justify-between text-gray-700">
                        <span>Total Billed</span>
                        <span>${{ session('checkout.plan.price', '0') }}</span>
                    </li>
                </ul>
                <button type="submit" class="mt-6 bg-green-600 text-white w-full py-2 rounded-full hover:bg-green-700 transition">
                    Complete Checkout
                </button>
                {{-- <p class="text-center text-sm text-gray-500 mt-4">
                    Secure credit card payment <br>
                    This is a secure 128-bit SSL encrypted payment
                </p> --}}
            </div>
        </div>
    </form>

</div>

@endsection
