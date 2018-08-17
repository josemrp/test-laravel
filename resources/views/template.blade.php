<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title', config('app.name', 'Blog'))</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-light border-bottom shadow mb-4" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="{{ route('home') }}">
            {{ config('app.name', 'Blog') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('article.index') }}">Articles</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @yield('content')
            </div>
            <div class="col-md-3">
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
                    @isset($tags)
                        <div class="p-2 mt-4 border rounded shadow">
                            <h4>Tags</h4>
                            @foreach($tags as $tag)
                                <a href="?tag={{ $tag->name }}" class="badge badge-info">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    @endisset
                @show
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>function dd(x) {console.log(x)}function ddw(x) {document.write(x)}function ddj(x) {dd(JSON.parse(x))}</script>
    @yield('script')
</body>
</html>