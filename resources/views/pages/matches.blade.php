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
</x-app-layout>
