<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = fake()->firstName(); // Genera el primer nombre
        $lastName = fake()->lastName();   // Genera el apellido
        $name = $firstName . ' ' . $lastName; // Combina el nombre y apellido

        $street = $this->faker->streetAddress;
        $city = $this->faker->city;
        $state = $this->faker->state;
        $country = $this->faker->country;
        $zipCode = $this->faker->postcode;

        $fullAddress = "{$street}, {$city}, {$state}, {$country}, {$zipCode}";

        return [
            'name' => $name,
            'email' => $firstName . '.' . $lastName . '@example.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => 'customer',
            'image' => 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=random&size=128', // Generar icono con inicial
            'address' => $fullAddress,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
