@extends('template')

@section('title', $article->title)

@section('content')

    <div>
        @isset($article->image)
            <img src="{{ asset('img/asrticle/' . $article->image) }}" alt="{{ $article->title }}">
        @endisset
        <h1>{{ $article->title }}</h1>
        <div>
            {{ $article->content }}
        </div>
    </div>

@endsection