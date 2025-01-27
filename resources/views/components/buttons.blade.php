@props([
    'buttons' => [],
])

<!-- Custom Buttons-->
<div class="w-full mt-4 pb-3">
    <div class="flex space-x-2 mt-2 gap-4">
        @foreach ($buttons as $button)
            <a href="{{ $button['url'] ?? '#' }}"
                rel="nofollow"
                class="flex-1 flex justify-center items-center text-white {{ $button['bgColor'] ?? 'bg-gray-500' }} {{ $button['opacity'] ?? '' }} p-2 text-md md:hover:scale-105 transition-transform rounded">
                {{ $button['text'] ?? 'Button' }}
            </a>
        @endforeach
    </div>
</div>
