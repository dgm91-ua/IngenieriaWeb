@extends('layouts.masterusers')

@section('content')
<style>
    .card {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
        transform: scale(1.03);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 0.375rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        border-radius: 0.375rem;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    .form-select, .form-control {
        border-radius: 0.375rem;
    }
</style>
<div class="container py-4">

    <!-- Título -->
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold">
            @if ($categoriaNombre)
                <span class="text-secondary">Productos de la categoría:</span> </br>
                <span class="text-primary">{{ $categoriaNombre }}</span>
            @else
                <span class="text-secondary">Descubre</span> </br>
                <span class="text-primary">Nuestros Perfumes</span>
            @endif
        </h1>
        <p class="text-muted mt-2">Encuentra la fragancia perfecta para cada ocasión</p>
        </br>
        </br>
    </div>

    <!-- Formulario de Filtros -->
    <form action="{{ route('productos.catalogo') }}" method="GET" class="mb-4">
        <div class="row">
            <!-- Búsqueda por Nombre -->
            <div class="col-md-4">
                <input 
                    type="text" 
                    name="search" 
                    class="form-control" 
                    placeholder="Buscar por nombre" 
                    value="{{ request('search') }}">
            </div>

            <!-- Filtro por Categoría -->
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">Todas las categorías</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filtro por Precio -->
            <div class="col-md-3">
                <div class="d-flex">
                    <input 
                        type="number" 
                        name="min_price" 
                        class="form-control me-2" 
                        placeholder="Precio mínimo" 
                        value="{{ request('min_price') }}">
                    <input 
                        type="number" 
                        name="max_price" 
                        class="form-control" 
                        placeholder="Precio máximo" 
                        value="{{ request('max_price') }}">
                </div>
            </div>

            <!-- Orden -->
            <div class="col-md-2">
                <select name="sort" class="form-select">
                    <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>Nombre A-Z</option>
                    <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Nombre Z-A</option>
                </select>
            </div>
        </div>

        <div class="mt-3 text-end">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('productos.catalogo') }}" class="btn btn-secondary">Limpiar Filtros</a>
        </div>
    </form>

    
    <!-- Productos -->
    <div class="row">
        @forelse ($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <!-- Imagen del producto -->
                    <img src="{{ asset($producto->image ?? 'images/default-product.png') }}" class="card-img-top" alt="{{ $producto->name }}" style="object-fit: cover; height: 200px;">

                    <div class="card-body d-flex flex-column">
                        <!-- Nombre del producto -->
                        <h5 class="card-title text-center">{{ $producto->name }}</h5>
                        
                        <!-- Precio -->
                        <p class="text-center text-success fw-bold mb-2">${{ number_format($producto->price, 2) }}</p>
                        
                        <!-- Botón Ver Detalles -->
                        <a href="{{ route('producto.show', $producto->id) }}" class="btn btn-primary mt-auto">Ver Detalles</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No hay productos disponibles.</p>
        @endforelse
    </div>
    
    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $productos->links() }}
    </div>
</div>
@endsection
