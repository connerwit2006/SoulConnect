<header class="w-full bg-white relative">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            <!-- Logo -->
            <a href="/" class="flex-shrink-0">
                <img src="/image/logowithoutbg.png" alt="SoulConnectLogo" class="h-32 w-auto object-contain">
            </a>

            <!-- Desktop Navigation -->
            <div x-data="{ loggedIn: @json(auth()->check()), dropdownOpen: false }" class="md:flex md:items-center md:gap-12">
                <nav class="hidden lg:block">
                    <div class="flex flex-row">
                        <ul class="flex items-center gap-8 text-md text-gray-700 tracking-wider">
                            <li><a class="hover:text-accent" href="#">Berichten</a></li>
                            <li><a class="hover:text-accent" href="{{ route('matches.index') }}">Matches</a></li>
                            <li><a class="hover:text-accent" href="{{ route('like.likedUsers') }}">Likes</a></li>
                            <li><a class="hover:text-accent mr-6" href="{{ route('dashboard') }}">Dashboard</a></li>
                        </ul>

                        <!-- Desktop Login/Sign-in Buttons -->
                        <div class="hidden md:flex md:gap-4 text-sm font-medium text-white tracking-widest uppercase">
                            @auth
                                <div
                                    class="relative"
                                    @mouseenter="dropdownOpen = true"
                                    @mouseleave="dropdownOpen = false"
                                >
                                    <!-- User Name with Dropdown Arrow -->
                                    <a
                                        href="/profile"
                                        class="flex items-center gap-2 bg-accent px-5 py-2 rounded-md text-white"
                                    >
                                        {{ Auth::user()->name }}
                                        <!-- Down Arrow -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </a>

                                    <!-- Dropdown Menu -->
                                    <div
                                        x-show="dropdownOpen"
                                        x-transition
                                        class="absolute mt-2 right-0 bg-white shadow-lg rounded-md w-48 z-10"
                                    >
                                        <form method="POST" action="{{ route('logout') }}" class="p-4">
                                            @csrf
                                            <button type="submit" class="w-full text-left text-gray-700 hover:text-accent">
                                                {{ __('Uitloggen') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="flex gap-4">
                                    <a class="rounded-md bg-accent px-5 py-2 shadow hover:scale-105 transition-transform ml-4" href="{{ route('login') }}">Login</a>
                                    <a class="rounded-md bg-accent px-5 py-2 shadow hover:scale-105 transition-transform" href="{{ route('register') }}">Register</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </nav>

                <!-- Mobile Hamburger Menu -->
                <div x-data="{ open: false }" class="block lg:hidden">
                    <button @click="open = !open" class="p-2 text-gray-700">
                        <!-- Hamburger SVG -->
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-9 w-9">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>

                        <!-- X SVG -->
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-9 w-9">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Mobile Dropdown -->
                    <div x-show="open" @click.away="open = false"
                        x-transition
                        class="absolute top-full left-0 w-full bg-white shadow-md lg:hidden z-50 transform origin-top">
                        <div class="flex flex-col gap-4 p-4 text-sm uppercase text-white tracking-widest font-medium text-center">
                            @auth
                                <a href="/profile" class="text-xl font-semibold text-gray-700"> {{ Auth::user()->name }}</a>
                            @endauth

                            <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="#">Berichten</a>
                            <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="{{ route('matches.index') }}">Matches</a>
                            <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="{{ route('like.likedUsers') }}">Likes</a>
                            <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="{{ route('dashboard') }}">Dashboard</a>

                            @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="rounded-md bg-accent px-5 py-2 shadow w-full">
                                        {{ __('UITLOGGEN') }}
                                    </button>
                                </form>
                            @else
                                <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="{{ route('login') }}">Login</a>
                                <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="{{ route('register') }}">Register</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
