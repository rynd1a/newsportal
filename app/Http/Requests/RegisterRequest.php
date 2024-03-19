<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape(['name' => "string", 'email' => "string", 'password' => "string"])]
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    #[ArrayShape(['name.required' => "string", 'email.required' => "string", 'password.required' => "string", 'name.string' => "string", 'email.string' => "string", 'password.string' => "string", 'password.min' => "string", 'password.confirmed' => "string"])]
    public function messages(): array
    {
        return [
            'name.required' => 'Укажите имя пользователя',
            'email.required' => 'Укажите почту',
            'password.required' => 'Укажите пароль',
            'name.string' => 'Имя должно быть строкой',
            'email.string' => 'Почта должна быть строкой',
            'password.string' => 'Пароль должен быть строкой',
            'password.min' => 'Пароль должен быть длиной минимум :min символов',
            'password.confirmed' => 'Пароли не совпадают'
        ];
    }
}
