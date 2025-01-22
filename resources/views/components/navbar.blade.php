<header class="bg-white">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <!-- Logo -->
            <a href="/" class="flex-shrink-0">
                <img src="/image/logowithoutbg.png" alt="Logo" class="h-16 w-auto object-contain">
            </a>

            <!-- Desktop Navigation -->
            <div class="md:flex md:items-center md:gap-12" x-data="{ open: false }">

                <nav class="hidden md:block">
                    <ul class="flex items-center gap-6 text-sm text-gray-700">
                        <li><a class="hover:text-gray-500/75" href="#">Berichten</a></li>
                        <li><a class="hover:text-gray-500/75" href="#">Matches</a></li>
                        <li><a class="hover:text-gray-500/75" href="#">Likes</a></li>
                        <li><a class="hover:text-gray-500/75" href="#">Dashboard</a></li>
                        <li><a class="hover:text-gray-500/75" href="#">Profiel</a></li>
                    </ul>
                </nav>

                <!-- Desktop Buttons -->
                <div class="hidden md:flex md:gap-4">
                    <a class="rounded-md bg-accent px-5 py-2 text-sm font-medium text-white shadow hover:scale-105 transition-transform uppercase tracking-widest" href="#">
                        Login
                    </a>

                    <a class="rounded-md bg-accent px-5 py-2 text-sm font-medium text-white shadow hover:scale-105 transition-transform uppercase tracking-widest" href="#">
                        Register
                    </a>
                </div>

                <!-- Mobile Hamburger Menu -->
                <div class="block md:hidden">
                    <button @click="open = !open" class="p-2 text-gray-700">
                        <!-- Hamburger Icon -->
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>

                        <!-- X Icon -->
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Mobile Dropdown -->
                <div x-show="open" @click.away="open = false" class="absolute top-16 left-0 w-full bg-white shadow-md md:hidden">
                    <div class="flex flex-col gap-4 p-4 text-sm uppercase text-white tracking-widest font-medium text-center">

                        <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="#">Home</a>
                        <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="#">Berichten</a>
                        <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="#">Matches</a>
                        <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="#">Likes</a>
                        <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="#">Dashboard</a>
                        <a class="rounded-md bg-accent px-5 py-2 shadow w-full" href="#">Profiel</a>

                        <!-- Buttons With Space -->
                        <div class="flex gap-4 w-full">
                            <a class="rounded-md bg-accent px-5 py-2 shadow flex-1" href="#">Login</a>
                            <a class="rounded-md bg-accent px-5 py-2 shadow flex-1" href="#">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
