<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        // Todos los productos sin paginación o con paginación
        $products = Product::with('category')->orderBy('id', 'desc')->get();
        // O ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|max:2048' 
        ]);

        // Crear el producto
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name        = $request->name;
        $product->description = $request->description;
        $product->price       = $request->price;
        $product->stock       = $request->stock;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/products', 'public');
            $product->image = 'storage/' . $path;
        }

        $product->save();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Producto creado correctamente.');
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|max:2048' 
        ]);

        $product = Product::findOrFail($id);
        $product->category_id = $request->category_id;
        $product->name        = $request->name;
        $product->description = $request->description;
        $product->price       = $request->price;
        $product->stock       = $request->stock;

        // Si se sube una nueva imagen, actualizarla
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/products', 'public');
            $product->image = 'storage/' . $path;
        }

        $product->save();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Producto eliminado correctamente.');
    }
}
