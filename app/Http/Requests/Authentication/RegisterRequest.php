<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'city' => 'required',
            'country' => 'required',
            'email' => 'email:rfc,dns|required',
            'firstname' => 'max:24|min:3|required',
            'ip' => 'ip|required',
            'lastname' => 'max:24|min:3|required',
            'password' => 'confirmed|max:64|min:6|required',
            'phone' => 'numeric|required',
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
            'city.required' => 'City is required.',
            'country.required' => 'Country is required.',
            'email.email' => 'Must be a valid email.',
            'email.required' => 'Email is required.',
            'firstname.max' => 'Firstname must not exceed 24 characters.',
            'firstname.min' => 'Firstname must be at least 3 characters.',
            'firstname.required' => 'Firstname is required.',
            'ip.ip' => 'Must be a valid IP.',
            'ip.required' => 'IP is required.',
            'lastname.max' => 'Lastname must not exceed 24 characters.',
            'lastname.min' => 'Lastname must be at least 3 characters.',
            'lastname.required' => 'Lastname is required.',
            'password.max' => 'Password must not exceed 64 characters.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.required' => 'Password is required.',
            'phone.numeric' => 'Must be a valid phone number.',
            'phone.required' => 'Phone number is required.',
        ];
    }
}
