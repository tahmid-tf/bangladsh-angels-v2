<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    <title>Member Login | Bangladesh Angels Network</title>
    <link rel="icon" type="image/webp" href="{{ asset('icon.webp') }}">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <livewire:styles />
</head>
<body class="ban-auth-page">
    <main class="ban-auth-shell">
        <section class="ban-auth-visual" aria-labelledby="ban-auth-intro-heading">
            <a href="{{ route('home') }}" class="ban-auth-brand" aria-label="Bangladesh Angels Network homepage">
                <img src="{{ asset('logo.webp') }}" alt="Bangladesh Angels Network" width="580" height="142">
            </a>

            <div class="ban-auth-visual__copy">
                <p class="ban-auth-kicker">Member platform</p>
                <h1 id="ban-auth-intro-heading">Invest with perspective.</h1>
                <p>Access curated opportunities, portfolio insights, and the investor community behind Bangladesh&rsquo;s next generation of companies.</p>

                <ul class="ban-auth-benefits" aria-label="Member platform benefits">
                    <li><span aria-hidden="true">01</span> Curated deal flow</li>
                    <li><span aria-hidden="true">02</span> Shared diligence</li>
                    <li><span aria-hidden="true">03</span> Founder updates</li>
                </ul>
            </div>

            <figure class="ban-auth-visual__figure">
                <img src="{{ asset('investor_cover.webp') }}" alt="BAN investors and ecosystem leaders" width="1500" height="783">
                <figcaption><span aria-hidden="true"></span> Capital. Community. Conviction.</figcaption>
            </figure>
        </section>

        <section class="ban-auth-panel" aria-labelledby="ban-login-heading">
            <a href="{{ route('home') }}" class="ban-auth-back"><span aria-hidden="true">&larr;</span> Back to website</a>

            <div class="ban-auth-form-wrap">
                <x-auth-session-status class="ban-auth-status" :status="session('status')" />

                <header class="ban-auth-form-heading">
                    <p class="ban-auth-kicker">Member access</p>
                    <h2 id="ban-login-heading">Welcome back.</h2>
                    <p>New to BAN? <a href="{{ route('investor.signup') }}">Apply to become an investor</a>.</p>
                </header>

                <div class="ban-auth-google">
                    <x-google-auth-button intent="login" label="Continue with Google" />
                    <x-input-error :messages="$errors->get('google')" class="ban-auth-error" />
                </div>

                <div class="ban-auth-divider" role="separator">
                    <span>or sign in with email</span>
                </div>

                <form method="POST" action="{{ route('login') }}" class="ban-auth-form">
                    @csrf

                    <div class="ban-auth-field">
                        <label for="email">Email address</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            autocomplete="username"
                            placeholder="you@company.com"
                            required
                            autofocus
                            @error('email') aria-invalid="true" @enderror
                        >
                        <x-input-error :messages="$errors->get('email')" class="ban-auth-error" />
                    </div>

                    <div class="ban-auth-field">
                        <div class="ban-auth-field__heading">
                            <label for="password">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">Forgot password?</a>
                            @endif
                        </div>

                        <div class="ban-auth-password">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                autocomplete="current-password"
                                placeholder="Enter your password"
                                required
                                @error('password') aria-invalid="true" @enderror
                            >
                            <button
                                type="button"
                                id="toggle-password"
                                aria-label="Show password"
                                aria-pressed="false"
                            >
                                <svg id="eye-open" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10 3c-4.5 0-8.06 2.95-9.5 7 1.44 4.05 5 7 9.5 7s8.06-2.95 9.5-7c-1.44-4.05-5-7-9.5-7Zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                    <path d="M10 8a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                                </svg>
                                <svg id="eye-closed" class="hidden" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M3.28 2.22a.75.75 0 0 0-1.06 1.06l1.68 1.68A10.94 10.94 0 0 0 .5 10c1.44 4.05 5 7 9.5 7 1.94 0 3.72-.55 5.22-1.48l1.5 1.5a.75.75 0 1 0 1.06-1.06l-14.5-14.5ZM10 14a4 4 0 0 1-4-4c0-.72.19-1.4.52-1.98l5.46 5.46A3.98 3.98 0 0 1 10 14Zm9.5-4c-.62 1.75-1.73 3.28-3.17 4.4l-2.03-2.03A4 4 0 0 0 8.63 6.7L6.96 5.03A10.7 10.7 0 0 1 10 4c4.5 0 8.06 2.95 9.5 6Z" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="ban-auth-error" />
                    </div>

                    <label for="remember_me" class="ban-auth-remember">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>Keep me signed in on this device</span>
                    </label>

                    <button type="submit" class="ban-auth-submit">
                        Sign in <span aria-hidden="true">&rarr;</span>
                    </button>
                </form>
            </div>

            <p class="ban-auth-panel__note">Bangladesh Angels Network &middot; Member access</p>
        </section>
    </main>

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
</body>
</html>
