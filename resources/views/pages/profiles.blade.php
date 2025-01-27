<!--simple view to load profiles for the logged in user to like-->
<x-app-layout>
    <div class="container">
        <h2>Profiles</h2>

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
            <tbody id="profiles-container">
                @foreach ($profiles as $index => $profile)
                    <tr class="profile-row" data-id="{{ $profile->id }}">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <img src="{{ $profile->face_card }}" alt="Profile Picture" class="profile-pic" style="width: 50px; height: 50px; border-radius: 50%;">
                        </td>
                        <td>{{ $profile->nickname }}</td>
                        <td>{{ $profile->one_liner }}</td>
                        <td>
                            <button class="btn btn-success like-btn" data-action="like" data-id="{{ $profile->id }}">Like</button>
                            <button class="btn btn-danger skip-btn" data-action="skip" data-id="{{ $profile->id }}">Skip</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p id="no-profiles" class="text-muted" style="display: none;">No more profiles to show.</p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let preloadedProfiles = []; // Store preloaded profiles
            const container = document.getElementById('profiles-container');
            const noProfilesMessage = document.getElementById('no-profiles');

            // Function to fetch new profiles
            async function fetchProfiles() {
                try {
                    const response = await fetch('{{ route("profiles.fetch") }}');
                    const data = await response.json();

                    if (data.success && data.profiles.length > 0) {
                        preloadedProfiles = data.profiles; // Save profiles in memory
                    } else {
                        noProfilesMessage.style.display = 'block';
                    }
                } catch (error) {
                    console.error('Error fetching profiles:', error);
                }
            }

            // Function to append preloaded profiles to the table
            function appendPreloadedProfiles() {
                preloadedProfiles.forEach((profile, index) => {
                    const row = document.createElement('tr');
                    row.classList.add('profile-row');
                    row.setAttribute('data-id', profile.id);

                    row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>
                            <img src="${profile.face_card}" alt="Profile Picture" class="profile-pic" style="width: 50px; height: 50px; border-radius: 50%;">
                        </td>
                        <td>${profile.nickname}</td>
                        <td>${profile.one_liner}</td>
                        <td>
                            <button class="btn btn-success like-btn" data-action="like" data-id="${profile.id}">Like</button>
                            <button class="btn btn-danger skip-btn" data-action="skip" data-id="${profile.id}">Skip</button>
                        </td>
                    `;
                    container.appendChild(row);
                });

                preloadedProfiles = []; // Clear preloaded profiles after appending
                attachEventListeners(); // Reattach event listeners to new buttons
            }

            // Attach event listeners to buttons
            function attachEventListeners() {
                document.querySelectorAll('.like-btn, .skip-btn').forEach(button => {
                    button.addEventListener('click', async function () {
                        const action = this.dataset.action; // 'like' or 'skip'
                        const profileId = this.dataset.id; // Profile ID

                        try {
                            const response = await fetch('{{ route("like.interact") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                                body: JSON.stringify({
                                    liked_user_id: profileId,
                                    action: action,
                                }),
                            });
                            const data = await response.json();

                            if (data.success) {
                                const profileRow = document.querySelector(`.profile-row[data-id="${profileId}"]`);
                                profileRow.remove();

                                // Trigger preloading when only 2 profiles are left
                                if (document.querySelectorAll('.profile-row').length === 2) {
                                    fetchProfiles();
                                }

                                // Append preloaded profiles if no profiles are left
                                if (!document.querySelectorAll('.profile-row').length) {
                                    appendPreloadedProfiles();
                                }
                            } else {
                                alert('An error occurred: ' + data.message);
                            }
                        } catch (error) {
                            console.error('Error:', error);
                        }
                    });
                });
            }

            // Initial setup
            attachEventListeners();
        });
    </script>
</x-app-layout>
