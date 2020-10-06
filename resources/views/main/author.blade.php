@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <h3>Автор: {{$author->name}}</h3>
            <h4>Книги: </h4>
            @foreach($author->products as $product)
                <span> {{$product->name}}</span>
                <p> {{ $product->publisher }}</p>
                @foreach($product->genres as $genre)
                    <p>{{ $genre->name }}</p>
                @endforeach 
            @endforeach
        </div>
    </div>
</div>
@endsection