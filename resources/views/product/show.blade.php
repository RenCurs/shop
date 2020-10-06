@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <h3>{{ $product->name }}</h3>
            <span> {{ $product->price }}</span>
            @foreach($product->genres as $genre)
                <span> {{ $genre->name }}</span>
            @endforeach

            @foreach($product->authors as $author)
                <p> {{ $author->name }}</p>
            @endforeach
        </div>
    </div>
</div>
@endsection