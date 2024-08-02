<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'category' => 'array|required_array_keys:name',
            'category.name' => 'required|unique:categories,name',
            'category.created_at' => now(),
        ];
    }

    public function attributes()
    {
        return [
            'category.name' => 'category name',
        ];
    }
}
