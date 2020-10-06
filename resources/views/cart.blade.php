@extends('master')

@section('content')
    <div class="modal fade" id="modal_guest" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="result-messages m-2"></div>
            <div class="modal-header">
                <h5 class="modal-title">Контактная информация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-guest">
            @csrf
            @method('POST')
                <div class="modal-body">
                @if($errors->any())
                {{ print_r($errors->all()) }}
                @endif  
                        <div class="form-group">
                            <label for="id_name">Имя</label>
                            <input class="form-control" type="text" name="name" value="" id="id_name">
                        </div>
                        <div class="form-group">
                            <label for="id_phone">Мобильный номер</label>
                            <input class="form-control" type="text" name="phone" value="" id="id_phone">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" id="send_order" class="btn btn-primary">Подтвердить заказ</button>
                </div>
            </form>
            </div>
    </div>
    </div>
    <div class="container-fluid">
        @if(session('result_order'))
            <div class="alert alert-success mt-3 text-center" role="alert">Заказ успешно оформлен</div>
        @endif
        <div class="row">
            <div class="col-lg">
                <div class="wrap-table-cart mt-4">
                    <div class="label-cart text-center m-4">
                        <h3>Корзина</h3>
                        <span>Оформление заказа</span>
                    </div>
                    @if (!(is_null($products)) && !(empty($products)))
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Название</th>
                                        <th>Количество</th>
                                        <th>Цена</th>
                                        <th>Стоимость</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $code_product => $product)
                                        <tr>
                                            <td id="name">{{ $product['name'] }}</td>
                                            <td>
                                                <a href="/cart/decrease/{{ $code_product }}" class="btn btn-danger">-</a>
                                                <span id="count_product">{{ $product['count'] }}</span>
                                                <a href="/cart/increase/{{ $code_product }}" class="btn btn-success">+</a>
                                            </td>
                                            <td id="price">{{ $product['price'] }}</th>
                                            <td class="total_sum">{{ $product['cost']}}</td>
                                            <td><a href="/cart/delete/{{ $code_product }}" class="btn btn-outline-danger">Удалить</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        <hr>
                        <div class="container">
                            <div class="wrap-total">
                               <h5 class="total-h text-right">Итого: {{ $infOrder['total_count']}} шт. на cумму {{$infOrder['total_price']}} Р</h5>
                            </div>
                        </div>
                        @if(Auth::check())
                            <form method="POST" action="/cart/confirm_order">
                                @csrf
                                <button type="submit" class="btn btn-outline-info">Заказать</a>  
                            </form>   
                        @else
                            <button class="btn btn-outline-info" data-toggle="modal" data-target="#modal_guest">Оформить заказ</button>     
                        @endif
                    @else
                    <div class="alert alert-info" role="alert">
                       Ваша корзина пуста: вы можете вернуться на главную страницу, чтобы добавить товар в корзину. <a href="#" class="alert-link">Перейти на главную страницу</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="js/add_cart.js"></script>
@endsection