@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Your Favorite Articles</h1>

        @if($favorites->isEmpty())
            <div class="alert alert-info mt-3">
                You have no favorite articles yet.
            </div>
        @else
            <div class="list-group mt-3">
                @foreach($favorites as $article)
                    <div class="list-group-item">
                        <h4>
                            <a href="{{ url('/news/' . $article->id) }}">{{ $article->title }}</a>
                        </h4>
                        <p><strong>Category:</strong> {{ $article->category }}</p>
                        <p><strong>Source:</strong> {{ $article->source }}</p>
                        <p><strong>Published at:</strong> {{ $article->published_at }}</p>

                        <!-- Remove favorite button -->
                        <form action="{{ route('news.unfavorite', $article->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Remove from Favorites</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
