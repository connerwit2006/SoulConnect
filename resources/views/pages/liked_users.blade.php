<!--simple view for profiles that the logged in user has liked-->
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
                            <td>{{ ($likedUsers->currentPage() - 1) * $likedUsers->perPage() + $index + 1 }}</td>
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

            {{ $likedUsers->links() }}
        @endif
    </div>
</x-app-layout>
