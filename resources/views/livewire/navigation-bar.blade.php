<section class="fixed flex z-10 top-0 text-center justify-center items-center w-full">
    <div class="align-self-center w-full md:w-[70vw] bg-gray-100/30 backdrop-blur-lg z-50 shadow-md flex flex-row justify-between items-center rounded-lg md:rounded-full mt-6 px-4">
        
        <!-- Logo (Left for Desktop) -->
        <a href="{{ route('home') }}" class="flex justify-start">
            <img 
                src="{{ asset('logo.webp') }}" 
                alt="Bangladesh Angels Network Logo"
                class="h-[40px] w-auto max-w-[150px] md:max-w-[200px] my-4 md:mx-[40px] object-contain"
            />
        </a>


        <!-- Navigation Menu (Center for Desktop) -->
        <div class="hidden md:flex flex-1 justify-center">
            <ul class="flex flex-row font-bold text-gray-700">
                <li class="m-3"><a href="{{ route('deals') }}">Deals</a></li>
                <li class="m-3"><a href="{{route('investors')}}">BAN Investors</a></li>
                <li class="m-3"><a href="{{route('portfolio')}}">Portfolio</a></li>
                <li class="m-3"><a href="{{route('resources')}}">BAN Resources</a></li>
                <li class="m-3"><a href="{{ route('team') }}">Our Team</a></li>
            </ul>
        </div>

        <!-- User Actions (Right for Desktop) -->
        <div class="hidden md:flex items-center space-x-4">
            @auth
            <div class="relative">
                <!-- User Avatar -->
                <button onclick="toggleDropdown()" class="focus:outline-none">
                    <img src="{{ auth()->user()->getProfilePhotoUrl() }}" alt="User Avatar" class="h-10 w-10 rounded-full">
                </button>
                <!-- Dropdown Menu -->
                <div id="dropdown-menu" class="hidden absolute right-0 mt-2 bg-white border rounded-lg shadow-lg w-48">
                    <ul class="text-left text-gray-700">
                        <li class="px-4 py-2 hover:bg-gray-100"><a href="{{ route('profile.edit') }}">Profile</a></li>
                        @if (auth()->user()->isAdmin())
                            <li class="px-4 py-2 hover:bg-gray-100"><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                        @endif
                        <li class="px-4 py-2 hover:bg-gray-100"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="px-4 py-2 hover:bg-gray-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @endauth

            @guest
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-[#36b37e] font-bold text-white text-center whitespace-nowrap min-w-max">
                Login / Sign Up
            </a>
            @endguest
        </div>

        <!-- Mobile Menu Button (With Avatar if Logged In) -->
        <div class="md:hidden flex items-center justify-end">
            <button id="mobile-menu-button" onclick="toggleMobileMenu()" class="flex items-center focus:outline-none">
                <!-- User Avatar for Mobile -->
                @auth
                <img src="{{ auth()->user()->getProfilePhotoUrl() }}" alt="User Avatar" class="h-10 w-10 rounded-full mr-3">
                @endauth
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden flex-col items-center bg-white w-full shadow-md md:hidden absolute top-[70px] left-0 z-20">
            <ul class="flex flex-col text-gray-700 w-full">
                @auth
                <li class="px-4 py-2 border-b w-full flex items-end justify-end">
                    {{-- <img src="{{ auth()->user()->getProfilePhotoUrl() }}" alt="User Avatar" class="h-10 w-10 rounded-full mr-3"> --}}
                    <span class="flex font-bold text-right sef-end">{{ auth()->user()->name }}</span>
                </li>
                <li class="px-4 py-2 border-b"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="px-4 py-2 border-b"><a href="{{ route('profile.edit') }}">Profile</a></li>
                @endauth
                @guest
                <li class="px-4 py-2 border-b"><a href="{{ route('login') }}">Login/Sign Up</a></li>
                @endguest
                <li class="px-4 py-2 border-b"><a href="{{ route('deals') }}">Deals</a></li>
                <li class="px-4 py-2 border-b"><a href="{{ route('investors')}}">BAN Investors</a></li>
                <li class="px-4 py-2 border-b"><a href="{{ route('portfolio') }}">Portfolio</a></li>
                <li class="px-4 py-2 border-b"><a href="{{ route('resources') }}">BAN Resources</a></li>
                <li class="px-4 py-2"><a href="{{ route('team') }}">Our Team</a></li>
                @auth
                <hr>
                <li class="flex w-full px-4 py-2 border-b">
                    <form method="POST" action="{{ route('logout') }}" class="flex w-full text-center items-center justify-center">
                        @csrf
                        <button type="submit" class="flex w-full self-center justify-center items-center text-center">Logout</button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>

    <script>
        // Toggle dropdown menu
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdownMenu = document.getElementById('dropdown-menu');
            if (!dropdownMenu.contains(event.target) && !event.target.closest('button')) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Toggle mobile menu
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>

    <style>
        @media (max-width: 768px) {
            /* Ensure elements stack properly */
            .flex-row {
                flex-direction: row;
            }
            /* Adjust dropdown width for mobile */
            #dropdown-menu {
                width: 100%;
                left: 0;
            }
        }
    </style>
</section>
