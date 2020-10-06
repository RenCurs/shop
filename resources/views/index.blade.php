@extends('master')

@section('content')
<div class="container">
    @if(session()->has('AddToCart'))
    <div class="flash-message mt-4">
        <div class="alert alert-primary message_add_cart" role="alert">
            {{session()->get('AddToCart')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="rightbar-filter col-4">
            <div class="wrap-filter">
                <div class="filter-title"><h4>Фильтр</h4></div>
                <form action="/">
                    <div class="filter-author-title mt-4"><h6>Авторы</h6></div>
                    <div class="filter-author-list">
                        @foreach($authors as $author)
                            <div class="form-check mt-2">
                                <input class="form-check-input"  name="authors[]" type="checkbox" value="{{$author->id}}" id="AuhtorCheck">
                                <label class="form-check-label" for="AuhtorCheck">
                                    {{$author->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="ffilter-genre-title mt-4"><h6>Жанры</h6></div>
                    <div class="filter-genre-list">
                        @foreach($genres as $genre)
                            <div class="form-check mt-2">
                                @if(!is_null(request()->input('genres')) && in_array($genre->id, array_values(request()->input('genres'))))
                                    <input checked class="form-check-input"  name="genres[]" type="checkbox" value="{{$genre->id}}" id="GenreCheck">
                                @else
                                    <input class="form-check-input"  name="genres[]" type="checkbox" value="{{$genre->id}}" id="GenreCheck">
                                @endif
                                <label class="form-check-label" for="GenreCheck">
                                     {{$genre->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="price-title mt-4"><h6>Цена</h6></div>
                    <div class="price-products form-row">
                        <input class="form-control col-5 mr-2" type="text" name="price[from]" placeholder="от" value="{{ request()->input('price.from') }}">
                        <input class="form-control col-5" type="text" name="price[to]" placeholder="до" value="{{ request()->input('price.to') }}">
                    </div>
                    <div class="filter-button mt-4">
                        <button class="btn btn-success" type="submit">Показать</button>
                    </div>
                </form>
                <button class="btn btn-info" onclick="location.href='/'">Сброс</button>
            </div>
        </div>
        <div class="card-product col-8">
            <div class="title-product m-3">
                <h3>Главная страница</h3><hr>
            </div>
            <div class="row">
            @if($products->count() === 0)
            <div class="alert alert-light">
               Ничего не найдено. Попробуйте изменить критерий поиска!
            </div>
            @else
                @foreach($products as $product)
                        <div class="col-lg-4">
                            <div class="wrap-image">
                                <img class="img-fluid" alt="Responsive image" src='{{Storage::url($product->image)}}'>
                            </div>

                            <h5><a href="/products/{{$product->code}}">{{ $product->name}}</a></h5>
                            <p>{{ $product->description }}</p>
                            @foreach($product->genres as $genre)
                                <a href="/genres/{{ $genre->code}}"><span>{{ $genre->name}}</span></a>
                            @endforeach
                            <div class="price-product mt-2 mb-2">
                                <span>Цена {{$product->price}} ₽</span>
                            </div>
                            @foreach($product->authors as $author)
                                <a href="/authors/{{ $author->code}}"><span>{{ $author->name}}</span></a><br>
                            @endforeach
                            @if (Arr::has(session()->get(session()->get('_token')), $product->code))
                            <a href="#">✔ Перейти в корзину</a><hr>
                            @else
                            <form method="POST" action="/cart/add/{{ $product->code}}">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-outline-info mt-2  ">Добавить в корзину</button><hr>
                            </form>
                            @endif
                        </div>
                @endforeach
            @endif
            </div>
            <div class="wrap-paginate">
                <div class="page">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    window.setTimeout(function(){
        $('.message_add_cart').fadeOut('slow');
    }, 3000)
</script>
