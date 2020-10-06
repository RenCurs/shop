            @csrf
            <div class="form-group">
                <label for="IdCode">Код товара</label>
                <input type="text" class="form-control" id="IdCode" name="code" value="{{old('code', (isset($product)) ? $product->code : '') }}">
            </div>
            <div class="form-group">
                <label for="IdName">Наименование</label>
                <input type="text" class="form-control" id="IdName" name="name" value="{{old('name', (isset($product)) ? $product->name : '') }}">
            </div>
            <div class="form-group">
                <label for="IdDescription">Описание товара</label>
                <textarea class="form-control" id="IdDescription" name="description">{{old('description', (isset($product)) ? $product->description : '') }}</textarea>
            </div>
            <div class="form-group d-flex flex-column">
                <label for="IdGenre">Жанр</label>
                <select id="IdGenre" class="genre" name="genres[]" multiple="multiple">
                    @if(isset($product))
                        @foreach($genres as $key=>$val)
                            @if(array_key_exists($key, $genreProduct))
                                <option selected value="{{$key}}">{{$val}}</option>
                            @else
                            <option value="{{$key}}">{{$val}}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach($genres as $key=>$val)
                            <option  value="{{$val->id}}">{{$val->name}}</option>       
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group d-flex flex-column">
                <label for="IdAuthor">Автор</label>
                <select id="IdAuthor" class="author" name="authors[]" multiple="multiple">
                    @if(isset($product))
                        @foreach($authors as $key=>$val)
                            @if(array_key_exists($key, $authorProduct))
                                <option selected value="{{$key}}">{{$val}}</option>
                            @else
                            <option value="{{$key}}">{{$val}}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach($authors as $key=>$val)
                            <option  value="{{$val->id}}">{{$val->name}}</option>       
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="IdPublisher">Издательство</label>
                <input type="text" class="form-control" id="IdName" name="publisher" value="{{old('publisher', (isset($product)) ? $product->publisher : '') }}">
            </div>
            <div class="form-group">
                <label for="IdPublished">Год публикации</label>
                <input type="text" class="form-control" id="IdPublished" name="published" value="{{old('published', (isset($product)) ? $product->published : '') }}">
            </div>
            <div class="form-group">
                <label for="IdPrice">Цена</label>
                <input type="text" class="form-control" id="IdName" name="price" value="{{old('price', (isset($product)) ? $product->price : '') }}">
            </div>
            <div class="form-group">
                <label for="IdImage">Изображение</label>
                <input type="file" class="form-control-file" id="IdImage" name="image">
                <img src="{{(isset($product)) ? Storage::url($product->image) : ''}}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-info">Отправить</button>
            </div>