@extends('admin.layouts.master')

@section('content')
    <div class="form-wrap mt-4 col-lg-6">
        <form action="/admin/authors" method="POST">
            @include('admin.author.form')
        </form>
    </div>
@endsection
