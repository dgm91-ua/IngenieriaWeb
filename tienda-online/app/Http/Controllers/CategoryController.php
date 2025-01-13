<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        /// Obtén las categorías con paginación (4 categorías por página)
        $categorias = Category::paginate(4);
        return view('categorias.index', compact('categorias'));
    }

    public function randomCategory()
    {
        // Seleccionar una categoría aleatoria
        $categoriaAleatoria = Category::inRandomOrder()->first();
        $categories = Category::all();
        if ($categoriaAleatoria) {

            // Redirigir a los productos de esa categoría
            return redirect()->route('productos.catalogo', ['category' => $categoriaAleatoria->id, 'categories' => $categories]);
        }

        // Si no hay categorías disponibles, redirigir con un mensaje
        return redirect()->route('home')->with('error', 'No hay categorías disponibles.');
    }
}