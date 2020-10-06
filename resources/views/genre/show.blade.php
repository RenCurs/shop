<h4>Категория: {{ $genre->name}}</h4>

@foreach($genre->products()->get() as $product)
    <h5>{{ $product->name}}</h5>
@endforeach