<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'users' => 'array|required_array_keys:name,email,phone,password',

            'users.name' => 'required',
            'users.email' => 'required|email|unique:users,email',
            'users.phone' => 'nullable',
            'users.password' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'users.name' => 'user name',
            'users.email' => 'Email',
            'users.password' => 'Password'
        ];
    }
}
