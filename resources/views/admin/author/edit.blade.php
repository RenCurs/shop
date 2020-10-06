@extends('admin.layouts.master')

@section('content')
    <div class="form-wrap mt-4 col-lg-6">
        <form action="/admin/authors/{{$author->code}}" method="POST">
            @method('PUT')
            @include('admin.author.form')
        </form>
    </div>
@endsection
