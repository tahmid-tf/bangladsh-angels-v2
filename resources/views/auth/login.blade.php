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
<x-auth-session-status class="mb-4" :status="session('status')" />

<section class="bg-white w-full ">
    <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
        <!-- Image Section: Now on the left -->
        <aside class="relative block h-16 lg:order-first lg:col-span-5 lg:h-full xl:col-span-6">
            <img
                alt=""
                src="{{ asset('green_polygon_background.webp') }}"
                class="absolute inset-0 h-full w-full object-cover"
            />
        </aside>

        <!-- Form Section: Now on the right -->
        <main
            class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6"
        >
            <div class="max-w-xl lg:max-w-3xl">
                <a class="block text-blue-600" href="#">
                    <img src="{{ asset('logo.webp') }}" class="h-[70px]" alt="logo">
                </a>

                <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                    Sign in to BD Angels
                </h1>

                <p class="mt-4 leading-relaxed text-gray-500">
                    New user? <a href="{{route('investor.signup')}}">Create an account</a>
                </p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="col-span-6 sm:col-span-3 my-3">
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{old('email')}}"
                            class="mt-1 w-full p-3 border-box rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="mt-1 p-3 border-box w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                        />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    </div>
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
                        <button
                            type="submit"
                            class="inline-block shrink-0 rounded-full mt-6 border border-[#36b37e] bg-[#36b37e] px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500"
                        >
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</section>
</html>
    