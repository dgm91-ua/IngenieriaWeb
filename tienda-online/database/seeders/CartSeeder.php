<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run()
    {
        // Obtener todos los usuarios existentes
        $users = User::all();

        // Crear un carrito para cada usuario que no tenga uno
        $users->each(function ($user) {
            if (!Cart::where('user_id', $user->id)->exists()) {
                Cart::create([
                    'user_id' => $user->id,
                ]);
            }
        });

        $this->command->info('Carritos creados para todos los usuarios que no tenían.');
    }
}