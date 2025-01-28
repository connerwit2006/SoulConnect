<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-gray-700 text-3xl font-bold mb-6 text-center">Gebruikers die jou leuk vinden</h1>

        @if ($likedBy->isEmpty())
            <p class="text-center text-gray-700">Er zijn nog geen gebruikers die jou leuk vonden.</p>
        @else
            <div class="overflow-x-auto shadow-lg rounded-lg">
                <table class="table-auto w-full bg-white rounded-lg border border-gray-200">
                    <thead class="bg-gray-100 text-gray-600 text-sm uppercase">
                    <tr>
                        <th class="px-6 py-4 text-left">#</th>
                        <th class="px-6 py-4 text-left">Profiel foto</th>
                        <th class="px-6 py-4 text-left">Bijnaam</th>
                        <th class="px-6 py-4 text-left">One-Liner</th>
                        <th class="px-6 py-4 text-center">Datum geliked</th>
                        <th class="px-6 py-4 text-center">Actie</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">
                    @foreach ($likedBy as $index => $profile)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="px-6 py-4">{{ ($likedBy->currentPage() - 1) * $likedBy->perPage() + $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <img src="image/detail1.jpg" alt="Profile Picture"
                                    class="w-12 h-12 rounded-full object-cover border border-gray-300">
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-gray-800">{{ $profile->nickname }}</span>
                            </td>
                            <td class="px-6 py-4">{{ $profile->one_liner }}</td>
                            <td class="px-6 py-4 text-center">
                                {{ \Carbon\Carbon::parse($profile->likesReceived->first()->created_at)->format('l, F j, Y \a\t h:i A') }}
                            </td>
                            <td class="px-6 py-4 text-center space-x-2 space-y-2">
                                <button class="bg-accent text-white font-medium py-2 px-4 rounded-lg like-back-btn hover:scale-105 transition-transform"
                                    data-id="{{ $profile->id }}">
                                    Like Terug
                                </button>
                                <button class="bg-red-500 text-white font-medium py-2 px-4 rounded-lg ignore-btn hover:scale-105 transition-transform"
                                    data-id="{{ $profile->id }}">
                                    Negeer
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            <div class="flex justify-center mt-6 space-x-2">
                {{ $likedBy->links() }}
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.like-back-btn').forEach(button => {
                button.addEventListener('click', async function () {
                    const userId = this.dataset.id;

                    try {
                        const response = await fetch('/like-back', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ liked_user_id: userId })
                        });

                        const result = await response.json();

                        if (result.success) {
                            this.closest('tr').remove();
                        } else {
                            alert('Something went wrong: ' + result.message);
                        }
                    } catch (error) {
                        console.error('Error liking back:', error);
                    }
                });
            });

            document.querySelectorAll('.ignore-btn').forEach(button => {
                button.addEventListener('click', async function () {
                    const userId = this.dataset.id;

                    try {
                        const response = await fetch('/ignore', {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ liked_user_id: userId })
                        });

                        const result = await response.json();

                        if (result.success) {
                            this.closest('tr').remove();
                        } else {
                            alert('Something went wrong: ' + result.message);
                        }
                    } catch (error) {
                        console.error('Error ignoring user:', error);
                    }
                });
            });
        });
    </script>
</x-app-layout>
