<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:30'],
            'description' => ['required', 'string', 'max:1000'],
            'category_id' => [
                'required',
                'min:1',
                'integer',
                'exists:categories,id'
            ],
            'image' => [
                'image',
                'nullable',
                'max:1999',
                'mimes:jpeg,png,jpg,gif,svg'
            ],
        ];
    }
}
