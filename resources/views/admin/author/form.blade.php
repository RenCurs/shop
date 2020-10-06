@csrf
<div class="form-group">
    <label for="IdCode">Код автора</label>
    <input type="text" class="form-control @error('code') is-invalid @enderror" id="IdCode" name="code" value="{{old('code', (isset($author)) ? $author->code : '') }}">
    @error('code')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @else
    <div class="valid-feedback">
        "Yes"
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="IdName">ФИО автора</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="IdName" name="name" value="{{old('name', (isset($author)) ? $author->name : '') }}">
    @error('name')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="IdDescription">Описание</label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="IdDescription" name="description">{{old('description', (isset($author)) ? $author->description : '') }}</textarea>
    @error('description')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
<div class="form-group">
   <button type="submit" class="btn btn-info">Отправить</button>
</div>
 