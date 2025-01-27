<!--simple view to display profiles based on the users information-->
<x-app-layout>
<div class="container">
    <h1>Matches</h1>

    @if ($matches->isEmpty())
        <p>No matches found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Profile Picture</th>
                    <th>Nickname</th>
                    <th>One-Liner</th>
                    <th>Match Score</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matches as $match)
                    <tr>
                        <td>
                            <img src="{{ $match['facecard'] ?? 'default-image.jpg' }}" alt="Profile Picture" style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td>{{ $match['nickname'] }}</td>
                        <td>{{ $match['oneliner'] }}</td>
                        <td><strong>{{ $match['score'] }}</strong></td>
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

        {{-- Pagination Links --}}
        <div class="d-flex justify-content-center mt-4">
            @for ($i = 1; $i <= $totalPages; $i++)
                <a href="?page={{ $i }}" class="btn btn-primary mx-1">{{ $i }}</a>
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
