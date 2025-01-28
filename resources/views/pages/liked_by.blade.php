<!--simple view for profiles that liked the logged in user-->
<x-app-layout>
    <div class="container">
        <h2>Users Who Liked You</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Profile Picture</th>
                    <th>Nickname</th>
                    <th>One-Liner</th>
                    <th>Date Liked</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="liked-by-container">
                @foreach ($likedBy ?? [] as $index => $profile)
                <tr class="liked-row" data-id="{{ $profile->id }}">
                    <td>{{ ($likedBy->currentPage() - 1) * $likedBy->perPage() + $index + 1 }}</td>
                    <td>
                        <img src="{{ $profile->face_card }}" alt="Profile Picture" class="profile-pic" style="width: 50px; height: 50px; border-radius: 50%;">
                    </td>
                    <td>{{ $profile->nickname }}</td>
                    <td>{{ $profile->one_liner }}</td>
                    <td>{{ \Carbon\Carbon::parse($profile->likesReceived->first()->created_at)->format('l, F j, Y \a\t h:i A') }}</td>
                    <td>
                        <button class="btn btn-success like-back-btn" data-id="{{ $profile->id }}">Like Back</button>
                        <button class="btn btn-danger ignore-btn" data-id="{{ $profile->id }}">Ignore</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $likedBy->links() }}

        <p id="no-likes" class="text-muted" style="display: {{ count($likedBy) ? 'none' : 'block' }};">No users have liked you yet.</p>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Handle "Like Back" button click
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
                        //alert('Liked back successfully!');
                        this.closest('tr').remove();
                    } else {
                        alert('Something went wrong: ' + result.message);
                    }
                } catch (error) {
                    console.error('Error liking back:', error);
                }
            });
        });

        // Handle "Ignore" button click
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
