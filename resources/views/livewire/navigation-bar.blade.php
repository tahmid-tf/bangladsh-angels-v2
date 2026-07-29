<section class="ban-site-nav" aria-label="Site header">
    <div class="ban-site-nav__shell">
        <a href="{{ route('home') }}" class="ban-site-nav__brand" title="Bangladesh Angels Network — home">
            <img
                src="{{ asset('logo.webp') }}"
                alt="Bangladesh Angels Network Logo"
                width="200"
                height="52"
            >
        </a>

        <nav class="ban-site-nav__desktop" aria-label="Primary navigation">
            <ul class="ban-site-nav__list">
                <li>
                    <a href="{{ route('angel-academy') }}" class="ban-site-nav__link" title="BAN Angel Academy — programme for angel investors">Angel Academy</a>
                </li>
                <li>
                    <a href="{{ route('startups') }}" class="ban-site-nav__link" title="Startups — portfolio, deals, pitch, and founder services">Startups</a>
                </li>
                <li class="ban-site-nav__dropdown">
                    <button type="button" class="ban-site-nav__dropdown-button" aria-haspopup="true">
                        <span>Investors</span>
                        <span class="ban-site-nav__chevron" aria-hidden="true">▾</span>
                    </button>
                    <div class="ban-site-nav__dropdown-panel">
                        {{-- <a href="{{ route('resources') }}#bwin">BWIN</a> --}}
                        <a href="{{ route('investor.signup') }}">BAN</a>
                    </div>
                </li>
                <li>
                    <a href="{{ route('resources') }}" class="ban-site-nav__link" title="DeckVue — events, webinars, and programs">DeckVue</a>
                </li>
                <li>
                    <a href="{{ route('team') }}" class="ban-site-nav__link" title="About Bangladesh Angels Network and our team">Our Team</a>
                </li>
            </ul>
        </nav>

        <div class="ban-site-nav__actions">
            @auth
                <div class="ban-site-nav__account">
                    <button type="button" onclick="toggleDropdown(event)" class="ban-site-nav__avatar-button" aria-label="Open account menu" aria-expanded="false" aria-controls="dropdown-menu">
                        <img src="{{ auth()->user()->getProfilePhotoUrl() }}" alt="User Avatar" class="ban-site-nav__avatar">
                    </button>
                    <div id="dropdown-menu" class="ban-site-nav__account-menu hidden">
                        <ul>
                            <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                            @if (auth()->user()->isAdmin())
                                <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                            @endif
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}" title="Log in to your Bangladesh Angels Network account" class="ban-site-nav__login">Login</a>
                <a href="{{ route('investor.signup') }}" title="Apply to become an angel investor with Bangladesh Angels Network" class="ban-site-nav__investor">Become an Investor</a>
            @endguest
        </div>

        <button id="mobile-menu-button" type="button" onclick="toggleMobileMenu()" class="ban-site-nav__mobile-toggle" aria-label="Open navigation menu" aria-expanded="false" aria-controls="mobile-menu">
            @auth
                <img src="{{ auth()->user()->getProfilePhotoUrl() }}" alt="User Avatar" class="ban-site-nav__avatar">
            @endauth
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

        <div id="mobile-menu" class="ban-site-nav__mobile-panel">
            <ul>
                @auth
                    <li><span class="ban-site-nav__mobile-profile">{{ auth()->user()->name }}</span></li>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                @endauth
                @guest
                    <li><a href="{{ route('investor.signup') }}" title="Apply to become an angel investor" class="ban-mobile-primary">Become an Investor</a></li>
                    <li><a href="{{ route('login') }}" title="Log in to your account" class="ban-mobile-secondary">Login</a></li>
                @endguest
                <li><a href="{{ route('angel-academy') }}" title="BAN Angel Academy — programme for angel investors">Angel Academy</a></li>
                <li><a href="{{ route('startups') }}" title="Startups — portfolio, deals, pitch, and founder services">Startups</a></li>
                <li>
                    <span>Investors</span>
                    <div class="ban-site-nav__mobile-subnav">
                        {{-- <a href="{{ route('resources') }}#bwin">BWIN</a> --}}
                        <a href="{{ route('investor.signup') }}">BAN</a>
                    </div>
                </li>
                <li><a href="{{ route('resources') }}" title="DeckVue — events, webinars, and programs">DeckVue</a></li>
                <li><a href="{{ route('team') }}" title="About Bangladesh Angels Network and our team">Our Team</a></li>
                @auth
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>

    @auth
        @if (!auth()->user()->email_verified_at)
            <div x-data="{ show: true }" x-show="show" class="ban-site-nav__verification">
                <button type="button" @click="show = false" class="ban-site-nav__verification-close" aria-label="Dismiss verification notice">×</button>
                <div>
                    <strong>Welcome!</strong> Please verify your email address by
                    <form method="POST" action="{{ route('verification.send') }}" class="inline">
                        @csrf
                        <button type="submit" class="font-bold underline cursor-pointer">clicking here</button>.
                    </form>
                </div>
                @if (session('status') === 'verification-link-sent' || session('verification-notice'))
                    <p class="mt-2 text-sm font-medium">
                        {{ session('verification-notice') ?? 'A new verification link has been sent to your email address.' }}
                    </p>
                @endif
            </div>
        @endif
    @endauth

    <script>
        function toggleDropdown(event) {
            if (event) event.stopPropagation();
            const dropdownMenu = document.getElementById('dropdown-menu');
            const trigger = document.querySelector('[aria-controls="dropdown-menu"]');
            if (!dropdownMenu || !trigger) return;

            const willOpen = dropdownMenu.classList.contains('hidden');
            dropdownMenu.classList.toggle('hidden');
            trigger.setAttribute('aria-expanded', String(willOpen));
        }

        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const trigger = document.getElementById('mobile-menu-button');
            if (!mobileMenu || !trigger) return;

            const willOpen = !mobileMenu.classList.contains('is-open');
            mobileMenu.classList.toggle('is-open');
            trigger.setAttribute('aria-expanded', String(willOpen));
            trigger.setAttribute('aria-label', willOpen ? 'Close navigation menu' : 'Open navigation menu');
        }

        document.addEventListener('click', function(event) {
            const dropdownMenu = document.getElementById('dropdown-menu');
            const dropdownTrigger = document.querySelector('[aria-controls="dropdown-menu"]');
            if (dropdownMenu && dropdownTrigger && !dropdownMenu.contains(event.target) && !dropdownTrigger.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
                dropdownTrigger.setAttribute('aria-expanded', 'false');
            }

            const mobileMenu = document.getElementById('mobile-menu');
            const mobileTrigger = document.getElementById('mobile-menu-button');
            if (mobileMenu && mobileTrigger && mobileMenu.classList.contains('is-open') && !mobileMenu.contains(event.target) && !mobileTrigger.contains(event.target)) {
                mobileMenu.classList.remove('is-open');
                mobileTrigger.setAttribute('aria-expanded', 'false');
                mobileTrigger.setAttribute('aria-label', 'Open navigation menu');
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key !== 'Escape') return;

            const dropdownMenu = document.getElementById('dropdown-menu');
            const dropdownTrigger = document.querySelector('[aria-controls="dropdown-menu"]');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileTrigger = document.getElementById('mobile-menu-button');

            if (dropdownMenu && dropdownTrigger) {
                dropdownMenu.classList.add('hidden');
                dropdownTrigger.setAttribute('aria-expanded', 'false');
            }
            if (mobileMenu && mobileTrigger) {
                mobileMenu.classList.remove('is-open');
                mobileTrigger.setAttribute('aria-expanded', 'false');
                mobileTrigger.setAttribute('aria-label', 'Open navigation menu');
            }
        });
    </script>
</section>
