<header class="w-full bg-white relative">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            <!-- Logo -->
            <a href="/" class="flex-shrink-0">
                <img src="/image/logowithoutbg.png" alt="SoulConnectLogo" class="h-32 w-auto object-contain">
            </a>

            <!-- Desktop Navigation -->
            <div x-data="{ open: false, loggedIn: @json(auth()->check()) }" class="md:flex md:items-center md:gap-12">
                <nav class="hidden lg:block">
                    <div class="flex flex-row">
                        <ul class="flex items-center gap-8 text-md text-gray-700 tracking-wider">
                            <li><a class="hover:text-accent" href="#">Berichten</a></li>
                            <li><a class="hover:text-accent" href="#">Matches</a></li>
                            <li><a class="hover:text-accent" href="#">Likes</a></li>
                            <li><a class="hover:text-accent" href="#">Dashboard</a></li>
                        </ul>

                        <!-- Desktop Login/Sign-in Buttons -->
                        <div class="hidden md:flex md:gap-4 text-sm font-medium text-white tracking-widest uppercase">
                            <!-- Show Login/Signup =! logged-in -->
                            <template x-if="!loggedIn">
                                <div class="flex gap-4">
                                    <a class="rounded-md bg-accent px-5 py-2 shadow hover:scale-105 transition-transform ml-4" href="#">Login</a>
                                    <a class="rounded-md bg-accent px-5 py-2 shadow hover:scale-105 transition-transform" href="#">Register</a>

                                    <!-- TEST -->
                                    <button class="bg-red-500" @click="loggedIn = true">Simuleer Login</button>
                                </div>
                            </template>

                            <template x-if="loggedIn">
                                <a :href="`/profile/${user.id}`" class="ml-4 bg-accent px-5 py-2 rounded-md text-white">Mijn Profiel</a>
                            </template>
                        </div>
                    </div>
                </nav>

                <!-- Mobile Hamburger Menu -->
                <div class="block lg:hidden">
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
                </div>

                <!-- Mobile Dropdown -->
                <div x-show="open" @click.away="open = false"
                     class="absolute top-full left-0 w-full bg-white shadow-md lg:hidden z-10 transform origin-top"
                     x-transition:enter="transition duration-300 ease-in-out"
                     x-transition:enter-start="scale-y-0 opacity-0"
                     x-transition:enter-end="scale-y-100 opacity-100"
                     x-transition:leave="transition duration-300 ease-in"
                     x-transition:leave-start="scale-y-100 opacity-100"
                     x-transition:leave-end="scale-y-0 opacity-0">

                    <div class="flex flex-col gap-4 p-4 text-sm uppercase text-white tracking-widest font-medium text-center">
                        <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="#">Home</a>
                        <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="#">Berichten</a>
                        <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="#">Matches</a>
                        <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="#">Likes</a>
                        <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="#">Dashboard</a>

                        <!-- Show Login/Signup =! logged-in -->
                        <template x-if="!loggedIn">
                            <div class="flex gap-4 w-full">
                                <a class="rounded-md bg-accent px-5 py-2 shadow flex-1" href="#">Login</a>
                                <a class="rounded-md bg-accent px-5 py-2 shadow flex-1" href="#">Register</a>
                            </div>
                        </template>

                        <template x-if="loggedIn">
                            <a class="rounded-md bg-accent px-5 py-2 shadow flex-1" href="/profile">Mijn Profiel</a>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
