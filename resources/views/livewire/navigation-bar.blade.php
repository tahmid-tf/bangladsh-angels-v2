<section class="fixed flex z-10 top-0 text-center justify-center items-center w-full">
    <div class="align-self-center w-[70vw] bg-gray-100/30 backdrop-blur-lg z-50 shadow-md align-center items-center flex flex-row justify-between  rounded-full mt-6">
        <a href="{{route('home')}}">
            <img src="{{asset('logo.webp')}}" class="h-[40px] mx-[40px] my-[20px]" alt="Bangladesh Angels Network Logo">
        </a>
        <div>
            <ul class="flex font-bold">
                <li class="m-3"><a href="{{route('deals')}}">Deals</a></li>
                <li class="m-3">BAN Investors</li>
                <li class="m-3">Portfolio</li>
                <li class="m-3">BAN Resources</li>
                <li class="m-3"><a href="{{route('team')}}">Our Team</a></li>
            </ul>
        </div>
        <div class="mr-6">
            @guest
            <a href="{{route('login')}}" class="p-3 pl-4 pr-4 rounded-full bg-[#36b37e] font-bold text-white">
                Login
            </a>    
            @endguest
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
        </div>
    </div>
    <script>
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
    </script>
    
    <style>
        @media (max-width: 768px) {
            /* Mobile-specific styles for dropdown menu */
            #dropdown-menu {
                width: 100%;
                right: 0;
            }
        }
    </style>
</section>
