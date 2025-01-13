<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
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

    // Rutas para el carrito
    Route::post('/carrito/agregar/{productoId}', [CartController::class, 'agregar'])->name('carrito.agregar');
    Route::get('/cart', [CartController::class, 'index'])->name('carrito.index');
    Route::post('/cart/update', [CartController::class, 'updateAjax'])->name('carrito.update.ajax');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('carrito.remove');

    // Rutas para los pedidos
    Route::get('/mis-pedidos', [OrderController::class, 'misPedidos'])->name('pedido.misPedidos');
    Route::get('/pedido/{id}', [OrderController::class, 'show'])->name('pedido.show');
    Route::post('/finalizar-compra', [OrderController::class, 'finalizarCompraDesdeCarrito'])->name('orders.finalizar');
    Route::post('/comprar/{productId}', [OrderController::class, 'comprarProductoDirectamente'])->name('orders.comprar');
});

// Página para listar todos los productos
Route::get('/productos/{categoria?}', [ProductController::class, 'index'])->name('productos.index');
Route::get('/producto/{id}', [ProductController::class, 'show'])->name('producto.show');
Route::get('/catalogo/{categoria?}', [ProductController::class, 'catalogo'])->name('productos.catalogo');



// Página para listar las categorías
Route::get('/categorias', [CategoryController::class, 'index'])->name('categorias.index');
Route::get('/categorias/aleatoria', [CategoryController::class, 'randomCategory'])->name('categorias.random');

require __DIR__.'/auth.php';
