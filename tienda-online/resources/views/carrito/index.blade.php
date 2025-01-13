@extends('layouts.masterusers')

<style>
    .cart-container {
        background-color: #f8f9fa;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .cart-header {
        font-size: 1.75rem;
        font-weight: bold;
        color: #343a40;
        margin-bottom: 1.5rem;
    }

    .cart-table th {
        text-transform: uppercase;
        font-weight: bold;
        background-color: #007bff;
        color: white;
    }

    .cart-table img {
        max-width: 50px;
        border-radius: 0.375rem;
        object-fit: cover;
    }

    .cart-summary {
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 0.5rem;
        padding: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .cart-summary h4 {
        font-size: 1.5rem;
        color: #007bff;
    }

    .btn-primary, .btn-danger {
        border-radius: 0.375rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }
</style>

@section('content')
<div class="container py-5">
    <div class="cart-container">
        <h1 class="cart-header">Tu Carrito</h1>

        @if ($cartItems->isEmpty())
            <div class="alert alert-warning">
                Tu carrito está vacío. <a href="{{ url('/productos') }}" class="text-primary">¡Explora nuestros productos!</a>
            </div>
        @else
            <table class="table table-bordered cart-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                    <tr data-line-id="{{ $item->id }}">
                        <td class="d-flex align-items-center">
                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="me-3">
                            <span>{{ $item->product->name }}</span>
                        </td>
                        <td>
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control quantity-input" style="width: 80px;" data-line-id="{{ $item->id }}">
                        </td>
                        <td>{{ number_format($item->product->price, 2) }}€</td>
                        <td class="subtotal">{{ number_format($item->product->price * $item->quantity, 2) }}€</td>
                        <td>
                            <form method="POST" action="{{ route('carrito.remove', $item->id) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <php>
                
            </php>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="cart-summary">
                    <h4>Total: <span id="cart-total">{{ number_format($cartTotal, 2) }}€</span></h4>
                </div>
                <div>
                    <a href="#" 
                        onclick="event.preventDefault(); document.getElementById('finalizar-compra-form').submit();" 
                        class="btn btn-primary btn-lg">
                        Finalizar Compra
                    </a>

                    <form id="finalizar-compra-form" action="{{ route('orders.finalizar') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const quantityInputs = document.querySelectorAll('.quantity-input');

        quantityInputs.forEach(input => {
            input.addEventListener('change', async (event) => {
                const lineId = event.target.dataset.lineId;
                const newQuantity = event.target.value;

                try {
                    const response = await fetch('{{ route('carrito.update.ajax') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ lineId, quantity: newQuantity }),
                    });

                    const data = await response.json();

                    if (data.success) {
                        const row = document.querySelector(`tr[data-line-id="${lineId}"]`);
                        
                        // Actualizar el campo de cantidad con el valor permitido
                        input.value = data.updatedQuantity;

                        // Actualizar subtotal y total
                        row.querySelector('.subtotal').textContent = `${data.subtotal}€`;
                        document.getElementById('cart-total').textContent = `${data.cartTotal}€`;
                    } else {
                        alert(data.message || 'Error al actualizar el carrito.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Hubo un problema al actualizar el carrito.');
                }
            });
        });
    });
</script>
@endsection
