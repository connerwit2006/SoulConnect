<div class="relative max-w-full mx-2 md:mx-4">
    <div
        class="relative max-w-full"
        x-data="{
            activeSlide: 0,
            slides: {{ Js::from($slides) }},
            showModal: false,
            selectedSlide: null,
        }"
    >
        <!-- Slides -->
        <template x-for="(slide, index) in slides" :key="index">
            <div
                x-show="activeSlide === index"
                class="h-64 sm:h-80 lg:h-96 flex items-center justify-center rounded-lg overflow-hidden">
                <img
                    :src="slide.image"
                    loading="lazy"
                    class="object-fill w-full h-full cursor-pointer"
                    alt="Slide Image"
                    x-on:click="selectedSlide = slide; showModal = true">
            </div>
        </template>

        <!-- Prev/Next Arrows -->
        <div class="absolute top-0 left-0 w-full h-full z-50 pointer-events-none">
            <!-- Previous Button -->
            <button
                class="absolute bg-gray-400 text-white md:hover:bg-accent font-bold md:hover:shadow-lg rounded-full w-12 h-12 sm:w-14 sm:h-14 z-50"
                style="left: -1rem; top: 50%; transform: translateY(-50%); pointer-events:auto;"
                x-on:click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1">
                &#8592;
            </button>

            <!-- Next Button -->
            <button
                class="absolute bg-gray-400 text-white md:hover:bg-accent font-bold md:hover:shadow-lg rounded-full w-12 h-12 sm:w-14 sm:h-14 z-50"
                style="right: -1rem; top: 50%; transform: translateY(-50%); pointer-events:auto;"
                x-on:click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1">
                &#8594;
            </button>
        </div>

        <!-- Buttons -->
        <div class="absolute w-full flex items-center justify-center px-4 bottom-4 z-40">
            <template x-for="(slide, index) in slides" :key="index">
                <button
                    class="w-3 h-3 sm:w-4 sm:h-4 mt-4 mx-1 sm:mx-2 rounded-full transition-colors duration-200 ease-out hover:bg-accent hover:shadow-lg"
                    :class="{
                        'bg-accent': activeSlide === index,
                        'bg-gray-400': activeSlide !== index
                    }"
                    x-on:click="activeSlide = index"
                ></button>
            </template>
        </div>

        <!-- Pop-up -->
        <div
            x-show="showModal"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75"
            x-on:click.self="showModal = false; selectedSlide = null">
            <div class="relative bg-white rounded-lg overflow-hidden max-w-full max-h-full">
                <button
                    class="absolute top-2 right-2 bg-gray-800 text-white rounded-full w-8 h-8 flex items-center justify-center"
                    x-on:click="showModal = false; selectedSlide = null">
                    &times;
                </button>
                <img
                    :src="selectedSlide?.image"
                    class="object-contain w-auto h-auto max-w-screen max-h-screen"
                    alt="Selected Image">
            </div>
        </div>
    </div>
</div>
