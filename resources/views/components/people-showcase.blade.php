@props(['title' => 'Niet beschikbaar', 'people' => [], 'id' => 'Niet beschikbaar'])

<section class="py-12 px-2 max-w-7xl mx-auto">
    <div class="flex flex-col justify-center">
        <div class="mx-auto sm:px-6 lg:px-8 mb-6">
            <div class="overflow-hidden shadow-md rounded-lg">
                <div class="text-2xl p-3 text-white bg-accent">
                  {{ $title }}
                </div>
            </div>
        </div>

        <div class="flex flex-wrap md:gap-1 p-3 md:p-0 transition-all duration-500">
            @foreach ($people as $person)
                <div class="p-2 w-1/2 md:w-1/4 lg:w-1/6 grow shadow-lg rounded-lg">
                    <a href="/detail/{{ $person['id'] }}" class="relative flex md:h-80 h-48 flex-col overflow-hidden group">
                        <img src="{{ $person['img'] }}" alt="{{ $person['name'] }}" loading="lazy" class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110">
                        <span class="pointer-events-none absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-zinc-900 opacity-40"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute inset-0 m-auto h-10 w-10 text-white opacity-0 transition-opacity duration-200 group-hover:opacity-100">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span class="relative mt-auto text-center text-2xl font-bold text-white">{{ $person['name'] }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

