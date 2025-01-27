@props([
    'buttons' => [],
])

<!-- Custom Buttons -->
<div class="w-full mb-1 md:mb-4">
    <div class="flex space-x-2">
        @foreach ($buttons as $button)
            <a href="{{ $button['url'] ?? '#' }}"
                class="relative group flex-1 flex justify-center items-center text-white {{ $button['bgColor'] ?? 'bg-gray-500' }} p-2 text-md md:hover:scale-105 transition-transform rounded">
                <!-- Button text -->
                <span>{{ $button['text'] ?? 'Button' }}</span>

                <!-- Closed Eye SVG When Accessible = False -->
                @if (!($button['accessible'] ?? true))
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="absolute inset-0 m-auto h-10 w-10 text-black opacity-0 transition-opacity duration-200 md:group-hover:opacity-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                @endif
            </a>
        @endforeach
    </div>
</div>
