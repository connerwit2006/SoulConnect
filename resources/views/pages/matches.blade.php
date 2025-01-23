<x-app-layout>
    <div class="container">
        <h1>Matches</h1>
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
        
        @endif
    </div>
</x-app-layout>