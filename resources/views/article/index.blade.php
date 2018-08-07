@extends('template')

@section('title', 'Articles')

@section('content')

    <div class="row">
        <div class="col-6">
            <h1>Articles</h1>
        </div>
        <div class="col-6 text-right">
            <a href="{{ route('article.create') }}" class="btn btn-primary">Add new</a>
        </div>
    </div>

    @for($i = 0; $i < 20; $i++)
        <p>Article {{ $i }}</p>
    @endfor

@endsection