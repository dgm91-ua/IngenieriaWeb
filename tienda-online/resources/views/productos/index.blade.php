@extends('layouts.masterusers')

@section('content')
<div class="container py-5">

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
                        <a href="#" class="btn btn-primary mt-auto">Ver Detalles</a>
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
