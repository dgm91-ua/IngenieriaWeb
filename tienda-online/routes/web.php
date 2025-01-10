<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Models\Category;

Route::get('/', function () {
    $randomCategories = Category::inRandomOrder()->take(4)->get();
    return view('home', compact('randomCategories'));
})->name('home');

Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/privacidad', function () {
    return view('privacidad');
})->name('privacidad');

// Route::get('/', function () {
//     $randomCategories = Category::inRandomOrder()->take(4)->get();
//     return view('home', compact('randomCategories'));
// })->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Página para listar todos los productos
Route::get('/productos/{categoria?}', [ProductController::class, 'index'])->name('productos.index');

// Página para listar las categorías
Route::get('/categorias', [CategoryController::class, 'index'])->name('categorias.index');
Route::get('/categorias/aleatoria', [CategoryController::class, 'randomCategory'])->name('categorias.random');

require __DIR__.'/auth.php';
