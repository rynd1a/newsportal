<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed $header
 * @property mixed $announce
 * @property mixed $description
 */
class NewsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape(['header' => "string", 'announce' => "string", 'image' => "string", 'description' => "string"])]
    public function rules(): array
    {
        return [
            'header' => 'required|string|min:8|max:255',
            'announce' => 'required|string|min:8|max:500',
            'image' => 'nullable|mimes:jpeg,gif|max:2048|dimensions:max_width=300,max_height=300',
            'description' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'header.required' => 'Заголовок обязателен',
            'header.string' => 'Заголовок должен быть строкой',
            'header.min' => 'Заголовок должен быть минимум :min символов',
            'header.max' => 'Заголовок должен быть максимум :max символов',
            'announce.required' => 'Анонс обязателен',
            'announce.string' => 'Анонс должен быть строкой',
            'announce.min' => 'Минимальная длина анонса :min символов',
            'announce.max' => 'Максимальная длина анонса :max символов',
            'image.mimes' => 'Неподходящий формат картинки',
            'image.dimensions' => 'Максимальное разрешение картинки 300x300',
            'description.required' => 'Текст статьи обязателен',
            'description.string' => 'Текст должен быть строкой'
        ];
    }
}
