@extends('admin.layouts.master')

@section('content')

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger mt-2 alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
@endif
    
    <div class="wrap-edit-form col-lg-5 m-auto">
        <h4 class="mt-4">Редактирование жанра: {{ $genre->name }}</h4>
        <form action="/admin/genres/{{$genre->code}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.genre.form')
        </form>
        <button class="btn btn-light float-right" onclick="location.reload()">Сброс</button>
    </div>
@endsection