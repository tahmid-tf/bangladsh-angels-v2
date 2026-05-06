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
                <a href="{{route('home')}}" class="block text-blue-600" href="#">
                    <img src="{{ asset('logo.webp') }}" class="h-[70px]" alt="logo">
                </a>

                <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                    Sign in to BD Angels
                </h1>

                <p class="mt-4 leading-relaxed text-gray-500">
                    New user? <a href="{{route('investor.signup')}}" class="font-bold text-green-800">Create an account</a>
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
                        <div class="relative mt-1">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="p-3 pr-12 border-box w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                            />
                            <button
                                type="button"
                                id="toggle-password"
                                class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700"
                                aria-label="Show password"
                                aria-pressed="false"
                            >
                                <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 3c-4.5 0-8.06 2.95-9.5 7 1.44 4.05 5 7 9.5 7s8.06-2.95 9.5-7c-1.44-4.05-5-7-9.5-7Zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                    <path d="M10 8a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                                </svg>
                                <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M3.28 2.22a.75.75 0 0 0-1.06 1.06l1.68 1.68A10.94 10.94 0 0 0 .5 10c1.44 4.05 5 7 9.5 7 1.94 0 3.72-.55 5.22-1.48l1.5 1.5a.75.75 0 1 0 1.06-1.06l-14.5-14.5ZM10 14a4 4 0 0 1-4-4c0-.72.19-1.4.52-1.98l5.46 5.46A3.98 3.98 0 0 1 10 14Zm9.5-4c-.62 1.75-1.73 3.28-3.17 4.4l-2.03-2.03A4 4 0 0 0 8.63 6.7L6.96 5.03A10.7 10.7 0 0 1 10 4c4.5 0 8.06 2.95 9.5 6Z" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <p class="text-sm text-gray-500 mt-1">Password requires uppercase, lowercase, number, and special character.</p>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const toggleButton = document.getElementById('toggle-password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');

        if (!passwordInput || !toggleButton || !eyeOpen || !eyeClosed) {
            return;
        }

        toggleButton.addEventListener('click', function () {
            const shouldShowPassword = passwordInput.type === 'password';
            passwordInput.type = shouldShowPassword ? 'text' : 'password';
            toggleButton.setAttribute('aria-label', shouldShowPassword ? 'Hide password' : 'Show password');
            toggleButton.setAttribute('aria-pressed', shouldShowPassword ? 'true' : 'false');
            eyeOpen.classList.toggle('hidden', shouldShowPassword);
            eyeClosed.classList.toggle('hidden', !shouldShowPassword);
        });
    });
</script>
</html>
