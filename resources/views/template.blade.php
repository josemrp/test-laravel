<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title', 'Test Laravel')</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-light border-bottom shadow mb-4" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="{{ route('home') }}">Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('article.index') }}">Articles</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                @yield('content')
            </div>
            <div class="col-sm-3">
                @section('aside')
                    <div class="p-2 border rounded shadow" style="background-color: #e3f2fd;">
                        <form action="" method="get">
                            <div class="form-group">
                                <label class="h4" for="search">Search: </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search" aria-describedby="search-btn">
                                    <div class="input-group-append">
                                        <button class="btn btn-info" type="submit" id="search-btn">&#x27A4;</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @show
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>function dd(x) {console.log(x)}function ddw(x) {document.write(x)}function ddj(x) {dd(JSON.parse(x))}</script>
    @yield('script')
</body>
</html>