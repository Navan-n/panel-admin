<?php

namespace App\Http\Requests\Magazine;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePageRequrst extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'slug' => 'required|unique:mag_pages,slug,'.$this->id,
            'title' => 'required',
            'body' => 'required'
        ];
    }
    public function attributes(): array
    {
        return [
            'slug' => 'آدرس کوتاه',
            'title'=> 'عنوان',
            'body'=>'توضیحات'
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
