@extends('template')

@section('title', 'Blog')

@section('content')

    <div>
        @foreach ($articles as $article)
            <div class="mb-4 p-2 shadow-sm">
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
        @isset($search)
            {{ $articles->appends(['search' => $search])->links() }}
        @else
            {{ $articles->links() }}
        @endisset
    </div>

@endsection
