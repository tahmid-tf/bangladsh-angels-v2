<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page_title')</title>
    <link rel="icon" type="image/webp" href="{{asset('icon.webp')}}">
    @vite('resources/css/app.css')
    <livewire:styles />
</head>

<body class="h-screen flex flex-col md:flex-row overflow-hidden bg-gray-100">
    <!-- Mobile Menu Button -->
    <button id="mobileMenuButton" class="md:hidden fixed top-4 right-4 z-50 p-2 bg-[#0a5554] rounded-lg text-white">
        ☰
    </button>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-[#0a5554] text-white flex-col h-screen fixed transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-40">
        <a href="{{route('home')}}" class="block p-4 md:p-6">
            <img src="{{asset('bdangels_white.png')}}" alt="bd_angels logo" 
                 class="w-auto h-[50px] mx-auto md:mx-0"> <!-- Fixed width and responsive centering -->
        </a>

        <nav class="flex flex-col flex-grow pb-6">
            <a href="{{route('admin.dashboard')}}" class="block py-3 px-6 hover:bg-green-600">Dashboard</a>
            <a href="{{route('admin.members')}}" class="block py-3 px-6 hover:bg-green-600">Members</a>
            <a href="{{route('admin.deals')}}" class="block py-3 px-6 hover:bg-green-600">Deals</a>
            <a href="{{route('admin.subscriptions')}}" class="block py-3 px-6 hover:bg-green-600">Subscriptions</a>
            <a href="{{route('admin.investments')}}" class="block py-3 px-6 hover:bg-green-600">Investments</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex flex-col flex-grow md:ml-64 min-h-screen">
        <!-- Navbar -->
        <header class="flex flex-col md:flex-row justify-between items-center p-4 bg-white shadow">
            <h1 class="text-lg font-bold mb-2 md:mb-0 text-center md:text-left">
                <strong>Hi {{auth()->user()->name}},</strong><span class="block md:inline">Welcome back!</span>
            </h1>
            <div class="relative">
                <!-- User Avatar -->
                <button onclick="toggleDropdown()" class="focus:outline-none">
                    <img src="{{ auth()->user()->getProfilePhotoUrl() }}" alt="User Avatar" class="h-10 w-10 rounded-full border-2 border-[#0a5554]">
                </button>
                <!-- Dropdown Menu -->
                <div id="dropdown-menu" class="hidden absolute right-0 mt-2 bg-white border rounded-lg shadow-lg w-48 z-50">
                    <ul class="text-left text-gray-700">
                        <li class="px-4 py-2 hover:bg-gray-100">
                            <a href="{{ route('profile.edit') }}" class="block w-full">Profile</a>
                        </li>
                        <li class="px-4 py-2 hover:bg-gray-100">
                            <a href="{{ route('dashboard') }}" class="block w-full">Dashboard</a>
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
        </header>

        <!-- Content -->
        <main class="p-4 space-y-6 flex-grow bg-gray-50 overflow-auto">
            @yield('page_content')
        </main>
    </div>

    <script>
        // Toggle mobile menu
        const sidebar = document.getElementById('sidebar');
        const mobileMenuButton = document.getElementById('mobileMenuButton');

        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Toggle dropdown menu
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdownMenu = document.getElementById('dropdown-menu');
            const isClickInside = event.target.closest('#dropdown-menu') || 
                                event.target.closest('button') && event.target.closest('button').contains(event.target);

            if (!isClickInside) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth < 768 && 
                !sidebar.contains(event.target) && 
                !mobileMenuButton.contains(event.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>

    <livewire:scripts />
</body>
</html>