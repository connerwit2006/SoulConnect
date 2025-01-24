<x-app-layout>
    <div class="container">
        <h2>Users You Liked</h2>

        @if ($likedUsers->isEmpty())
            <p class="text-muted">You haven't liked anyone yet!</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile Picture</th>
                        <th>Nickname</th>
                        <th>One-Liner</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($likedUsers as $index => $profile)
                        <tr class="liked-row" data-id="{{ $profile->id }}">
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ $profile->face_card }}" alt="Profile Picture" class="profile-pic" style="width: 50px; height: 50px; border-radius: 50%;">
                            </td>
                            <td>{{ $profile->nickname }}</td>
                            <td>{{ $profile->one_liner }}</td>
                            <td>
                                <button class="btn btn-danger revert-like-btn" data-id="{{ $profile->id }}">Revert Like</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.revert-like-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const profileId = this.dataset.id;

                    fetch('{{ route("like.remove") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            liked_user_id: profileId,
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const row = document.querySelector(`.liked-row[data-id="${profileId}"]`);
                            row.remove();

                            if (!document.querySelectorAll('.liked-row').length) {
                                location.reload(); // Reload if no users are left
                            }
                        } else {
                            alert('An error occurred: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
</x-app-layout>
