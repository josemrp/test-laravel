@extends('template')

@section('title', $article->title)

@section('content')

    <div>
        @isset($article->image)
            <img src="{{ asset('img/article/' . $article->image) }}" alt="{{ $article->title }}" class="img-fluid">
        @endisset
        <h1>{{ $article->title }}</h1>
        <div>
            {{ $article->content }}
        </div>
    </div>

@endsection