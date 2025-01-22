@extends('layouts.admin')
@section('page_title', 'Edit Member | Bangladesh Angels Network')
@section('page_content')
<form id="edit-member-form" class="bg-white p-6 rounded-lg shadow space-y-6" method="POST" action="{{ route('member.update', $user->id) }}" enctype="multipart/form-data">
    @csrf
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
        <!-- Left: Profile Photo and Active Status -->
        <div class="space-y-6">
            <!-- Profile Photo -->
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
        </div>

        <!-- Middle: General Information -->
        <div class="space-y-4 lg:col-span-2">
            <!-- Basic Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="full_name" class="block font-semibold text-gray-700">Full Name</label>
                    <input type="text" id="full_name" name="full_name" placeholder="Full Name" class="border border-gray-300 p-2 rounded w-full" value="{{ old('full_name', $user->name) }}" required>
                </div>
                <div>
                    <label for="email" class="block font-semibold text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Email Address" class="border border-gray-300 p-2 rounded w-full" value="{{ old('email', $user->email) }}" required>
                </div>
                <div>
                    <label for="phone" class="block font-semibold text-gray-700">Phone Number / WhatsApp</label>
                    <input type="text" id="phone" name="phone" placeholder="Phone Number / WhatsApp" class="border border-gray-300 p-2 rounded w-full" value="{{ old('phone', $user->phone) }}" required>
                </div>
                <div>
                    <label for="gender" class="block font-semibold text-gray-700">Gender</label>
                    <select id="gender" name="gender" class="border border-gray-300 p-2 rounded w-full" required>
                        <option value="">Gender</option>
                        <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="country" class="block font-semibold text-gray-700">Country</label>
                <select id="country" name="primary_country" class="border border-gray-300 p-2 rounded w-full">
                    
                    <option value="{{$user->primary_country}}">{{ $user->primary_country }}</option>
                    <optgroup label="Countries">
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
                    </optgroup>
                    
                </select>
                <label for="preference_sector" class="block font-semibold text-gray-700 mt-3">Preference Sector</label>
                <input type="text" id="preference_sector" name="preference_sector" placeholder="Preference Sector" class="border border-gray-300 p-2 rounded w-full" value="{{ old('preference_sector', $user->preference_sector) }}">
            </div>
            <!-- Membership and Contact Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="organization" class="block font-semibold text-gray-700">Organization</label>
                    <input type="text" id="organization" name="organization" placeholder="Organization" class="border border-gray-300 p-2 rounded w-full" value="{{ $user->company_name }}">
                </div>
                <div>
                    <label for="designation" class="block font-semibold text-gray-700">Designation</label>
                    <input type="text" id="designation" name="designation" placeholder="Designation" class="border border-gray-300 p-2 rounded w-full" value="{{ old('designation', $user->designation) }}">
                </div>
                <div>
                    <label for="account_status" class="block font-semibold text-gray-700">Account Status</label>
                    <select id="account_status" name="account_status" class="border border-gray-300 p-2 rounded w-full">
                        <option disabled value="{{ $user->account_status }}">{{ ucfirst($user->account_status) }}</option>
                        <optgroup label="Tiers">
                            <option value="free">Free</option>
                            <option value="core">Core</option>
                            <option value="advanced">Advanced</option>
                            <option value="institutional">Institutional</option>
                        </optgroup>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="total_invested" class="block font-semibold text-gray-700">Total Invested (USD)</label>
                    <input 
                        type="number" 
                        id="total_invested" 
                        name="total_invested" 
                        placeholder="Enter total invested amount" 
                        class="border border-gray-300 p-2 rounded w-full" 
                        value="{{ old('total_invested', $user->total_invested) }}" 
                        step="0.01" 
                        min="0">
                </div>
                <div class="mb-4">
                    <label for="revenue_generated" class="block font-semibold text-gray-700">Revenue Generated (USD)</label>
                    <input 
                        type="number" 
                        id="revenue_generated" 
                        name="revenue_generated" 
                        placeholder="Enter total revenue generated" 
                        class="border border-gray-300 p-2 rounded w-full" 
                        value="{{ old('revenue_generated', $user->revenue_generated) }}" 
                        step="0.01" 
                        min="0" 
                        >
                </div>
                                
                <div>
                    <label for="account_level" class="block font-semibold text-gray-700">Account Level</label>
                    <select id="account_level" name="account_level" class="border border-gray-300 p-2 rounded w-full">
                        <option value="">Select Account Level</option>
                        <option value="emerald" {{ old('account_level', $user->level) == 'emerald' ? 'selected' : '' }}>Emerald</option>
                        <option value="ruby" {{ old('account_level', $user->level) == 'ruby' ? 'selected' : '' }}>Ruby</option>
                        <option value="diamond" {{ old('account_level', $user->level) == 'diamond' ? 'selected' : '' }}>Diamond</option>
                    </select>
                </div>
                <div>
                    <label for="primary_contact" class="block font-semibold text-gray-700">Primary Contact</label>
                    <input type="text" id="primary_contact" name="primary_contact" placeholder="Primary Contact" class="border border-gray-300 p-2 rounded w-full" value="{{ old('primary_contact', $user->primary_contact) }}">
                </div>
                <div>
                    <label for="secondary_contact" class="block font-semibold text-gray-700">Secondary Contact</label>
                    <input type="text" id="secondary_contact" name="secondary_contact" placeholder="Secondary Contact (e.g., Analyst)" class="border border-gray-300 p-2 rounded w-full" value="{{ old('secondary_contact', $user->secondary_contact) }}">
                </div>
            </div>

            <!-- Referred By -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="was_referred" class="block font-semibold text-gray-700">Was Referred</label>
                    <select id="was_referred" name="was_referred" class="border border-gray-300 p-2 rounded w-full" onchange="toggleReferredByInput(this)">
                        <option value="0" {{ old('was_referred', $user->was_referred) == 0 ? 'selected' : '' }}>Not Referred</option>
                        <option value="1" {{ old('was_referred', $user->was_referred) == 1 ? 'selected' : '' }}>Referred</option>
                    </select>
                </div>
                <div id="referred_by_container" style="display: {{ old('was_referred', $user->was_referred) == 1 ? 'block' : 'none' }};">
                    <label for="referred_by" class="block font-semibold text-gray-700">Referred By</label>
                    <input type="text" id="referred_by" name="referred_by" placeholder="Referred By" class="border border-gray-300 p-2 rounded w-full" value="{{ old('referred_by', $user->referred_by) }}">
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function toggleReferredByInput(select) {
        const referredByContainer = document.getElementById('referred_by_container');
        if (select.value == "1") {
            referredByContainer.style.display = "block";
        } else {
            referredByContainer.style.display = "none";
        }
    }
</script>
@endsection
