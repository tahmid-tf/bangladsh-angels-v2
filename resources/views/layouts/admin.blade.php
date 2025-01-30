<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title')</title>
    <link rel="icon" type="image/webp" href="{{asset('icon.webp')}}">
    @vite('resources/css/app.css')
    <livewire:styles />
</head>

<body class="h-full flex flex-col md:flex-row bg-gray-100">
    <!-- Mobile Menu Button -->
    <button id="mobileMenuButton" class="md:hidden fixed top-4 right-4 z-50 p-2 bg-[#0a5554] rounded-lg text-white">
        ☰
    </button>

    <!-- Sidebar -->
    <aside id="sidebar" class="flex flex-col w-64 bg-[#0a5554] text-white h-screen fixed md:relative md:translate-x-0 transform -translate-x-full transition-transform duration-300 z-40">
        <a href="{{route('home')}}" class="p-4 md:p-6">
            <img src="{{asset('bdangels_white.png')}}" alt="bd_angels logo" class="h-[50px] w-auto">
        </a>

        <nav class="flex-1 flex flex-col pb-6">
            <a href="{{route('admin.dashboard')}}" class="py-3 px-6 hover:bg-green-600">Dashboard</a>
            <a href="{{route('admin.members')}}" class="py-3 px-6 hover:bg-green-600">Members</a>
            <a href="{{route('admin.deals')}}" class="py-3 px-6 hover:bg-green-600">Deals</a>
            <a href="{{route('admin.subscriptions')}}" class="py-3 px-6 hover:bg-green-600">Subscriptions</a>
            <a href="{{route('admin.investments')}}" class="py-3 px-6 hover:bg-green-600">Investments</a>
        </nav>
    </aside>

    <!-- Main Content Container -->
    <div class="flex-1 flex flex-col min-w-0 h-screen md:h-auto">
        <!-- Navbar -->
        <header class="flex flex-col md:flex-row justify-between items-center p-4 bg-white shadow">
            <h1 class="text-lg font-bold mb-2 md:mb-0 text-center md:text-left">
                <strong>Hi {{auth()->user()->name}},</strong>
                <span class="block md:inline">Welcome back!</span>
            </h1>
            <div class="relative">
                <button onclick="toggleDropdown()" class="focus:outline-none">
                    <img src="{{ auth()->user()->getProfilePhotoUrl() }}" 
                         alt="User Avatar" 
                         class="h-10 w-10 rounded-full border-2 border-[#0a5554]">
                </button>
                <div id="dropdown-menu" class="hidden absolute right-0 mt-2 bg-white border rounded-lg shadow-lg w-48 z-50">
                    <ul class="text-gray-700">
                        <li class="hover:bg-gray-100"><a href="{{ route('profile.edit') }}" class="block px-4 py-2">Profile</a></li>
                        <li class="hover:bg-gray-100"><a href="{{ route('dashboard') }}" class="block px-4 py-2">Dashboard</a></li>
                        <li class="hover:bg-gray-100">
                            <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2">
                                @csrf
                                <button type="submit" class="w-full text-left">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="flex-1 overflow-y-auto p-4 bg-gray-50">
            @yield('page_content')
        </main>
    </div>

    <script>
        // Initialize sidebar state
        const sidebar = document.getElementById('sidebar');
        const mobileMenuButton = document.getElementById('mobileMenuButton');

        function initSidebar() {
            if (window.innerWidth < 768) {
                sidebar.classList.add('-translate-x-full');
            } else {
                sidebar.classList.remove('-translate-x-full');
            }
        }

        // Initial setup
        initSidebar();

        // Toggle sidebar
        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Auto-close sidebar on mobile link click
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    sidebar.classList.add('-translate-x-full');
                }
            });
        });

        // Toggle dropdown
        function toggleDropdown() {
            document.getElementById('dropdown-menu').classList.toggle('hidden');
        }

        // Close dropdown and sidebar when clicking outside
        document.addEventListener('click', (event) => {
            const dropdownMenu = document.getElementById('dropdown-menu');
            const isDropdownClick = event.target.closest('#dropdown-menu') || event.target.closest('header button');
            
            // Close dropdown
            if (!isDropdownClick) {
                dropdownMenu.classList.add('hidden');
            }

            // Close sidebar on mobile
            if (window.innerWidth < 768 && 
                !sidebar.contains(event.target) && 
                !mobileMenuButton.contains(event.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            initSidebar();
            document.getElementById('dropdown-menu').classList.add('hidden');
        });
    </script>

    <livewire:scripts />
</body>
</html>