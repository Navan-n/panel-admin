<?php

namespace App\Http\Requests\Magazine;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreCategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'slug' => 'required|unique:mag_categories,slug,'.$this->id,
            'title' => 'required',
            'description' => 'required'
        ];
    }
    public function attributes(): array
    {
        return [
            'slug' => 'آدرس کوتاه',
            'title'=> 'عنوان',
            'description'=>'توضیحات'
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute الزامی است',
            'unique' => ':attribute نباید تکراری باشد',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()/*->first()*/
        ]));
    }
    public function failedAuthorization()
    {
        dd('failedAuthorization');
    }

}
