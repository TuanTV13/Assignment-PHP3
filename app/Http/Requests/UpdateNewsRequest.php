<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'news' => 'array|required_array_keys:title,description',

            'news.title' => 'required',
            'news.image' => 'nullable|image|max:2048',
            'news.description' => 'nullable',
            'news.updated_at' => now(),

            'categories' => 'array|required_array_keys:id',
            'categories.id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'news.title' => 'title',
            'news.description' => 'description',

            'categories.id' => 'category name',
        ];
    }
}
