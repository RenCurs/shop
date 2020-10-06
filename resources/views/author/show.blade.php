@extends('master')
@section('content')
<div class="container">
    <div class="autor-title m-4">
        <h3>{{$author->name}}</h3>
        <p>{{ $author->description}}</p>
        <h4>Все книги</h4>
    </div>
    <div class="row">
        @foreach($author->products as $product)
        <div class="col-lg-4">
            <div class="wrap-product">
                <div class="wrap-image">
                    <img class="img-fluid" alt="Responsive image" src="{{Storage::url($product->image)}}">
                </div>
                <div class="body-product mt-2">
                    <p><a class="text-decoration-none" href="/products/{{$product->code}}">{{$product->name}}</a></p>
                    @foreach($product->authors as $author)
                        <a class="text-decoration-none" href="/authors/{{$author->code}}">{{$author->name}}</a>
                    @endforeach
                </div>
                <div class="footer-product mt-2">
                    @if (Arr::has(session()->get(session()->get('_token')), $product->code))
                        <a  class="text-decoration-none" href="#">✔ Перейти в корзину</a><hr>
                        @else 
                        <form method="POST" action="/cart/add/{{ $product->code}}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-success mt-2  ">В корзину</button>
                        </form>         
                     @endif
                </div>
                <hr>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('script')
<script src="/js/add_cart.js"></script>
@endsection