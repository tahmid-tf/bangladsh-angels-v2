<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title')</title>
    <link rel="icon" type="image/webp" href="{{ asset('icon.webp') }}">
    <link rel="preload" as="style" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <livewire:styles />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Critical CSS */
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
        }
        
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
            transition: opacity 0.3s ease-in-out;
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
                setTimeout(() => {
                    document.getElementById("loading-screen").style.display = "none";
                }, 300);
            }, 300); // Reduced delay for faster perceived loading
        });
    </script>
</head>

<body class="flex flex-col justify-center items-center w-full font-sans text-gray-900 mt-[150px] antialiased">
    
    <!-- Loading Screen -->
    <div id="loading-screen">
        <img src="{{ asset('icon.webp') }}" alt="Bangladesh Angels Logo" class="h-16 md:h-24 lg:h-32" width="128" height="128">
    </div>

    <livewire:navigation-bar></livewire:navigation-bar>

    @yield('page_content')

    <livewire:footer></livewire:footer>
    <livewire:scripts />
</body>
</html>
