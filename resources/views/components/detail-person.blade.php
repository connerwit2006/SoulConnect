@props(['person' => null, 'slides' => []])

<section class="pt-12">
    <div class="xl:mx-auto mx-2 max-w-7xl p-2 sm:p-4 md:p-5 shadow-lg transition-all duration-500 mb-5 rounded-lg border border-gray-200">
        <div class="flex flex-col md:flex-row md:gap-6">

            <!-- Image Carousel -->
            <div class="md:w-1/2 mx-2 md:mx-0">
                <x-image-carousel :slides="$slides" />
            </div>

            <!-- Details -->
            <div class="md:w-1/2 md:py-4 mt-3 md:mt-0 mx-2 md:mx-0">
                <div class="flex items-center justify-between text-gray-700 text-2xl title-font tracking-widest mb-4">
                    <h1 class="text-2xl title-font tracking-widest">{{ $person['name'] }}</h1>
                    <h2 class="text-lg tracking-widest">{{ $person['location'] }}</h2>
                </div>

                <div class="flex flex-col gap-y-2">
                    <div class="flex justify-between items-center">
                        <div class="mt-2 flex flex-row gap-8 tracking-widest text-gray-700">
                            <div class="title-font text-lg md:text-md">
                                Leeftijd: {{ $person['age'] }}
                            </div>
                            <div class="title-font text-lg md:text-md">
                                Gender: {{ $person['gender'] }}
                            </div>
                        </div>
                        <div class="flex flex-row gap-7">
                            <!-- Like Button -->
                            <x-likeButton />

                            <!-- Online Indicator -->
                            <x-onlineIndicator />
                        </div>
                    </div>

                    <!-- Decription -->
                    <x-description :description="$person['description']" />

                    <!-- Send Message Button -->
                    <x-buttons :buttons="[
                        ['text' => 'Stuur een bericht', 'url' => '#', 'bgColor' => 'bg-accent', 'accessible' => false]
                    ]" />

                    <!-- Report Button -->
                    <x-buttons :buttons="[
                        ['text' => 'Rapporteer', 'url' => '#', 'bgColor' => 'bg-zinc-500', 'opacity' => 'opacity-50', 'accessible' => true ]
                    ]" />
                </div>
            </div>
        </div>
    </div>
</section>
