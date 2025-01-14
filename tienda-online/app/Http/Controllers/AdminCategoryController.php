<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Listado de categorías (ADMIN).
     */
    public function index()
    {
        // Puedes paginar o traer todas
        $categories = Category::orderBy('id','desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Formulario para crear una nueva categoría.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Guardar la nueva categoría en base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        $category = new Category();
        $category->name        = $request->name;
        $category->description = $request->description;

        // Manejar la imagen (si se envía)
        if ($request->hasFile('image')) {
            // Guardar en storage/app/public/images/categories
            $path = $request->file('image')->store('images/categories', 'public');
            // Guardar la ruta para mostrar con asset('storage/...') o directo 'storage/images/...'
            $category->image = 'storage/' . $path;
        }

        $category->save();

        return redirect()->route('admin.categories.index')
                         ->with('success','Categoría creada correctamente');
    }

    /**
     * Mostrar una categoría (opcional en tu CRUD).
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Formulario para editar una categoría existente.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Actualizar una categoría.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name,'.$id,
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        $category = Category::findOrFail($id);
        $category->name        = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/categories', 'public');
            $category->image = 'storage/' . $path;
        }

        $category->save();

        return redirect()->route('admin.categories.index')
                         ->with('success','Categoría actualizada correctamente');
    }

    /**
     * Eliminar una categoría de la base de datos.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')
                         ->with('success','Categoría eliminada correctamente');
    }
}
