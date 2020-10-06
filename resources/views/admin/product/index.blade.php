@extends('admin.layouts.master')


@section('content')

    @if(session('result_product'))
    <div class="wrap-result-message mt-4">
        <div class="alert alert-info fade show">
            {{ session('result_product')}}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    </div>
    @endif

    <div class="modal fade" role="dialog" id="staticBackdrop" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Товар #<span id="id"></span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-row">
                        <div class="data-product">
                                <div class="code">
                                    <h5>Код</h5>
                                    <span id="code"></span>
                                </div>
                                <div class="name mt-3">
                                    <h5>Наименование</h5>
                                    <span id="name"></span>
                                </div>
                                <div class="genre-modal mt-3">
                                    <h5>Жанр</h5>
                                    <span id="genre-modal"></span>
                                </div>
                                <div class="publisher mt-3">
                                    <h5>Издательство</h5>
                                    <span id="publisher"></span>
                                </div>
                                <div class="year_public mt-3">
                                    <h5>Год публикации</h5>
                                    <span id="year_public"></span>
                                </div>
                                <div class="price mt-3">
                                    <h5>Цена</h5>
                                    <span id="price"></span>
                                </div>
                        </div>
                        <div class="wrap-image  offset-2">
                            <h5 id="title-image">Изображение</h5>
                            <div class="image"></div>
                         </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" type="button" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

    <div class="wrap-table mt-3">
        <h3>Товары</h3>
        <table class="table">
            <caption><a class="btn btn-success" href="/admin/products/create" role="button">Добавить товар</a></caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Наименование</th>
                    <th>Автор</th>
                    <th>Жанр</th>
                    <th>Цена</th>
                    <th>Действие</th>
                </tr>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>
                            <select disabled class="author" name="authors[]" multiple="multiple">
                            @foreach($authors as $key=>$val)
                                @if(array_key_exists($key, $product->authors->pluck('name', 'id')->all()))
                                    <option selected value="{{$key}}">{{$val}}</option>
                                @endif
                            @endforeach()
                            </select>
                        </td>
                        <td>
                            <select disabled class="genre" name="genres[]" multiple="multiple">
                            @foreach($genres as $key=>$val)
                                @if(array_key_exists($key, $product->genres->pluck('name', 'id')->all()))
                                    <option selected value="{{$key}}">{{$val}}</option>
                                @endif
                            @endforeach()
                            </select>
                        </td>
                        <td>{{$product->price}} ₽</td>
                        <td>    
                            <button class="btn btn-success buttonShowProduct" code="{{$product->code}}"  data-toggle="modal" data-target="#staticBackdrop">Открыть</button>
                            <a class="btn btn-info" href="/admin/products/{{$product->code}}/edit" role="button">Редактировать</a>
                            <form class="d-inline" action="/admin/products/{{$product->code}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>
    </div>
@endsection

@section('script')
<script src='/js/show_product.js'></script>
<script>
        $(document).ready(function() {
            $('.genre').select2();
            $('.author').select2();
        });
    </script>
@endsection