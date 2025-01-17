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

    <!-- Main Container -->
  <div class="flex flex-col lg:flex-row">
    <!-- Sidebar -->
    <aside class="w-full lg:w-64 bg-[#0a5554] text-white h-auto lg:h-screen">
      <a href="{{route('home')}}">
        <div class="p-6">
          <img src="{{asset('bdangels_white.png')}}" alt="bd_angels logo">
        </div>
      </a>
      
      <nav>
        <a href="{{route('admin.dashboard')}}" class="block py-2 px-6 hover:bg-green-600">Dashboard</a>
        <a href="{{route('admin.members')}}" class="block py-2 px-6 hover:bg-green-600">Members</a>
        <a href="{{route('admin.deals')}}" class="block py-2 px-6 hover:bg-green-600">Deals</a>
        <a href="{{route('admin.subscriptions')}}" class="block py-2 px-6 hover:bg-green-600">Subscriptions</a>
        <a href="{{route('admin.investments')}}" class="block py-2 px-6 hover:bg-green-600">Investments</a>
     
    </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">
      <!-- Navbar -->
      <header class="flex flex-col md:flex-row justify-between items-center p-4 bg-white shadow">
        <h1 class="text-lg font-bold">Hi, Welcome back</h1>
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
      </header>

      <!-- Content -->
      <main class="p-4 space-y-6">
        @yield('page_content')
      </main>
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
    <livewire:scripts />
</html>