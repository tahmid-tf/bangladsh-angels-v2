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
<livewire:navigation-bar></livewire:navigation-bar>
<body class="flex flex-col items-center w-full mt-[150px] justify-center">
    {{-- Navigation --}}
    @yield('page_content')
    <livewire:footer></livewire:footer>
    <livewire:scripts />
</body>
</html>