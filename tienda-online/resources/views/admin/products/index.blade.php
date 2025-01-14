@extends('layouts.masterusers')

@section('title', 'Listado de Productos')

@section('content')
<div class="container">
    <h1 class="mb-3">Listado de Productos</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Botón para crear un nuevo producto --}}
    <div class="mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Crear Producto
        </a>
    </div>

    @if($products->isEmpty())
        <p>No hay productos registrados.</p>
    @else
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th class="text-center" style="width: 200px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td class="align-middle">{{ $product->name }}</td>
                    <td class="align-middle">
                        {{ $product->category->name ?? 'Sin Categoría' }}
                    </td>
                    <td class="align-middle">{{ $product->price }} €</td>
                    <td class="align-middle">{{ $product->stock }}</td>
                    <td class="align-middle">
                        @if($product->image)
                            <img 
                              src="{{ asset($product->image) }}" 
                              alt="{{ $product->name }}" 
                              style="width: 60px; height: 60px; object-fit: cover;"
                            >
                        @else
                            <img 
                              src="{{ asset('images/no-imagen.webp') }}" 
                              alt="Sin imagen" 
                              style="width: 60px; height: 60px; object-fit: cover;"
                            >
                        @endif
                    </td>
                    <td class="align-middle text-center">
                        {{-- Editar --}}
                        <a href="{{ route('admin.products.edit', $product->id) }}" 
                           class="btn btn-sm btn-warning"
                        >
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        {{-- Eliminar --}}
                        <form 
                            action="{{ route('admin.products.destroy', $product->id) }}" 
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('¿Estás seguro de eliminar este producto?');"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
