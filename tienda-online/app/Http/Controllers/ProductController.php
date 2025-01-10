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
}
