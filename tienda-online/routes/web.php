<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminUserController;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

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

    
// Página de dashboard o inicio del panel
Route::get('/admin', function() {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminController::class)->index();
})->name('admin.dashboard');

/**
 * INDEX - Listado de productos
 */
Route::get('/admin/products', function() {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminProductController::class)->index();
})->name('admin.products.index');

/**
 * CREATE - Formulario para crear un producto
 */
Route::get('/admin/products/create', function() {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminProductController::class)->create();
})->name('admin.products.create');

/**
 * STORE - Guardar un nuevo producto en la base de datos
 */
Route::post('/admin/products', function(Request $request) {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminProductController::class)->store($request);
})->name('admin.products.store');


/**
 * EDIT - Formulario para editar un producto
 */
Route::get('/admin/products/{product}/edit', function(Product $product) {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminProductController::class)->edit($product->id);
})->name('admin.products.edit');

/**
 * UPDATE - Actualizar un producto existente
 */
Route::put('/admin/products/{product}', function(Request $request, Product $product) {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminProductController::class)->update($request, $product->id);
})->name('admin.products.update');

/**
 * DESTROY - Eliminar un producto
 */
Route::delete('/admin/products/{product}', function(Product $product) {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminProductController::class)->destroy($product->id);
})->name('admin.products.destroy');

/**
 * INDEX - Listado de categorías
 */
Route::get('/admin/categories', function() {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminCategoryController::class)->index();
})->name('admin.categories.index');

/**
 * CREATE - Formulario para crear una categoría
 */
Route::get('/admin/categories/create', function() {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminCategoryController::class)->create();
})->name('admin.categories.create');

/**
 * STORE - Guardar nueva categoría
 */
Route::post('/admin/categories', function(Request $request) {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminCategoryController::class)->store($request);
})->name('admin.categories.store');

/**
 * EDIT - Formulario para editar
 */
Route::get('/admin/categories/{category}/edit', function(Category $category) {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminCategoryController::class)->edit($category->id);
})->name('admin.categories.edit');

/**
 * UPDATE - Actualizar
 */
Route::put('/admin/categories/{category}', function(Request $request, Category $category) {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminCategoryController::class)->update($request, $category->id);
})->name('admin.categories.update');

/**
 * DESTROY - Eliminar
 */
Route::delete('/admin/categories/{category}', function(Category $category) {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminCategoryController::class)->destroy($category->id);
})->name('admin.categories.destroy');

// INDEX
Route::get('/admin/users', function() {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminUserController::class)->index();
})->name('admin.users.index');

// CREATE
Route::get('/admin/users/create', function() {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminUserController::class)->create();
})->name('admin.users.create');

// STORE
Route::post('/admin/users', function(Request $request) {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminUserController::class)->store($request);
})->name('admin.users.store');

// EDIT
Route::get('/admin/users/{user}/edit', function(User $user) {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminUserController::class)->edit($user->id);
})->name('admin.users.edit');

// UPDATE
Route::put('/admin/users/{user}', function(Request $request, User $user) {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminUserController::class)->update($request, $user->id);
})->name('admin.users.update');

// DESTROY
Route::delete('/admin/users/{user}', function(User $user) {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
    return app(AdminUserController::class)->destroy($user->id);
})->name('admin.users.destroy');

require __DIR__.'/auth.php';
