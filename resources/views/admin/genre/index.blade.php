@extends('admin.layouts.master')

@section('content')

    @if(session('genre_result'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{session('genre_result')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <div class="modal modal fade show" id="modalGenre">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Жанр #<span id="id"></span> </h5>
                </div>
                <div class="modal-body d-flex">
                    <div class="left-bar col-6">
                        <div class="wrap-code mt-3">
                            <h6>Код</h6>
                            <span id="code"></span>
                        </div>
                        <div class="wrap-name mt-3">
                            <h6>Наименование</h6>
                            <span id="name"></span>
                        </div>               
                        <div class="wrap-description mt-3">
                            <div class="form-group">
                                <h6>Описание</h6>
                                <textarea id="description" class="form-control" readonly></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="right-bar offset-1">
                        <div class="wrap-image">
                            <h5 class="title-image"></h5>
                            <img class="image img-fluid" src="">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-info" type="button" class="close" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

    <div class="wrap-table mt-4">
        <h3>Жанры</h3>
        <table class="table">
            <caption><a class="btn btn-success" href="/admin/genres/create" role="button">Добавить жанр</a></caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Код</th>
                    <th>Наименование</th>
                    <th>Действие</th>
                </tr>
                <tbody>
                    @foreach($genres as $genre)
                    <tr>
                        <td>{{$genre->id}}</td>
                        <td>{{$genre->code}}</td>
                        <td>{{$genre->name}}</td>
                        <td>
                            <button class="btn btn-success buttonShowGenre" code="{{$genre->code}}" data-toggle="modal" data-target="#modalGenre">Открыть</button>
                            <a class="btn btn-info" href="/admin/genres/{{$genre->code}}/edit" role="button">Редактировать</a>
                            <form class="d-inline" action="/admin/genres/{{$genre->code}}" method="POST">
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
<script src="/js/show_genre.js"></script>
@endsection