<x-app-layout>
    <div class="container">
        <h2>Mutual Likes</h2>

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
            <tbody id="mutual-likes-container">
                @foreach ($mutualLikes as $index => $profile)
                <tr class="mutual-like-row" data-id="{{ $profile->id }}">
                    <td>{{ ($mutualLikes->currentPage() - 1) * $mutualLikes->perPage() + $index + 1 }}</td>
                    <td>
                        <img src="{{ $profile->face_card }}" alt="Profile Picture" class="profile-pic" style="width: 50px; height: 50px; border-radius: 50%;">
                    </td>
                    <td>{{ $profile->nickname }}</td>
                    <td>{{ $profile->one_liner }}</td>
                    <td>
                        <!-- Chat button that redirects to the specific user's chat page -->
                        <a href="{{ route('chat.showChat', $profile->id) }}" class="btn btn-primary">Chat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $mutualLikes->links() }} <!-- Pagination links -->

        <p id="no-mutual-likes" class="text-muted" style="display: {{ count($mutualLikes) ? 'none' : 'block' }};">No mutual likes yet.</p>
    </div>
</x-app-layout>
