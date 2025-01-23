<!-- table view for following function public function findTopMatches(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);

        // Filter potential matches
        $otherUsers = User::where('id', '!=', $userId)->get();

        // Calculate match scores and format output
        $matches = $otherUsers->map(function ($otherUser) use ($user) {
            $matchScore = $this->calculateMatchScore($user, $otherUser);

            return [
                'facecard' => $otherUser->face_card, // Image or null
                'nickname' => $otherUser->nickname,
                'oneliner' => $otherUser->one_liner,
                'score' => $matchScore,
            ];
        });

        // Sort matches by score in ascending order (lower scores first)
        $sortedMatches = $matches->sortByDesc('score')->values();

        // Pass only relevant data to the view
        //dd($sortedMatches);
        return view('pages.topmatches', ['matches' => $sortedMatches->take(5)]);
        } -->

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
                </tr>
            </thead>
            <tbody>
                @foreach ($matches as $match)
                <tr>
                    <td><img src="{{ $match['facecard'] }}" class="card-img-top" alt="Profile Picture"></td>
                    <td>{{ $match['nickname'] }}</td>
                    <td>{{ $match['oneliner'] }}</td>
                    <td>{{ $match['score'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</x-app-layout>