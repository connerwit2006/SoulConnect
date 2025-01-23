@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Matches</h1>

    @if (isset($message))
        <p>{{ $message }}</p>
    @else
        <div class="row">
            @foreach ($matches as $match)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ $match['facecard'] }}" class="card-img-top" alt="Profile Picture">
                        <div class="card-body">
                            <h5 class="card-title">{{ $match['nickname'] }}</h5>
                            <p class="card-text">{{ $match['oneliner'] }}</p>
                            <p class="card-text"><strong>Match Score:</strong> {{ $match['score'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
