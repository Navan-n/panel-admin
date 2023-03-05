<?php

namespace App\Http\Requests\Magazine;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreFaqItemRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'faq_id'=> 'required'
        ];
    }
    public function attributes(): array
    {
        return [
            'title'=> 'عنوان',
            'faq_id'=> 'آیدی سوال'
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
