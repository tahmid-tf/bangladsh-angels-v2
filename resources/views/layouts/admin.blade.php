<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title')</title>
    <link rel="icon" type="image/webp" href="{{ asset('icon.webp') }}">
    @vite('resources/css/app.css')
    <livewire:styles />

    <style>
        /* Loading Screen Styles */
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.5s ease-in-out;
            z-index: 9999;
        }

        #loading-screen.fade-out {
            opacity: 0;
            pointer-events: none;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(() => {
                document.getElementById("loading-screen").classList.add("fade-out");
            }, 500);
        });
    </script>
</head>

<body class="h-full flex flex-col md:flex-row bg-gray-100">
    <!-- Loading Screen -->
    <div id="loading-screen">
        <img src="{{ asset('icon.webp') }}" alt="Bangladesh Angels Logo" class="h-16 md:h-24 lg:h-32">
    </div>

    <!-- Mobile Menu Button -->
    <button id="mobileMenuButton" class="md:hidden fixed top-4 right-4 z-50 p-2 bg-[#0a5554] rounded-lg text-white">
        ☰
    </button>

    <!-- Sidebar -->
    <aside id="sidebar" class="flex flex-col w-64 bg-[#0a5554] text-white h-screen fixed md:relative md:translate-x-0 transform -translate-x-full transition-transform duration-300 z-40">
        <a href="{{ route('home') }}" class="p-4 md:p-6">
            <img src="{{ asset('bdangels_white.png') }}" alt="Bangladesh Angels Logo" class="h-[50px] w-auto">
        </a>

        <nav class="flex-1 flex flex-col pb-6">
            <a href="{{ route('admin.dashboard') }}" class="py-3 px-6 hover:bg-green-600">Dashboard</a>
            <a href="{{ route('admin.members') }}" class="py-3 px-6 hover:bg-green-600">Members</a>
            <a href="{{ route('admin.resources') }}" class="py-3 px-6 hover:bg-green-600">Resources</a>
            <a href="{{ route('admin.deals') }}" class="py-3 px-6 hover:bg-green-600">Deals</a>
            <a href="{{ route('admin.subscriptions') }}" class="py-3 px-6 hover:bg-green-600">Subscriptions</a>
            <a href="{{ route('admin.investments') }}" class="py-3 px-6 hover:bg-green-600">Investments</a>
            <a href="{{ route('admin.mail') }}" class="py-3 px-6 hover:bg-green-600">Mail List</a>
        </nav>
    </aside>

    <!-- Main Content Container -->
    <div class="flex-1 flex flex-col min-w-0 h-screen md:h-auto">
        <!-- Navbar -->
        <header class="flex flex-col md:flex-row justify-between items-center p-4 bg-white shadow">
            <h1 class="text-lg font-bold mb-2 md:mb-0 text-center md:text-left">
                <strong>Hi {{ auth()->user()->name }},</strong>
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

        <!-- Notification Banner -->
        @auth
            @if (!auth()->user()->email_verified_at)
            <div id="email-verification-banner" class="bg-[rgb(246,240,213)] border-l-4 w-[90vw] md:w-[70vw] mt-6 text-[#494130] p-4 rounded-lg mb-4 relative">
                <p><strong>Welcome!</strong> Please verify your email address by clicking <a href="{{route('verification.notice')}}" class="font-bold underline">here</a></p>
                <button onclick="dismissBanner()" class="absolute top-2 right-2 text-lg font-bold text-[#494130]">×</button>
            </div>
            @endif
        @endauth

        <!-- Content Area -->
        <main class="flex-1 overflow-y-auto p-4 bg-gray-50">
            @yield('page_content')
        </main>
    </div>

    <script>
        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const mobileMenuButton = document.getElementById('mobileMenuButton');

        function initSidebar() {
            if (window.innerWidth < 768) {
                sidebar.classList.add('-translate-x-full');
            } else {
                sidebar.classList.remove('-translate-x-full');
            }
        }

        initSidebar();

        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    sidebar.classList.add('-translate-x-full');
                }
            });
        });

        // Dropdown Toggle
        function toggleDropdown() {
            document.getElementById('dropdown-menu').classList.toggle('hidden');
        }

        document.addEventListener('click', (event) => {
            const dropdownMenu = document.getElementById('dropdown-menu');
            const isDropdownClick = event.target.closest('#dropdown-menu') || event.target.closest('header button');
            
            if (!isDropdownClick) {
                dropdownMenu.classList.add('hidden');
            }

            if (window.innerWidth < 768 && !sidebar.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        });

        window.addEventListener('resize', () => {
            initSidebar();
            document.getElementById('dropdown-menu').classList.add('hidden');
        });

        // Dismiss Email Verification Banner
        function dismissBanner() {
            document.getElementById('email-verification-banner').style.display = 'none';
        }
    </script>

    <livewire:scripts />
</body>
</html>
