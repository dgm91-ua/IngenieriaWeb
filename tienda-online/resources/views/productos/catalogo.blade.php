@extends('layouts.masterusers')

@section('content')
<div class="container py-4">
    <!-- Título -->
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold">
            @if ($selectedCategory)
                <span class="text-secondary">Productos de la categoría:</span> </br>
                <span class="text-primary">{{ $selectedCategory->name }}</span>
            @else
                <span class="text-secondary">Descubre</span> </br>
                <span class="text-primary">Todos los Productos</span>
            @endif
        </h1>
        <p class="text-muted mt-2">Encuentra lo que buscas fácilmente</p>
    </div>

    <!-- Icono de Filtro con Formulario Desplegable -->
    <div class="mb-4">
        <button class="btn btn-outline-primary d-flex align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#filterForm" aria-expanded="false" aria-controls="filterForm">
            <i class="bi bi-funnel me-2"></i> Filtros
        </button>

        <!-- Formulario de Filtros -->
        <div class="collapse mt-3" id="filterForm">
            <form action="{{ route('productos.catalogo', $selectedCategory ? $selectedCategory->id : null) }}" method="GET">
                <div class="row g-3">
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
                                <option 
                                    value="{{ $category->id }}" 
                                    {{ isset($selectedCategory) && $selectedCategory->id == $category->id ? 'selected' : '' }}>
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
                    <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
                    <a href="{{ route('productos.catalogo') }}" class="btn btn-secondary">Limpiar Filtros</a>
                </div>
            </form>
        </div>
    </div>


    <!-- Listado de Productos -->
    <div class="row">
        @forelse ($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset($producto->image ?? 'images/default-product.png') }}" class="card-img-top" alt="{{ $producto->name }}" style="object-fit: cover; height: 200px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $producto->name }}</h5>
                        <p class="text-success fw-bold">{{ number_format($producto->price, 2) }}€</p>
                        <a href="{{ route('producto.show', $producto->id) }}" class="btn btn-primary mt-auto">Ver Detalles</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No se encontraron productos.</p>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $productos->withQueryString()->links() }}
    </div>
</div>
@endsection
