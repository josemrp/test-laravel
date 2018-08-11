@extends('template')

@section('title', 'Blog')

@section('content')

    <div>
        @foreach ($articles as $article)
            <div>
                @isset($article->image)
                    <img src="{{ asset('img/article/' . $article->image) }}" alt="{{ $article->title }}" class="img-fluid">
                @endisset
                <h1>{{ $article->title }}</h1>
                <div>
                    @foreach ($article->tags as &$tag)
                        <a href="#" class="badge badge-info">{{ $tag->name }}</a>
                    @endforeach
                </div>
                <div>
                    {{ $article->content }}
                </div>
            </div>
        @endforeach
    </div>

    <div>
        {{ $articles->links() }}
    </div>

@endsection
