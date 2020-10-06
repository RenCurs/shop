<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
      $rules = [
            'code'=>['required', 'unique:products','min:4'],
            'name'=>['required','min:4'],
            'description'=>['required','min:4'],
        ];

        if($request->method === 'PUT')
        {
            $rules['code'] = ['required', Rule::unique('products')->ignore($this->product->code,'code'),'min:4'];
        }

        return $rules;
    }

}
