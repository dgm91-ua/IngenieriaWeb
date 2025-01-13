@extends('layouts.masterusers')

@section('content')
<div class="container py-5">
    <!-- Información del producto -->
    <div class="row mb-5">
        <!-- Imagen del producto -->
        <div class="col-md-6">
            <img src="{{ asset($producto->image ?? 'images/default-product.png') }}" alt="{{ $producto->name }}" class="img-fluid rounded shadow">
        </div>

        <!-- Detalles del producto -->
        <div class="col-md-6">
            <h1 class="fw-bold">{{ $producto->name }}</h1>
            <p class="text-muted">
                <a href="{{ route('productos.catalogo', $producto->category->id) }}" class="text-primary fw-bold">
                    {{ $producto->category->name }}
                </a>
            </p>
            <p class="lead">{{ $producto->description }}</p>
            <p class="text-muted">Stock: {{ $producto->stock }}</p>
            <h2 class="text-success fw-bold">${{ number_format($producto->price, 2) }}</h2>
            
            @if (Auth::check())
                <!-- Usuario autenticado -->
                <div class="d-flex flex-column flex-md-row align-items-start gap-3 mt-3">
                    @if ($producto->stock > 0)
                        <!-- Campo de cantidad y botones -->
                        <form method="POST" action="{{ route('carrito.agregar', $producto->id) }}" id="action-form">
                            @csrf
                            <div class="d-flex align-items-center">
                                <input 
                                    type="number" 
                                    name="quantity" 
                                    value="1" 
                                    min="1" 
                                    max="{{ $producto->stock }}"
                                    class="form-control me-2" 
                                    style="width: 100px;"
                                >
                                <div class="btn-group">
                                    <!-- Añadir al carrito -->
                                    <button type="submit" formaction="{{ route('carrito.agregar', $producto->id) }}" class="btn btn-success btn-lg">Añadir al Carrito</button>
                                    <!-- Comprar Ahora -->
                                    <button type="submit" formaction="{{ route('orders.comprar', $producto->id) }}" class="btn btn-primary btn-lg">Comprar Ahora</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <!-- Mensaje sin stock -->
                        <div class="alert alert-danger mt-3">
                        <p>Este producto no está disponible actualmente. Sentimos las molestias.</p>
                        </div>
                    @endif
                </div>
            @else
                <!-- Usuario no autenticado -->
                <div class="d-flex flex-column flex-md-row align-items-start gap-3 mt-3">
                    @if ($producto->stock > 0)
                        <form action="{{ route('orders.comprar', $producto->id) }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            <input 
                                type="number" 
                                name="quantity" 
                                value="1" 
                                min="1" 
                                class="form-control me-2" 
                                style="width: 100px;"
                            >
                            <button type="submit" class="btn btn-primary btn-lg">Comprar Ahora</button>
                        </form>
                    @else
                        <!-- Mensaje sin stock -->
                        <div class="alert alert-danger mt-3">
                            <p>Este producto no está disponible actualmente. Sentimos las molestias.</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Productos sugeridos -->
    <div class="mt-5">
        <h3 class="fw-bold mb-4">Productos Sugeridos</h3>
        <div class="row">
            @foreach ($productosSugeridos as $sugerido)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <!-- Imagen -->
                        <img src="{{ asset($sugerido->image ?? 'images/default-product.png') }}" class="card-img-top" alt="{{ $sugerido->name }}" style="object-fit: cover; height: 200px;">

                        <div class="card-body d-flex flex-column">
                            <!-- Nombre -->
                            <h5 class="card-title text-center">{{ $sugerido->name }}</h5>

                            <!-- Precio -->
                            <p class="text-center text-success fw-bold mb-2">${{ number_format($sugerido->price, 2) }}</p>

                            <!-- Botón Ver Detalles -->
                            <a href="{{ route('producto.show', $sugerido->id) }}" class="btn btn-outline-primary mt-auto">Ver Detalles</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
