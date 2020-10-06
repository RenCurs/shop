@extends('master')
@section('content')
    <div class="container">
        <h2 class="text-center mt-3">Мои заказы</h2>
        <div class="wrap-orders">
        @foreach($user->orders as $order)
            <div class="wrap-order">
                <div class="order-title">
                    <h4>Заказ № {{ $order->id}} | Статус: {{ ($order->status) ? 'завершен' : 'выполняется' }}</h4>
                    <span>Дата заказа: {{$order->created_at}}</span>
                </div>
                <div class="order-body mt-4">
                    <table class="table">
                        <thead class="thead-light">
                            <th>Наименование</th>
                            <th>Жанр</th>
                            <th>Количество</th>
                            <th>Стоимость</th>
                        </thead>
                        <tbody>
                        @foreach($order->products as $product)
                            <tr>
                                <td>
                                    <div class="col-sm-6 col-md-3 col-lg-2">
                                        <img class="img-fluid" src="{{Storage::url($product->image)}}">
                                    </div>
                                    {{$product->name}}
                                </td>
                                <td>{{$product->genres()->first()->name}}</td>
                                <td>{{$product->pivot->count}}</td>
                                <td>{{$product->pivot->cost}} ₽</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="total text-right">
                    <h6>Итого: {{$order->total_price}} ₽</h6>
                 </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection