<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Cart;
use App\Models\CartLine;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        User::truncate();
        Category::truncate();
        Product::truncate();
        Cart::truncate();
        CartLine::truncate();
        Order::truncate();
        OrderLine::truncate();

        Schema::enableForeignKeyConstraints();

        $customUsers = [
            [
                'name'      => 'David Garcia',
                'email'     => 'davidgarciamartinez99@gmail.com',
                'password'  => Hash::make('1234'),
                'role'      => 'customer',
                'image'     => 'https://ui-avatars.com/api/?name=David+Garcia&background=random&size=128',
            ],
            [
                'name'      => 'Super Administrador',
                'email'     => 'Super.Administrador@example.com',
                'password'  => Hash::make('1234'),
                'role'      => 'admin',
                'image'     => 'https://ui-avatars.com/api/?name=Super+Administrador&background=random&size=128',
            ],
        ];

        foreach ($customUsers as $user) {
            User::create($user);
        }

        // Crear 10 usuarios
        User::factory(10)->create();

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

        // Crear categorías
        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }

        // Crear 10 productos
        Product::factory(12)->create();

        // Crear un pedido para el usuario 1
        $order = Order::factory()->create([
            'user_id' => 1,
            'status' => 'pending'
        ]);

        // Crear líneas de pedido
        $orderLines = OrderLine::factory(3)->create([
            'order_id' => $order->id
        ]);

        // Calcular el total del pedido
        $total = 0;
        foreach ($orderLines as $line) {
            $total += $line->price * $line->quantity;
        }
        $order->update(['total' => $total]);
    }
}
