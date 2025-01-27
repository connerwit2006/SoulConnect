<x-app-layout>
    <div class="container">
        <h1>Daily Top 5 Matches</h1>
        @if ($matches->isEmpty())
        <p>No matches found.</p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Profile Picture</th>
                    <th scope="col">Nickname</th>
                    <th scope="col">One Liner</th>
                    <th scope="col">Match Score</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matches as $match)
                <tr>
                    <td><img src="{{ $match['facecard'] }}" class="card-img-top" alt="Profile Picture" style="width: 50px; height: 50px; object-fit: cover;"></td>
                    <td>{{ $match['nickname'] }}</td>
                    <td>{{ $match['oneliner'] }}</td>
                    <td>{{ $match['score'] }}</td>
                    <td>
                        @if ($match['liked'])
                            <button class="btn btn-secondary" disabled>Liked</button>
                        @else
                            <button class="btn btn-success like-btn" data-user-id="{{ $match['id'] }}">Like</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
