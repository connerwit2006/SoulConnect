@props(['person' => null])

<section>
    <div class="xl:mx-auto mx-2 max-w-7xl p-2 sm:p-4 md:p-5 shadow-lg transition-all duration-500 mb-5 mt-6 rounded-lg border border-gray-200">
        <div class="flex flex-col md:flex-row md:gap-6">

            <div class="md:w-1/2 mx-2 md:mx-0">
                <!-- Placeholder for slideshow -->
                {{--   <img src="{{$person['img']}}" alt="" loading="lazy" class="object-fill">--}}
                <x-image-carousel :slides="[
                    ['image' => asset('image/HappyMen.jpg')],
                    ['image' => asset('image/HappyMen2.jpg')],
                    ['image' => asset('image/PersonOnPhone.jpg')],
                    ['image' => asset('image/HappyMen.jpg')],
                    ['image' => asset('image/HappyMen2.jpg')],
                    ['image' => asset('image/PersonOnPhone.jpg')]
            ]" />
            </div>

            <!-- Details -->
            <div class="md:w-1/2 md:py-4 mt-3 md:mt-0 mx-2 md:mx-0">

                <!-- Name And Location -->
                <div class="flex items-center justify-between text-gray-700 text-2xl title-font tracking-widest mb-4">
                    <h1 class="text-2xl title-font tracking-widest">{{ $person['name'] }}</h1>
                    <h2 class="text-lg tracking-widest">{{ $person['location'] }}</h2>
                </div>


                <div class="flex flex-col gap-y-2">
                    <div class="flex justify-between items-center">
                        <div class="mt-2 flex flex-row gap-8 tracking-widest text-gray-700">
                            <div class="title-font text-lg md:text-md">
                            Leeftijd: {{$person['age']}}
                            </div>
                            <div class="title-font text-lg md:text-md">
                                Gender: {{$person['gender']}}
                            </div>
                        </div>

                        <div class="flex flex-row gap-7">
                            <div x-data="{ isRed: false }">
                                <button @click="isRed = !isRed" class="mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        :class="{ 'fill-red-500 stroke-red-500': isRed, 'fill-none stroke-current': !isRed }" viewBox="0 0 24 24" stroke-width="1.5" class="size-7">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>
                                </button>
                            </div>

                            <div>
                                <div class="flex justify-center">
                                  <span class="relative flex h-3 w-3">
                                    <span class="absolute inline-flex h-full w-full animate-ping-slow rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex h-3 w-3 rounded-full bg-green-500"></span>
                                  </span>
                                </div>
                                <span class="text-green-500">Online</span>
                            </div>
                        </div>
                    </div>

                    <div class="leading-relaxed mt-2">
                        <p id="description" class="overflow-hidden text-ellipsis text-zinc-700" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; max-height: 4.5em;">
                            {{$person['description']}}                        </p>
                        <button id="readMoreBtn" class="text-blue-500 hover:underline">Verder lezen...</button>
                    </div>

                    <script>
                        document.getElementById("readMoreBtn").addEventListener("click", function () {
                            const description = document.getElementById("description");
                            if (description.style.webkitLineClamp === "3") {
                                description.style.webkitLineClamp = "unset";
                                description.style.maxHeight = "none";
                                this.textContent = "Minder lezen";
                            } else {
                                description.style.webkitLineClamp = "3";
                                description.style.maxHeight = "4.5em";
                                this.textContent = "Verder lezen...";
                            }
                        });
                    </script>

                    <div class="w-full mt-4 pb-3">
                        <div class="flex space-x-2 mt-2 gap-4 justify-end items-end">
                            <a href="#" rel="nofollow" class="flex-1 flex justify-center items-center text-white bg-accent py-2 sm:py-2 px-2 sm:px-4 md:py-5 text-md md:hover:scale-105 transition-transform rounded">
                                Stuur een bericht
                            </a>
                            <a href="#" rel="nofollow" class="flex-1 flex justify-center items-center text-white bg-zinc-500 opacity-50 py-2 sm:py-2 px-2 md:py-5 sm:px-4 text-md md:hover:scale-105 transition-transform rounded">
                                Rapporteer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
