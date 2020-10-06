<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Validation\Rule;

class AuthorRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rules =  [
            'code'=>['required', 'unique:authors','min:4'],
            'name'=>['required','min:4'],
            'description'=>['required','min:4'],
        ];

        if($request->method === 'PUT')
        {
            $rules['code'] = ['required', Rule::unique('authors')->ignore($this->author->code,'code'),'min:4'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required'=>'Поле :attribute должно быть заполнено',
            'min'=>['string'=>'Поле :attribute не должно быть меньше :min символов'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'наименование',
            'code' => 'код',
            'description' => 'описание',
        ];
    }
}
