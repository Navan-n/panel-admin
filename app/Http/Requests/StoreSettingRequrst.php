<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreSettingRequrst extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required',
            'meta_title' => 'required',
            'description' => 'required',
            'phone_number' => 'required',
        ];
    }
    public function attributes(): array
    {
        return [
            'title'=>'عنوان',
            'meta_title'=>'عنوان متا',
            'description'=>'توضیحات',
            'phone_number'=>'شماره تلفن همراه'
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute الزامی است',
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
