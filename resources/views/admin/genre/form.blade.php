 @csrf
 <div class="form-group">
     <label for="IdCode">Код жанра</label>
     <input type="text" class="form-control" id="IdCode" name="code" value="{{old('code', (isset($genre)) ? $genre->code : '') }}">
 </div>
 <div class="form-group">
     <label for="IdName">Наименование</label>
     <input type="text" class="form-control" id="IdName" name="name" value="{{old('name', (isset($genre)) ? $genre->name : '') }}">
 </div>
 <div class="form-group">
     <label for="IdDescription">Описание жанра</label>
     <textarea class="form-control" id="IdDescription" name="description">{{old('description', (isset($genre)) ? $genre->description : '') }}</textarea>
 </div>
 <div class="form-group">
     <label for="IdImage">Изображение</label>
     <input type="file" class="form-control-file" id="IdImage" name="image" style="">
 </div>
 <div class="form-group">
    <button type="submit" class="btn btn-info">Отправить</button>
 </div>
 