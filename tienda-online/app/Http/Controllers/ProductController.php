<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($categoria = null)
    {
        if ($categoria) {
            // Obtener los productos de la categoría específica
            $productos = Product::where('category_id', $categoria)->paginate(9);
            $categoriaNombre = Category::find($categoria)->name ?? 'Categoría no encontrada';
        } else {
            // Obtener todos los productos
            $productos = Product::paginate(9);
            $categoriaNombre = null;
        }

        return view('productos.index', compact('productos', 'categoriaNombre'));
    }

    public function show($id)
    {
        // Obtener el producto específico
        $producto = Product::findOrFail($id);

        // Obtener 3 productos sugeridos aleatorios
        $productosSugeridos = Product::inRandomOrder()
            ->where('id', '!=', $id) // Excluir el producto actual
            ->take(3)
            ->get();

        return view('productos.show', compact('producto', 'productosSugeridos'));
    }

    public function catalogo(Request $request, $categoria = null)
    {
        // Obtener todas las categorías para el desplegable
        $categories = Category::all();
        $selectedCategory = null;

        // Construir la consulta base para los productos
        $query = Product::query()->orderBy('name', 'asc');

        // Filtrar por categoría (redirección de página)
        if ($categoria) {
            $query->where('category_id', $categoria);
            $selectedCategory = Category::find($categoria);
        }

        // Filtrar por categoría (filtro)
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
            $selectedCategory = Category::find($request->category);
        }

        // Filtrar por búsqueda de nombre
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Filtrar por rango de precios
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Ordenar productos
        if ($request->sort == 'az') {
            $query->orderBy('name', 'asc');
        } elseif ($request->sort == 'za') {
            $query->orderBy('name', 'desc');
        }

        // Obtener productos con paginación
        $productos = $query->paginate(9);

        return view('productos.catalogo', compact('productos', 'categories', 'selectedCategory'));
    }
}
