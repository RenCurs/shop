<html>
    <head>
        <meta charset="utf8">
        <title>Book</title>
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
         <link rel="stylesheet" href="/../css/app.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="/"><img src="/images/logo.png" width="48" heigh="48"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Авторы
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                @foreach($authors as $author)
                                    <a class="dropdown-item" href="/authors/{{ $author->code }}">{{ $author->name }}</a>
                                @endforeach
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Жанры
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                @foreach($genres as $genre)
                                    <a class="dropdown-item" href="/genres/{{ $genre->code }}">{{ $genre->name }}</a>
                                @endforeach
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Новинки</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">О нас</a>
                        </li>
                    </ul>

                    <div class="wrap-buttons">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="btn btn-outline-success mr-4" href="/cart"><span class="text-white"> <img src="/images/shopping-cart.svg"> Корзина ({{ $count }})</span></a>
                            @guest
                                <a class="btn btn-outline-success"  href="{{ route('login') }}"><span class="text-white"> Войти </span></a> 
                                @if (Route::has('register'))
                                    <a class="btn btn-outline-success" href="{{ route('register') }}"><span class="text-white"> Регистрация </span></a> 
                                @endif
                            </li>
                            @else
                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{Auth::user()->name}}</a>
                                <div class="dropdown-menu user-menu" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->isAdmin())
                                        <a class="dropdown-item" href="/admin">Панель администратора</a>
                                    @endif
                                    <a class="dropdown-item" href="/orders">Мои заказы</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                    {{ __('Выйти') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>