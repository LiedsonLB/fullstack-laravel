<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShortUrlRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'original_url' => [
                'required',
                'string',
                'max:4096',
                'url',
            ],
            'code' => [
                'nullable',
                'alpha_num',
                'min:4',
                'max:10',
                'unique:urls,code'
            ],
            'expires_in_days' => [
                'nullable',
                'integer',
                'min:1',
                'max:3650'
            ],
        ];
    }

    public function messages()
    {
        return [
            'original_url.url' => 'A URL informada não é válida.',
            'code.alpha_num' => 'O código deve conter apenas letras e números.',
        ];
    }
}