<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold mb-6 text-center">Dagelijkste top 5 matches</h1>

        @if ($matches->isEmpty())
            <p class="text-center text-gray-500">Geen matches gevonden.</p>
        @else
            <!-- Table Container For Matches -->
            <div class="overflow-x-auto shadow-lg rounded-lg">
                <table class="table-auto w-full bg-white rounded-lg border border-gray-200">
                    <!-- Table Header -->
                    <thead class="bg-gray-100 text-gray-600 text-sm uppercase">
                    <tr>
                        <th class="px-6 py-4 text-left">Profiel foto</th>
                        <th class="px-6 py-4 text-left">Nickname</th>
                        <th class="px-6 py-4 text-left">One Liner</th>
                        <th class="px-6 py-4 text-center">Match Score</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">
                    @foreach ($matches as $match)
                        <!-- Table Rows -->
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <img src="{{ $match['facecard'] }}" alt="Profile Picture"
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
        @endif
    </div>

    <script>
        document.querySelectorAll('.like-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');

                // Send The Like Request Using Fetch API
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
                            this.classList.remove('bg-accent', 'hover:bg-red-500');
                            this.classList.add('bg-accent', 'cursor-not-allowed');
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
