<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = \App\Models\Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            [
                'name' => 'Fragancias Florales',
                'description' => 'Aromas suaves y florales',
                'image' => 'images/categoria/1.webp'
            ],
            [
                'name' => 'Aromas Cítricos',
                'description' => 'Refrescantes y con toques cítricos',
                'image' => 'images/categoria/2.webp'
            ],
            [
                'name' => 'Aromas Orientales',
                'description' => 'Esencias exóticas y cálidas',
                'image' => 'images/categoria/3.webp'
            ],
            [
                'name' => 'Perfumes Unisex',
                'description' => 'Fragancias para todos',
                'image' => 'images/categoria/4.webp'
            ]
        ];

        return [
            $categories
        ];
    }
}
