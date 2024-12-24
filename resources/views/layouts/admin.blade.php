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
    <aside class="w-full lg:w-64 bg-green-800 text-white h-auto lg:h-screen">
      <div class="p-6">
        <img src="{{asset('bdangels_white.png')}}" alt="">
      </div>
      <nav>
        <a href="#" class="block py-2 px-6 hover:bg-green-600">Dashboard</a>
        <a href="#" class="block py-2 px-6 hover:bg-green-600">Members</a>
        <a href="#" class="block py-2 px-6 hover:bg-green-600">Deals</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">
      <!-- Navbar -->
      <header class="flex flex-col md:flex-row justify-between items-center p-4 bg-white shadow">
        <h1 class="text-lg font-bold">Hi, Welcome back</h1>
        <div class="flex items-center space-x-4 mt-4 md:mt-0">
          <img src="https://via.placeholder.com/30" alt="Language" class="rounded">
          <img src="https://via.placeholder.com/30" alt="Profile" class="rounded-full">
        </div>
      </header>

      <!-- Content -->
      <main class="p-4 space-y-6">
        @yield('page_content')
      </main>
    </div>
  </div>
    <livewire:scripts />
</html>