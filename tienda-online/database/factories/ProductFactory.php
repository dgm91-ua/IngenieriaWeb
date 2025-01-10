<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ejemplos de nombres de perfumes
        $productNames = [
            'Eau de Rose', 'Citrus Breeze', 'Oriental Blossom', 'Aroma del Alba', 'Mystic Amber', 'Fleur de Provence', 'Sunshine', 'Eterna Opulencia',
            'Aura Sublime', 'Velours Nocturne', 'Éclat de Lumière', 'Rosa Éthérée', 'Mystère d’Or', 'Infini Élégance', 'Nuit Cristalline', 'Essence Précieus',
            'Saphir Intense'
        ];

        $name = $this->faker->randomElement($productNames);
        $price = $this->faker->randomFloat(2, 15, 200); 
        $stock = $this->faker->numberBetween(10, 100);

        $productImages = [
            'images/perfumes/1.webp',
            'images/perfumes/2.webp',
            'images/perfumes/3.webp',
            'images/perfumes/4.webp',
            'images/perfumes/5.webp',
            'images/perfumes/6.webp',
            'images/perfumes/7.webp',
            'images/perfumes/8.webp',
            'images/perfumes/9.webp'
        ];

        return [
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory()->create()->id,
            'name' => $name,
            'description' => $this->faker->paragraph(),
            'price' => $price,
            'stock' => $stock,
            'image' => $this->faker->randomElement($productImages),
        ];
    }
}
