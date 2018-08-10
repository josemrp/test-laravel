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

    <table class="table table-hover">
        <thead>
            <tr>
                <td style="width: 10%">ID</td>
                <td style="width: 65%">Title</td>
                <td style="width: 25%" class="text-center">Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td><strong>{{ $article->title }}</strong></td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{ route('article.edit', $article->id ) }}" class="btn btn-success">E</a>
                            <a href="{{ route('article.show', $article->id ) }}" class="btn btn-info">V</a>
                            <button class="btn btn-danger">D</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    

@endsection