@extends('admin.layouts.master')

@section('content')

<div class="modal modal fade show" id="modalAuthor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Автор #<span id="id"></span> </h5>
            </div>
            <div class="modal-body">
                <div class="wrap-code mt-3">
                    <h6>Код автора</h6>
                    <span id="code"></span>
                </div>
                <div class="wrap-name mt-3">
                    <h6>ФИО</h6>
                    <span id="name"></span>
                </div>               
                 <div class="wrap-description mt-3">
                    <div class="form-group">
                        <h6>Описание автора</h6>
                        <textarea id="description" class="form-control" readonly></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-info" type="button" class="close" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>


    @if(session('result_author'))
        <div class="alert alert-info mt-3 fade show">
            {{session('result_author')}}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    <div class="wrap-table mt-4">
        <h3>Авторы</h3>
        <table class="table">
            <caption><a class="btn btn-success" href="/admin/authors/create" role="button">Добавить автора</a></caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Код</th>
                    <th>Наименование</th>
                    <th>Действие</th>
                </tr>
                <tbody>
                    @foreach($authors as $author)
                    <tr>
                        <td>{{$author->id}}</td>
                        <td>{{$author->code}}</td>
                        <td>{{$author->name}}</td>
                        <td>
                            <button class="btn btn-success buttonShowAuthor" code="{{$author->code}}" data-toggle="modal" data-target="#modalAuthor" role="button">Открыть</button>
                            <a class="btn btn-info" href="/admin/authors/{{$author->code}}/edit" role="button">Редактировать</a>
                            <a class="btn btn-danger" href="#" role="button">Удалить</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>
    </div>
@endsection

@section('script')
<script src="/js/show_author.js"></script>
@endsection