@extends('admin.layouts.master')


@section('content')
    <div class="wrap-errors m-4">
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
            <button type="button" data-dismiss="alert" class="close">&times;</button>
            </div>
        @endforeach
    @endif
    </div>

    <div class="wrap-form-product mt-4">
        <div class="product-title">
            <h4>Добавление товара</h4>
        </div>
        <form action="/admin/products" method="POST" enctype="multipart/form-data">
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