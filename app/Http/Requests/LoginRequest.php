<?php

namespace App\Http\Requests;

class LoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|max:255'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'email.email' => 'Email is not valid!',
            'email.exists' => 'Email does not exist!',
            'password.required' => 'Password is required!',
            'password.string' => 'Password must be a string!',
            'password.min' => 'Password must be at least 6 characters!',
            'password.max' => 'Password must be at most 255 characters!'
        ];
    }
}