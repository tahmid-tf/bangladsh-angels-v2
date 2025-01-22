<section class="fixed flex z-10 top-0 text-center justify-center items-center w-full">
    <div class="align-self-center w-full md:w-[70vw] bg-gray-100/30 backdrop-blur-lg z-50 shadow-md flex flex-row justify-between items-center rounded-lg md:rounded-full mt-6 px-4">
        <!-- Logo (Left for Desktop) -->
        <a href="{{ route('home') }}" class="flex justify-start">
            <img src="{{ asset('logo.webp') }}" class="h-[40px] my-4 md:mx-[40px]" alt="Bangladesh Angels Network Logo">
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
        <div class="flex items-center">
            @auth
            <div class="relative">
                <!-- User Avatar -->
                <button onclick="toggleDropdown()" class="focus:outline-none">
                    <img src="{{ auth()->user()->getProfilePhotoUrl() }}" alt="User Avatar" class="h-10 w-10 rounded-full">
                </button>
                <!-- Dropdown Menu -->
                <div id="dropdown-menu" class="hidden absolute right-0 mt-2 bg-white border rounded-lg shadow-lg w-48">
                    <ul class="text-left text-gray-700">
                        <li class="px-4 py-2 hover:bg-gray-100">
                            <a href="{{ route('profile.edit') }}">Profile</a>
                        </li>
                        @if (auth()->user()->isAdmin())
                            <li class="px-4 py-2 hover:bg-gray-100">
                                <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                            </li>
                        @endif
                        <li class="px-4 py-2 hover:bg-gray-100">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
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
            <a href="{{ route('login') }}" class="p-3 pl-4 pr-4 rounded-full bg-[#36b37e] font-bold text-white">
                Login / Sign Up
            </a>
            @endguest
        </div>

        <!-- Hamburger Menu (Mobile) -->
        <div class="md:hidden flex items-center justify-end">
            <button id="mobile-menu-button" onclick="toggleMobileMenu()" class="focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden flex-col items-center bg-white w-full shadow-md md:hidden absolute top-[70px] left-0 z-20">
            <ul class="flex flex-col text-gray-700">
                <li class="px-4 py-2 border-b"><a href="{{ route('deals') }}">Deals</a></li>
                <li class="px-4 py-2 border-b"><a href="{{ route('investors')}}">BAN Investors</a></li>
                <li class="px-4 py-2 border-b"><a href="{{ route('portfolio') }}">Portfolio</a></li>
                <li class="px-4 py-2 border-b"><a href="{{ route('resources') }}">BAN Resources</a></li>
                <li class="px-4 py-2"><a href="{{ route('team') }}">Our Team</a></li>
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
            /* Mobile-specific styles */
            .flex-row {
                flex-direction: row;
            }
            #dropdown-menu {
                width: 100%;
                left: 0;
            }
        }
    </style>
</section>
