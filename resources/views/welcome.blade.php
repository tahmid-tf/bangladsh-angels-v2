<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bangladesh Angels Network Limited</title>
    <link rel="icon" type="image/webp" href="{{asset('icon.webp')}}">
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col items-center w-full justify-center">
    {{-- Navigation --}}
    <div class="fixed top-0 bg-gray-100/30 backdrop-blur-lg z-50 shadow-md align-center items-center flex flex-row justify-between w-[45vw] rounded-full mt-6">
        <img src="{{asset('logo.webp')}}" class="h-[40px] mx-[40px] my-[20px]" alt="Bangladesh Angels Network Logo">
        <div>
            <ul class="flex font-bold">
                <li class="m-3">Portfolio</li>
                <li class="m-3">Deals</li>
                <li class="m-3">Our Team</li>
                <li class="m-3">Get Funded</li>
                <li class="m-3">FAQ</li>
            </ul>
        </div>
        <div class="mr-6">
            <button class="p-3 pl-4 pr-4 rounded-full bg-[#36b37e] font-bold text-white">
                Login
            </button>
        </div>
    </div>
    {{-- Hero --}}
    <section class="flex justify-center mt-[50px]">
        <div class="flex w-full h-[70vh] py-[120px] justify-center items-center" style="background-image: url('{{ asset('world_map_4x.webp') }}');">
            <img src="{{asset('fpage.JPG')}}" alt="coverphoto" draggable="false">
            <div class="p-3 ml-6 w-1/3">
                <h1 class="text-[1.5em] font-bold">
                    Accelerate your Startup
                </h1>
                <h1 class="text-[3em] leading-none font-bold mt-5">
                    Elevating Entrepreneurs<br>in Bangladesh
                </h1>
                <h1 class="my-10">
                    The nation’s first angel investment network created with a mission to nurture the innovation & entrepreneurship in Bangladesh, connecting them to both local & global investors.
                </h1>
                <button class="p-3 pl-4 pr-4 rounded-full bg-[#eefff1] font-bold text-[#36b37e]">
                    Invest in Startups
                </button>
            </div>
        </div>
    </section>
   
    {{-- Meet the investors --}}
    <div class="flex w-full flex-col justify-center items-center p-6 bg-gradient-to-b from-green-50 pt-[200px] to-white">
        <h1 class="text-[3em] font-bold">
            Meet the Investors
        </h1>
        <p class="mt-3 text-center">
            Join a Global network of over 450 executives and operators<br>who have built and expanded companies in all parts of the world.
        </p>
        <div class="flex p-3 mt-6">
            <div class="flex flex-col">
                <img src="{{asset('image_4x.webp')}}" class="rounded-lg h-[200px] w-auto my-4 shadow-md" alt="">
                <img src="{{asset('image_4x.webp')}}" class="rounded-lg h-[200px] w-auto my-4 shadow-md" alt="">
            </div>

            <div class="flex flex-col mt-16 ml-6">
                <img src="{{asset('image_4x.webp')}}" class="rounded-lg h-[200px] w-auto my-4 shadow-md" alt="">
                <img src="{{asset('image_4x.webp')}}" class="rounded-lg h-[200px] w-auto my-4 shadow-md" alt="">
            </div>

            <div class="flex flex-col ml-6">
                <img src="{{asset('image_4x.webp')}}" class="rounded-lg h-[200px] w-auto my-4 shadow-md" alt="">
                <img src="{{asset('image_4x.webp')}}" class="rounded-lg h-[200px] w-auto my-4 shadow-md" alt="">
            </div>

            <div class="flex flex-col mt-16 ml-6">
                <img src="{{asset('image_4x.webp')}}" class="rounded-lg h-[200px] w-auto my-4 shadow-md" alt="">
                <img src="{{asset('image_4x.webp')}}" class="rounded-lg h-[200px] w-auto my-4 shadow-md" alt="">
            </div>

            <div class="flex flex-col ml-6">
                <img src="{{asset('image_4x.webp')}}" class="rounded-lg h-[200px] w-auto my-4 shadow-md" alt="">
                <img src="{{asset('image_4x.webp')}}" class="rounded-lg h-[200px] w-auto my-4 shadow-md" alt="">
            </div>
        </div>
        
    </div>
</body>
</html>