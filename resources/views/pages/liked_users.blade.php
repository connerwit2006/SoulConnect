<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-gray-700 text-3xl font-bold mb-6 text-center">Gebruikers die je leuk vindt</h2>

        @if ($likedUsers->isEmpty())
            <p class="text-center text-gray-700">Je hebt nog niemand geliked!</p>
        @else
            <div class="overflow-x-auto shadow-lg rounded-lg">
                <table class="table-auto w-full bg-white rounded-lg border border-gray-200">
                    <thead class="bg-gray-100 text-gray-600 text-sm uppercase">
                    <tr>
                        <th class="px-6 py-4 text-left">#</th>
                        <th class="px-6 py-4 text-left">Profiel foto</th>
                        <th class="px-6 py-4 text-left">Bijnaam</th>
                        <th class="px-6 py-4 text-left">One-Liner</th>
                        <th class="px-6 py-4 text-center">Acties</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">
                    @foreach ($likedUsers as $index => $profile)
                        <tr class="border-t hover:bg-gray-50 transition" data-id="{{ $profile->id }}">
                            <td class="px-6 py-4">{{ ($likedUsers->currentPage() - 1) * $likedUsers->perPage() + $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <img src="{{ $profile->face_card }}" alt="Profile Picture"
                                    class="w-12 h-12 rounded-full object-cover border border-gray-300">
                            </td>
                            <td class="px-6 py-4">{{ $profile->nickname }}</td>
                            <td class="px-6 py-4">{{ $profile->one_liner }}</td>
                            <td class="px-6 py-4 text-center">
                                <button class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg revert-like-btn transition"
                                    data-id="{{ $profile->id }}">
                                    Revert Like
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            <div class="flex justify-center mt-6 space-x-2">
                {{ $likedUsers->links('pagination::tailwind') }}
            </div>
        @endif
    </div>

    <script>
        document.querySelectorAll('.revert-like-btn').forEach(button => {
            button.addEventListener('click', function() {
                const profileId = this.getAttribute('data-id');

                // Send the revert like request
                fetch("{{ route('like.remove') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        liked_user_id: profileId,
                        action: 'revert',
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.querySelector(`tr[data-id='${profileId}']`).remove();
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
