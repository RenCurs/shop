<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code'=>'required|unique:genres|min:5',
            'name'=>'required|min:5',
            'description'=>'required|min:5',
        ];
    }

    public function messages()
    {
        return [
            'required'=>'Поле :attribute должно быть заполнено',
            'unique'=>'Такой :attribute уже занят',
            'min'=>[
                'string'=>'Поле :attribute не должно быть меньше :min символов',
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'наименование',
            'code' => 'код',
            'description' => 'описание жанра',
        ];
    }
}
