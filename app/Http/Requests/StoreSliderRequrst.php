<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreSliderRequrst extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required',
            'alt' => 'required',
            'link' => 'required|unique:mag_sliders,link,'.$this->id,
            'position' => 'required'
        ];
    }
    public function attributes(): array
    {
        return [
            'link' => 'لینک',
            'alt'=> 'جایگزین متن',
            'title'=>'عنوان',
            'position'=>'موقعیت'

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
