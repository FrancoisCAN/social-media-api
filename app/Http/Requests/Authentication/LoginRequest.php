<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => 'email:rfc,dns|required',
            'password' => 'max:64|min:6|required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [
            'email.email' => 'Must be a valid email.',
            'email.required' => 'Email is required.',
            'password.max' => 'Password must not exceed 64 characters.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.required' => 'Password is required.',
        ];
    }
}
