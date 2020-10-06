@extends('admin.layouts.master')


@if($errors->any)
    @foreach($errors->all() as $error)
        <div class="alert alert-info">
            {{$error}}
        </div>
    @endforeach
@endif



@section('content')
    <div class="wrap-form-product mt-4">
        <div class="product-title">
            <h4>Редактирование товара</h4>
        </div>
        <form action="/admin/products/{{$product->code}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.product.form')
        </form>
    </div>
@endsection

@section('script')
    <script>
            $(document).ready(function() {
            $('.genre').select2();
            $('.author').select2();
        });
    </script>
@endsection