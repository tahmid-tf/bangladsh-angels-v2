<section class="fixed top-0 z-40 flex w-full flex-col items-center justify-center text-center pt-[env(safe-area-inset-top,0px)]">
    <div class="relative align-self-center mt-6 flex w-full flex-row items-center justify-between rounded-lg bg-gray-100/30 px-4 shadow-md backdrop-blur-lg md:w-[70vw] md:rounded-full z-50">
        
        <!-- Logo (Left for Desktop) -->
        <a href="{{ route('home') }}" class="flex justify-start" title="Bangladesh Angels Network — home">
            <img 
                src="{{ asset('logo.webp') }}" 
                alt="Bangladesh Angels Network Logo"
                class="h-[40px] w-auto max-w-[150px] md:max-w-[200px] my-4 md:mx-[40px] object-contain"
            />
        </a>


        <!-- Navigation Menu (Center for Desktop) -->
        <div class="hidden md:flex flex-1 justify-center">
            <ul class="flex flex-row font-bold text-gray-700">
                <li class="m-3"><a href="{{ route('angel-academy') }}" title="BAN Angel Academy — programme for angel investors">Angel Academy</a></li>
                <li class="m-3"><a href="{{ route('startups') }}" title="Startups — portfolio, deals, pitch, and founder services">Startups</a></li>
                <li class="m-3"><a href="{{ route('investors') }}" title="Our angel investors and how to join BAN">Investors</a></li>
                <li class="m-3">
                    <a
                        href="{{ route('resources') }}"
                        title="{{ auth()->check() ? 'DeckVue — events, webinars, and programs' : 'Resources — events, webinars, and programs' }}"
                    >{{ auth()->check() ? 'DeckVue' : 'Resources' }}</a>
                </li>
                <li class="m-3"><a href="{{ route('team') }}" title="About Bangladesh Angels Network and our team">Our Team</a></li>
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
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('login') }}" title="Log in to your Bangladesh Angels Network account" class="text-sm font-medium text-gray-600 hover:text-[#00877a] transition-colors px-2 py-2">
                    Login
                </a>
                <a href="{{ route('investor.signup') }}" title="Apply to become an angel investor with Bangladesh Angels Network" class="inline-flex items-center justify-center px-5 py-2.5 md:px-6 md:py-3 rounded-full bg-[#0f3d34] font-bold text-white text-center whitespace-nowrap shadow-md hover:bg-[#156755] transition-colors min-w-max text-sm md:text-base">
                    Become an Investor
                </a>
            </div>
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
        <div id="mobile-menu" class="absolute left-0 right-0 top-full z-20 hidden w-full flex-col items-center border-t border-gray-100 bg-white shadow-md md:hidden">
            <ul class="flex flex-col text-gray-700 w-full">
                @auth
                <li class="px-4 py-2 border-b w-full flex items-end justify-end">
                    <span class="flex font-bold text-right sef-end">{{ auth()->user()->name }}</span>
                </li>
                <li class="px-4 py-2 border-b"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="px-4 py-2 border-b"><a href="{{ route('profile.edit') }}">Profile</a></li>
                @endauth
                @guest
                <li class="px-4 py-3 border-b">
                    <a href="{{ route('investor.signup') }}" title="Apply to become an angel investor" class="flex w-full items-center justify-center rounded-full bg-[#0f3d34] py-3 font-bold text-white shadow-md hover:bg-[#156755] transition-colors">
                        Become an Investor
                    </a>
                </li>
                <li class="px-4 py-2 border-b text-center"><a href="{{ route('login') }}" title="Log in to your account" class="text-sm text-gray-600 hover:text-[#00877a]">Login</a></li>
                @endguest
                <li class="px-4 py-2 border-b"><a href="{{ route('angel-academy') }}" title="BAN Angel Academy — programme for angel investors">Angel Academy</a></li>
                <li class="px-4 py-2 border-b"><a href="{{ route('startups') }}" title="Startups — portfolio, deals, pitch, and founder services">Startups</a></li>
                <li class="px-4 py-2 border-b"><a href="{{ route('investors') }}" title="Our angel investors and how to join BAN">Investors</a></li>
                <li class="px-4 py-2 border-b">
                    <a
                        href="{{ route('resources') }}"
                        title="{{ auth()->check() ? 'DeckVue — events, webinars, and programs' : 'Resources — events, webinars, and programs' }}"
                    >{{ auth()->check() ? 'DeckVue' : 'Resources' }}</a>
                </li>
                <li class="px-4 py-2"><a href="{{ route('team') }}" title="About Bangladesh Angels Network and our team">Our Team</a></li>
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

    @auth
        @if (!auth()->user()->email_verified_at)
            <div x-data="{ show: true }" x-show="show" class="bg-[rgb(246,240,213)] justify-center items-center border-l-4 w-[70vw] mt-6 text-[#494130] p-4 rounded-lg mb-4 relative">
                <button @click="show = false" class="absolute top-auto right-2 text-[#494130] hover:text-[#7a734f] transition">
                    ✖
                </button>
                <p><strong>Welcome!</strong> Please verify your email address by 
                    <button wire:click="sendVerificationEmail" class="font-bold underline cursor-pointer">clicking here</button>.
                </p>
                @if (session('verification-notice'))
                    <p class="mt-2 text-sm font-medium text-[#494130]">
                        {{ session('verification-notice') }}
                    </p>
                @endif
            </div>
        @endif
    @endauth


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
