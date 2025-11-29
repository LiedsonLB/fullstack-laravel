<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShortUrlRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'original_url' => 'required|url|max:2048',
            'code' => 'nullable|string|alpha_dash|unique:short_urls,code|max:50'
        ];
    }

    public function messages(): array
    {
        return [
            'original_url.required' => 'A URL é obrigatória.',
            'original_url.url' => 'Informe uma URL válida.',
            'code.unique' => 'Esse código já está em uso.',
        ];
    }
}
