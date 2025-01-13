@extends('layouts.masterusers')

<style>
    .order-container {
        background-color: #f8f9fa;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .order-header {
        font-size: 1.75rem;
        font-weight: bold;
        color: #343a40;
        margin-bottom: 1.5rem;
    }

    .order-info {
        background-color: #ffffff;
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .order-info img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 0.5rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .order-info h4 {
        color: #007bff;
        margin-bottom: 0.5rem;
    }

    .table th {
        text-transform: uppercase;
        background-color: #007bff;
        color: white;
        font-weight: bold;
        text-align: center;
    }

    .table td {
        text-align: center;
        vertical-align: middle;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .cart-summary h4 {
        font-size: 1.5rem;
        color: #343a40;
    }
</style>

@section('content')
<div class="container py-5">
    <div class="order-container">
        <h1 class="order-header">Detalle del Pedido</h1>

        <!-- Información del Pedido -->
        <div class="order-info mb-4">
            <!-- Imagen del Pedido (primer producto) -->
            <img src="{{ asset($order->lines->first()->product->image ?? 'images/no-imagen.webp') }}" alt="Imagen del Pedido">

            <div>
                <h4>Pedido #{{ $order->id }}</h4>
                <p><strong>Usuario:</strong> {{ $order->user->name }}</p>
                <p><strong>Total:</strong> {{ number_format($order->total, 2) }}€</p>
                <p><strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Tabla de Productos -->
        <h4>Productos en el Pedido</h4>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th></th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->lines as $line)
                <tr>
                    <td>
                        <img src="{{ asset($line->product->image ?? 'images/no-imagen.webp') }}" alt="{{ $line->product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 0.25rem; margin-right: 0.5rem;">
                    </td>
                    <td>{{ $line->product->name }}</td>
                    <td>{{ $line->quantity }}</td>
                    <td>{{ number_format($line->price, 2) }}€</td>
                    <td>{{ number_format($line->quantity * $line->price, 2) }}€</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Resumen del Total -->
        <div class="cart-summary mt-4 text-end">
            <h4>Total: <span id="cart-total">{{ number_format($order->total, 2) }}€</span></h4>
        </div>

        <!-- Botón para regresar -->
        <div class="mt-4 text-end">
            <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Volver a la tienda</a>
        </div>
    </div>
</div>
@endsection
