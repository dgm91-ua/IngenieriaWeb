@extends('layouts.masterusers')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Mis Pedidos</h1>

    @if ($pedidos->isEmpty())
        <div class="alert alert-warning">
            No has realizado ningún pedido todavía. <a href="{{ route('productos.catalogo') }}">¡Explora nuestros productos!</a>
        </div>
    @else
        @foreach ($pedidos as $pedido)
            <div class="card mb-4 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <!-- Información del Pedido -->
                    <div>
                        <h5 class="card-title">Pedido #{{ $pedido->id }}</h5>
                        <p class="card-text">
                            <strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}<br>
                            <strong>Total:</strong> {{ number_format($pedido->total, 2) }}€
                        </p>
                        <a href="{{ route('pedido.show', $pedido->id) }}" class="text-primary fw-bold">
                            Ver Detalles
                        </a>
                    </div>

                    <!-- Tarjetas de Productos -->
                    <div class="d-flex justify-content-start gap-3">
                        @foreach ($pedido->lines->take(7) as $line)
                            <div class="card shadow-sm" style="width: 120px;">
                                <img src="{{ asset($line->product->image ?? 'images/default-product.png') }}" alt="{{ $line->product->name }}" class="card-img-top" style="height: 80px; object-fit: cover;">
                                <div class="card-body text-center p-2">
                                    <small class="card-text text-muted">{{ $line->product->name }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Paginación -->
        <div class="d-flex justify-content-center">
            {{ $pedidos->links() }}
        </div>
    @endif
</div>
@endsection
