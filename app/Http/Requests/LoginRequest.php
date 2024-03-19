<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class LoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape(['email' => "string", 'password' => "string"])]
    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string|min:8',
        ];
    }

    #[ArrayShape(['email.required' => "string", 'password.required' => "string", 'email.string' => "string", 'password.string' => "string", 'password.min' => "string"])]
    public function messages(): array
    {
        return [
            'email.required' => 'Укажите почту',
            'password.required' => 'Укажите пароль',
            'email.string' => 'Почта должна быть строкой',
            'password.string' => 'Пароль должен быть строкой',
            'password.min' => 'Пароль должен быть длиной минимум :min символов'
        ];
    }
}
