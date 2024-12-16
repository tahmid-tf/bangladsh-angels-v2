<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bangladesh Angels Network Limited</title>
    <link rel="icon" type="image/webp" href="{{asset('icon.webp')}}">
    @vite('resources/css/app.css')
    <livewire:styles />
</head>
<body class="flex flex-col items-center w-full justify-center">
    {{-- Navigation --}}
    <section class="fixed flex z-10 top-0 text-center justify-center items-center w-full">
        <div class="align-self-center w-[70vw] bg-gray-100/30 backdrop-blur-lg z-50 shadow-md align-center items-center flex flex-row justify-between  rounded-full mt-6">
            <img src="{{asset('logo.webp')}}" class="h-[40px] mx-[40px] my-[20px]" alt="Bangladesh Angels Network Logo">
            <div>
                <ul class="flex font-bold">
                    <li class="m-3">Deals</li>
                    <li class="m-3">BAN Investors</li>
                    <li class="m-3">Portfolio</li>
                    <li class="m-3">BAN Resources</li>
                    <li class="m-3">Our Team</li>
                </ul>
            </div>
            <div class="mr-6">
                <button class="p-3 pl-4 pr-4 rounded-full bg-[#36b37e] font-bold text-white">
                    Login
                </button>
            </div>
        </div>
    </section>
    
    {{-- Hero --}}
    <section class="flex justify-center mt-[150px]">
        <div class="flex w-full h-[70vh] py-[120px] justify-center items-center" style="background-image: url('{{ asset('world_map_4x.webp') }}');">
            <img src="{{asset('fpage.JPG')}}" alt="coverphoto" draggable="false">
            <div class="p-3 ml-6 w-1/3">
                <h1 class="text-[1.5em] font-bold">
                    Accelerate your Startup
                </h1>
                <h1 class="text-[3em] leading-none font-bold mt-5">
                    Elevating Entrepreneurs<br>in Bangladesh
                </h1>
                <h1 class="my-10 text-[1.5em]">
                    The nation’s first angel investment network created with a mission to nurture the innovation & entrepreneurship in Bangladesh, connecting them to both local & global investors.
                </h1>
                <button class="p-3 pl-4 pr-4 rounded-full bg-[#eefff1] font-bold text-[#36b37e]">
                    Invest in Startups
                </button>
            </div>
        </div>
    </section>
   
    {{-- Meet the investors --}}
    <div class="flex w-full flex-col justify-center items-center p-6 bg-gradient-to-b from-green-50 pt-[200px] border-box to-white">
        <h1 class="text-[3em] font-bold">
            Meet the Investors
        </h1>
        <p class="mt-3 text-center text-[1.5em]">
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

    {{-- Portfolio Companies --}}
    <section class="flex mt-[6em] flex-col w-full justify-center items-center">
        <div class="flex w-[68vw] flex-row justify-between items-center">
            <div class="flex flex-col justify-start">
                <h1 class="text-[3em] font-bold leading-none">Portfolio Companies</h1>
                <p class="text-[1.7em] text-[#777] mt-3">Take a look at our portfolio companies</p>
            </div>
            <div>
                <button class="p-3 pl-4 pr-4 rounded-full bg-[#36b37e] font-bold text-white">
                    View All Portfolios
                </button>
            </div>
        </div>

        <div class="flex w-[70vw]">
            <div class="w-[1/3] m-6">
                <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg">
                    <img
                      alt=""
                      src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                      class="h-56 w-full object-cover"
                    />
                  
                    <div class="bg-white p-4 sm:p-6">
                      <time datetime="2022-10-10" class="block text-xs text-gray-500"> 10th Oct 2022 </time>
                  
                      <a href="#">
                        <h3 class="mt-0.5 text-lg text-gray-900">Company title</h3>
                      </a>
                  
                      <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae dolores, possimus
                        pariatur animi temporibus nesciunt praesentium dolore sed nulla ipsum eveniet corporis quidem,
                        mollitia itaque minus soluta, voluptates neque explicabo tempora nisi culpa eius atque
                        dignissimos. Molestias explicabo corporis voluptatem?
                      </p>
                    </div>
                </article>
            </div>
            <div class="w-[1/3] m-6">
                <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg">
                    <img
                      alt=""
                      src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                      class="h-56 w-full object-cover"
                    />
                  
                    <div class="bg-white p-4 sm:p-6">
                      <time datetime="2022-10-10" class="block text-xs text-gray-500"> 10th Oct 2022 </time>
                  
                      <a href="#">
                        <h3 class="mt-0.5 text-lg text-gray-900">Company title</h3>
                      </a>
                  
                      <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae dolores, possimus
                        pariatur animi temporibus nesciunt praesentium dolore sed nulla ipsum eveniet corporis quidem,
                        mollitia itaque minus soluta, voluptates neque explicabo tempora nisi culpa eius atque
                        dignissimos. Molestias explicabo corporis voluptatem?
                      </p>
                    </div>
                </article>
            </div>
            <div class="w-[1/3] m-6">
                <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg">
                    <img
                      alt=""
                      src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                      class="h-56 w-full object-cover"
                    />
                  
                    <div class="bg-white p-4 sm:p-6">
                      <time datetime="2022-10-10" class="block text-xs text-gray-500"> 10th Oct 2022 </time>
                  
                      <a href="#">
                        <h3 class="mt-0.5 text-lg text-gray-900">Company title</h3>
                      </a>
                  
                      <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae dolores, possimus
                        pariatur animi temporibus nesciunt praesentium dolore sed nulla ipsum eveniet corporis quidem,
                        mollitia itaque minus soluta, voluptates neque explicabo tempora nisi culpa eius atque
                        dignissimos. Molestias explicabo corporis voluptatem?
                      </p>
                    </div>
                </article>
            </div>
        </div>
    </section>
    {{-- Pitch your Startup --}}
    <section class="flex mt-[6em] flex-row w-full p-[100px] border-box justify-between items-center">
        <div class="flex flex-col justify-between w-[1/2] h-full">
            <span class="flex flex-col">
                <h1 class="text-[3em] font-bold leading-none">Pitch your Startup</h1>
                <p class="mt-6">
                    The network looks to invest between Taka 80 Lakhs to 5 Crores in innovative, high-growth companies. We welcome entrepreneurs from all backgrounds including first time entrepreneurs or those who have failed in their earlier attempts. Here’s what we look for:
                </p>
            </span>
            

            <button class="p-3 w-1/4 shadow-md shadow-gray-200 mt-10 pl-4 pr-4 rounded-full bg-[#eefff1] font-bold text-[#36b37e]">
                Send Your Pitch
            </button>
        </div>
        <div class="flex flex-col w-[1/2]">
            <img src="{{asset('team.webp')}}" alt="team photo">
        </div>
    </section>

    {{-- Deal Listings --}}
    <section class="flex mt-[6em] flex-col w-full bg-[#00877a] py-[200px] border-box text-white  border-box justify-center items-center">
        <h1 class="text-[3em] font-bold">
            Deal Listings
        </h1>
        <p class="my-10 text-[1.5em]">
            Live Details to review and invest today!
        </p>
        <div class="flex flex-row w-[70vw] justify-between">
            <button>
                <img src="{{asset('icons/disabled previous btn.webp')}}" class="1/4 h-[6em]" alt="previous btn">
            </button>
            <div class="w-1/3 m-3 z-0">
                <a href="#" class="group relative block rounded-lg overflow-hidden">
                    
                  
                    <img
                      src="https://images.unsplash.com/photo-1628202926206-c63a34b1618f?q=80&w=2574&auto=format&fit=crop"
                      alt=""
                      class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"
                    />
                    <div class="ml-3 absolute top-[15em] flex items-center">
                        <img class="h-10 w-10 -mx-1.5 ring ring-white rounded-full object-cover" src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=4&w=880&h=880&q=100" alt="">
                        <img class="h-10 w-10 -mx-1.5 ring ring-white rounded-full object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=4&w=687&h=687&q=80" alt="">
                        <img class="h-10 w-10 -mx-1.5 ring ring-white rounded-full object-cover" src="https://images.unsplash.com/photo-1464863979621-258859e62245?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=4&w=686&h=686&q=80" alt="">
                        <img class="h-10 w-10 -mx-1.5 ring ring-white rounded-full object-cover" src="https://images.unsplash.com/photo-1485178575877-1a13bf489dfe?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=4&w=1401&h=1401&q=80" alt="">
                        <img class="h-10 w-10 -mx-1.5 ring ring-white rounded-full object-cover" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=4&w=880&h=880&q=80" alt="">
                    </div>
                    <div class="flex flex-col border w-full border-gray-100 bg-white p-6 border-box">
                      <div class="flex w-full">
                        <p class="flex w-1/3 text-gray-400 bg-gray-100 font-bold text-[0.7em] justify-center self-start rounded-full p-3">
                            Audio Technology
                        </p>
                        <p class="flex w-1/3 text-gray-400 bg-gray-100 font-bold text-[0.7em] justify-center self-start rounded-full p-3">
                        Artifical Intelligence
                        </p>
                      </div>
                        
                      <h3 class="mt-1.5 text-lg font-medium text-gray-900">Wireless Headphones</h3>
                  
                      <p class="mt-1.5 line-clamp-3 text-gray-700">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore nobis iure obcaecati pariatur.
                        Officiis qui, enim cupiditate aliquam corporis iste.
                      </p>
                  
                      <div class="flex w-full justify-between">
                        <h1 class="rounded-full text-gray-700  p-3 self-end my-6 font-bold transition hover:scale-105"
                      >
                        Pre-Seed
                      </h1>
                      <button
                          type="button"
                          class="rounded-full border-2 w-[8em] border-[#36b37e] text-[#36b37e]  p-3 self-end my-6 font-bold transition hover:scale-105"
                        >
                          Invest Now
                        </button>
                      </div>
                    </div>
                  </a>
            </div>
            <div class="w-1/3 m-3 z-0">
                <a href="#" class="group relative block rounded-lg overflow-hidden">
                    
                  
                    <img
                      src="https://images.unsplash.com/photo-1628202926206-c63a34b1618f?q=80&w=2574&auto=format&fit=crop"
                      alt=""
                      class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"
                    />
                    <div class="ml-3 absolute top-[15em] flex items-center">
                        <img class="h-10 w-10 -mx-1.5 ring ring-white rounded-full object-cover" src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=4&w=880&h=880&q=100" alt="">
                        <img class="h-10 w-10 -mx-1.5 ring ring-white rounded-full object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=4&w=687&h=687&q=80" alt="">
                        <img class="h-10 w-10 -mx-1.5 ring ring-white rounded-full object-cover" src="https://images.unsplash.com/photo-1464863979621-258859e62245?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=4&w=686&h=686&q=80" alt="">
                        <img class="h-10 w-10 -mx-1.5 ring ring-white rounded-full object-cover" src="https://images.unsplash.com/photo-1485178575877-1a13bf489dfe?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=4&w=1401&h=1401&q=80" alt="">
                        <img class="h-10 w-10 -mx-1.5 ring ring-white rounded-full object-cover" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=4&w=880&h=880&q=80" alt="">
                    </div>
                    <div class="flex flex-col border w-full border-gray-100 bg-white p-6 border-box">
                      <div class="flex w-full">
                        <p class="flex w-1/3 text-gray-400 bg-gray-100 font-bold text-[0.7em] justify-center self-start rounded-full p-3">
                            Audio Technology
                        </p>
                        <p class="flex w-1/3 text-gray-400 bg-gray-100 font-bold text-[0.7em] justify-center self-start rounded-full p-3">
                        Artifical Intelligence
                        </p>
                      </div>
                        
                      <h3 class="mt-1.5 text-lg font-medium text-gray-900">Wireless Headphones</h3>
                  
                      <p class="mt-1.5 line-clamp-3 text-gray-700">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore nobis iure obcaecati pariatur.
                        Officiis qui, enim cupiditate aliquam corporis iste.
                      </p>
                  
                      <div class="flex w-full justify-between">
                        <h1 class="rounded-full text-gray-700  p-3 self-end my-6 font-bold transition hover:scale-105"
                      >
                        Pre-Seed
                      </h1>
                      <button
                          type="button"
                          class="rounded-full border-2 w-[8em] border-[#36b37e] text-[#36b37e]  p-3 self-end my-6 font-bold transition hover:scale-105"
                        >
                          Invest Now
                        </button>
                      </div>
                    </div>
                  </a>
            </div>
            <div class="w-1/3 m-3 z-0">
                <a href="#" class="group relative block rounded-lg overflow-hidden">
                    
                  
                    <img
                      src="https://images.unsplash.com/photo-1628202926206-c63a34b1618f?q=80&w=2574&auto=format&fit=crop"
                      alt=""
                      class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"
                    />
                    <div class="ml-3 absolute top-[15em] flex items-center">
                        <img class="h-10 w-10 -mx-1.5 ring ring-white rounded-full object-cover" src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=4&w=880&h=880&q=100" alt="">
                        <img class="h-10 w-10 -mx-1.5 ring ring-white rounded-full object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=4&w=687&h=687&q=80" alt="">
                        <img class="h-10 w-10 -mx-1.5 ring ring-white rounded-full object-cover" src="https://images.unsplash.com/photo-1464863979621-258859e62245?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=4&w=686&h=686&q=80" alt="">
                        <img class="h-10 w-10 -mx-1.5 ring ring-white rounded-full object-cover" src="https://images.unsplash.com/photo-1485178575877-1a13bf489dfe?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=4&w=1401&h=1401&q=80" alt="">
                        <img class="h-10 w-10 -mx-1.5 ring ring-white rounded-full object-cover" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=4&w=880&h=880&q=80" alt="">
                    </div>
                    <div class="flex flex-col border w-full border-gray-100 bg-white p-6 border-box">
                      <div class="flex w-full">
                        <p class="flex w-1/3 text-gray-400 bg-gray-100 font-bold text-[0.7em] justify-center self-start rounded-full p-3">
                            Audio Technology
                        </p>
                        <p class="flex w-1/3 text-gray-400 bg-gray-100 font-bold text-[0.7em] justify-center self-start rounded-full p-3">
                        Artifical Intelligence
                        </p>
                      </div>
                        
                      <h3 class="mt-1.5 text-lg font-medium text-gray-900">Wireless Headphones</h3>
                  
                      <p class="mt-1.5 line-clamp-3 text-gray-700">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore nobis iure obcaecati pariatur.
                        Officiis qui, enim cupiditate aliquam corporis iste.
                      </p>
                  
                      <div class="flex w-full justify-between">
                        <h1 class="rounded-full text-gray-700  p-3 self-end my-6 font-bold transition hover:scale-105"
                      >
                        Pre-Seed
                      </h1>
                      <button
                          type="button"
                          class="rounded-full border-2 w-[8em] border-[#36b37e] text-[#36b37e]  p-3 self-end my-6 font-bold transition hover:scale-105"
                        >
                          Invest Now
                        </button>
                      </div>
                    </div>
                  </a>
            </div>
            <button>
                <img src="{{asset('icons/enabled next btn.webp')}}" class="1/4 h-[6em]" alt="next btn">
            </button>
        </div>
        <button class="p-3 pl-4 pr-4 rounded-full bg-white mt-6 font-bold text-[#00877a]">
            Explore All Deals
        </button>
    </section>
    <section class="flex flex-col justify-center text-center w-full py-[100px] border-box">
      <h1 class="text-[3em] font-bold">
        BAN Resources
      </h1>
      <p class="mt-3 text-center text-[1.5em]">
        Bangladesh Angels Hosts events for start-ups and Angel Investors.<br>Join any of our events to connect with people today!
      </p>
      <div class="bg-white py-6 sm:py-8 lg:py-[20px]">
        <div class="mx-auto max-w-screen-xl px-4 md:px-8">
          <div class="flex flex-col overflow-hidden text-white justify-start rounded-lg bg-gradient-to-br to-[#022e2e] from-[#156755] sm:flex-row md:h-80">
            <!-- image - start -->
            <div class="order-first h-48 w-full bg-gray-300 sm:order-none sm:h-auto sm:w-1/2 lg:w-2/5">
              <img src="{{asset('resourcesCover.webp')}}" loading="lazy" alt="Photo by Andras Vas" class="h-full w-full object-cover object-center" />
            </div>
            <!-- image - end -->
      
            <!-- content - start -->
            <div class="flex w-full justify-start flex-col p-4 sm:w-1/2 sm:p-8 lg:w-3/5">
              <h2 class="mb-4 text-xl self-start font-bold md:text-2xl lg:text-2xl">Networking Event<br>hosted by ShopUp</h2>
              <span class="flex justify-start my-2 items-center">
                <div class="flex bg-white rounded-full p-5">
                  <img src="{{asset('dateicon.webp')}}" alt="date_icon" class="h-[20px]" draggable="false">
                </div>
                <p class="text-left ml-3">
                  16 - 22 December, 2023<br>
                  08:00 AM to 06:00 PM
                </p>
              </span>
              <span class="flex justify-start my-2 items-center">
                <div class="flex bg-white rounded-full p-5">
                  <img src="{{asset('locationicon.webp')}}" alt="date_icon" class="h-[20px]" draggable="false">
                </div>
                <p class="text-left ml-3">
                  64–65, Kazi Nazrul Islam Avenue,<br>Dhaka-1215  
                </p>
              </span>
              <div class="mt-auto self-start">
                <a href="#" class="inline-block rounded-full bg-white px-8 py-3 text-center text-sm font-semibold text-gray-800 outline-none ring-indigo-300 transition duration-100 hover:bg-gray-100 focus-visible:ring active:bg-gray-200 md:text-base">Register</a>
              </div>
            </div>
            <!-- content - end -->
          </div>
          <button class="p-3 pl-4 my-10 pr-4 rounded-full bg-[#eefff1] font-bold text-[#36b37e]">
            Discover BAN Resources
        </button>
        </div>
      </div>
    </section>
    <section class="flex flex-col justify-center items-center py-[100px] text-center w-full">
      <h1 class="text-[2em] font-bold">
        Our Partners
      </h1>
      <p class="mt-3 text-center text-[1em]">
        We co-invest alongside top-tier firms in the region.<br>We are mentors and advisors with the best accelerator programs in Bangladesh.A selection of our partners are represented here.
      </p>
      <div class="partnerLogos flex justify-between w-[70%] px-[100px]">
        <a href="#" class="p-6 border-box">
          <img src="{{asset('sajidafoundation.webp')}}" alt="sajida logo" class="h-[30px]">
        </a>
        <a href="#" class="p-6 border-box">
          <img src="{{asset('bidalogo.webp')}}" alt="bida logo" class="h-[30px]">
        </a>
        <a href="#" class="p-6 border-box">
          <img src="{{asset('foreignaffairsnetherland.webp')}}" alt="foreign affairs logo" class="h-[30px]">
        </a>
        <a href="#" class="p-6 border-box">
          <img src="{{asset('capital logo.webp')}}" alt="capital logo" class="h-[30px]">
        </a>
        <a href="#" class="p-6 border-box">
          <img src="{{asset('bangladesh venture capital.webp')}}" alt="bcv logo" class="h-[30px]">
        </a>
      </div>
    </section>
    <section class="">
      <div class="container flex flex-col w-[70%] justify-start p-4 mx-auto md:p-8">
        <h2 class="mb-3 text-4xl font-bold leading-none text-left sm:text-5xl">FAQ</h2>
        <p class="mb-12">
          Got a question? We've got answers.
        </p>
        <div class="grid gap-10 md:gap-8 sm:p-3 md:grid-cols-3 lg:px-12 xl:px-32">
          <div>
            <h3 class="font-semibold">Who are angel investors? How is it different from a Venture Capital?</h3>
            <p class="mt-1 text-gray-400">Angel investors are high-net-worth individuals and family offices who invest in early stage of businesses participating mostly in the seed round. Angel funding provides much needed high risk capital to the early stage companies, coming in along with or just subsequent to funding from friends and family. Angel investors </p>
            <a href="#">Read more</a>
          </div>
          <div>
            <h3 class="font-semibold">Why do I need Angel Investor?</h3>
            <p class="mt-1 text-gray-400">A good angel investor, apart from providing financial capital- i.e. money- aids the business in multiple ways: being successful businessperson, s/he can provide you strategic input, can add value to the governance process as a board member, can help you navigate business and operational challenges through his/her establish </p>
            <a href="#">Read more</a>
          </div>
          <div>
            <h3 class="font-semibold">What are the sectors where the angel investors of the network will invest?</h3>
            <p class="mt-1 text-gray-400">Our investors look at all stages of business and across all sectors from genuine start-ups to more established businesses. The key consideration is whether there are angel investors who have interest in the sector and they are convinced that such investment will yield them returns commensurate the Signiant  </p>
            <a href="#">Read more</a>
          </div>
          <div>
            <h3 class="font-semibold">What is the investment process like? How long does it take?</h3>
            <p class="mt-1 text-gray-400">At the beginning of each quarter, the team will conduct an initial screen of prospects to assess the investment thesis based on some set criteria such as scale potential, team strength, business and revenue model, funding need.
            </p>
            <a href="#">Read more</a>
          </div>
          <div>
            <h3 class="font-semibold">Are there any fees involved in submitting to the network?</h3>
            <p class="mt-1 text-gray-400">As a rule, angel networks do not charge founders/entrepreneurs for submissions and solicitations. We will typically seek to get a 2-4% commission on funds raised in the form of success fee.</p>
            <a href="#">Read more</a>
          </div>
          <div>
            <h3 class="font-semibold">How do you look at valuations?</h3>
            <p class="mt-1 text-gray-400">Valuing a startup, especially at the early stages without established track record, is quite difficult and requires application of significant judgement. At the stage at which angel investors participate, established valuation meth.. </p>
            <a href="#">Read more</a>
          </div>
        </div>
      </div>
    </section>
    <footer class="flex w-full mt-[100px]">
      <div class="flex w-1/4 justify-center py-[100px] px-[50px] border-box items-center" style="box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);">
        <img src="{{asset('logo.webp')}}" class="h-[50px]" alt="">
      </div>
      <section class="flex flex-col pt-[100px] px-[50px] border-box bg-[#1b7f69] w-full">
        <div class="flex flex-row justify-between w-full">
          {{-- Row 1 --}}
          <div class="flex flex-col text-white">
            <h1 class="font-bold">
              Bangladesh Angels
            </h1>
            <ul class="flex flex-col">
              <li>
                <a href="#">About Us</a>
              </li>
              <li>
                <a href="#">Contact Us</a>
              </li>
              <li>
                <a href="#">Angel Academy</a>
              </li>
              <li>
                <a href="#">FAQ</a>
              </li>
            </ul>
          </div>
          {{-- Row 2 --}}
          <div class="flex flex-col text-white ml-6">
            <h1 class="font-bold">
              For Startups
            </h1>
            <ul class="flex flex-col">
              <li>
                <a href="#">About Us</a>
              </li>
              <li>
                <a href="#">Contact Us</a>
              </li>
              <li>
                <a href="#">Angel Academy</a>
              </li>
              <li>
                <a href="#">FAQ</a>
              </li>
            </ul>
          </div>
          {{-- Row 3 --}}
          <div class="flex flex-col text-white ml-6">
            <h1 class="font-bold">
              For Angels
            </h1>
            <ul class="flex flex-col">
              <li>
                <a href="#">About Us</a>
              </li>
              <li>
                <a href="#">Contact Us</a>
              </li>
              <li>
                <a href="#">Angel Academy</a>
              </li>
              <li>
                <a href="#">FAQ</a>
              </li>
            </ul>
          </div>
          {{-- Socials --}}
          <div class="flex flex-col h-full  justify-between text-white ml-6">
            <span class="flex justify-end">
              <img src="{{asset('up_arrow.webp')}}" alt="up_arrow" class="h-[50px]">
            </span>
            <span class="flex flex-row w-full justify-between">
              <img src="{{asset('ig_icon.webp')}}" class="h-[40px]" alt="instagram">
              <img src="{{asset('linkedIn.webp')}}" class="h-[40px]" alt="linkedIn">
              <img src="{{asset('fb_icon.webp')}}" class="h-[40px]" alt="facebook">
              <img src="{{asset('twitter.webp')}}" class="h-[40px]" alt="twitter">
            </span>
          </div>
        </div>
        <div class="flex flex-row my-6 justify-between text-white">
          <small>© Bangladesh Angels. All rights reserved.</small>
          <div class="flex flex-row justify-between">
            <a href="#" class="underline mx-2">Refund Policy</a>
            <a href="#" class="underline mx-2">Terms & Conditions</a>
            <a href="#" class="underline mx-2">Privacy Policy</a>
          </div>
        </div>
      </section>
    </footer>
    <livewire:scripts />
</body>
</html>