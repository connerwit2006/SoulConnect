<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Matches</h1>

        @if ($matches->isEmpty())
            <p class="text-center text-gray-500">No matches found.</p>
        @else
            <div class="overflow-x-auto shadow-lg rounded-lg">
                <table class="table-auto w-full bg-white rounded-lg border border-gray-200">
                    <thead class="bg-gray-100 text-gray-600 text-sm uppercase">
                    <tr>
                        <th class="px-6 py-4 text-left">Profiel foto</th>
                        <th class="px-6 py-4 text-left">Bijnaam</th>
                        <th class="px-6 py-4 text-left">One-Liner</th>
                        <th class="px-6 py-4 text-center">Match Score</th>
                        <th class="px-6 py-4 text-center">Acties</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">
                    @foreach ($matches as $match)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <img src="{{ $match['facecard'] ?? 'default-image.jpg' }}" alt="Profile Picture"
                                    class="w-12 h-12 rounded-full object-cover border border-gray-300">
                            </td>
                            <td class="px-6 py-4">{{ $match['nickname'] }}</td>
                            <td class="px-6 py-4">{{ $match['oneliner'] }}</td>
                            <td class="px-6 py-4 text-center font-semibold text-accent">{{ $match['score'] }}</td>
                            <td class="px-6 py-4 text-center">
                                @if ($match['liked'])
                                    <button class="bg-accent text-white font-medium py-2 px-4 rounded-lg cursor-not-allowed">
                                        Liked
                                    </button>
                                @else
                                    <button class="bg-gray-300 hover:bg-accent text-white font-medium py-2 px-4 rounded-lg like-btn transition"
                                        data-user-id="{{ $match['id'] }}">
                                        Like
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            <div class="flex justify-center mt-6 space-x-2">
                @for ($i = 1; $i <= $totalPages; $i++)
                    <a href="?page={{ $i }}"
                        class="px-4 py-2 rounded-lg border {{ $i == request()->get('page', 1) ? 'bg-accent text-white' : 'bg-white text-gray-700 hover:bg-accent' }}">
                        {{ $i }}
                    </a>
                @endfor
            </div>
        @endif
    </div>

    <script>
        document.querySelectorAll('.like-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');

                // Send the like request
                fetch("{{ route('like.interact') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        liked_user_id: userId,
                        action: 'like',
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.disabled = true;
                            this.classList.remove('bg-white', 'hover:bg-accent');
                            this.classList.add('bg-gray-400', 'cursor-not-allowed');
                            this.textContent = 'Liked';
                        } else {
                            alert('Something went wrong.');
                        }
                    })
                    .catch(error => {
                        alert('Error: ' + error);
                    });
            });
        });
    </script>
</x-app-layout>
