<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class NewsFactory extends Factory
{
    protected $model = News::class;

    #[ArrayShape(['header' => "string", 'announce' => "string", 'description' => "string", 'image_id' => 'int', 'views' => 'int', 'user_id' => 'int', 'published' => 'bool'])]
    public function definition(): array
    {
        return [
            'header' => $this->faker->text(25),
            'announce' => $this->faker->text(500),
            'description' => $this->faker->text(1000),
            'image_id' => Image::all()->random()->id,
            'views' => 9,
            'user_id' => [1, 2][array_rand([1, 2])],
            'published' => [true, false][array_rand([true, false])]
        ];
    }
}
