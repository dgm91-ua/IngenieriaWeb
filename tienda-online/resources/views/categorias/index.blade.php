@extends('layouts.masterusers')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Categorías</h1>
    <div class="row">
        @forelse ($categorias as $categoria)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <!-- Imagen de la categoría -->
                    <img src="{{ asset($categoria->image ?? 'images/default-category.png') }}" class="card-img-top" alt="{{ $categoria->name }}" style="object-fit: cover; height: 250px;">

                    <div class="card-body d-flex flex-column">
                        <!-- Nombre de la categoría -->
                        <h5 class="card-title text-center">{{ $categoria->name }}</h5>
                        
                        <!-- Descripción -->
                        <p class="text-center text-muted">{{ $categoria->description }}</p>
                        
                        <!-- Botón Ver Productos -->
                        <a href="{{ route('productos.index', ['categoria' => $categoria->id]) }}" class="btn btn-primary mt-auto">Ver Productos</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No hay categorías disponibles.</p>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $categorias->links() }}
    </div>
</div>
@endsection
