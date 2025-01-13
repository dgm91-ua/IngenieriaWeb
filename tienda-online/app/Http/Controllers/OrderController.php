<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Cart;
use App\Models\CartLine;
use App\Models\Product;

class OrderController extends Controller
{
    public function finalizarCompraDesdeCarrito()
{
    $user = auth()->user();
    $cart = $user->carts;

    if ($cart->lines->isEmpty()) {
        return redirect()->back()->with('error', 'Tu carrito está vacío.');
    }

    // Validar el stock de todos los productos en el carrito
    foreach ($cart->lines as $line) {
        if ($line->quantity > $line->product->stock) {
            return redirect()->back()->with(
                'error', 
                'No hay suficiente stock para el producto: ' . $line->product->name
            );
        }
    }

    // Crear el pedido
    $order = Order::create([
        'user_id' => $user->id,
        'total' => $cart->lines->reduce(function ($carry, $line) {
            return $carry + ($line->product->price * $line->quantity);
        }, 0),
    ]);

    // Crear las líneas del pedido y reducir el stock de los productos
    foreach ($cart->lines as $line) {
        OrderLine::create([
            'order_id' => $order->id,
            'product_id' => $line->product_id,
            'quantity' => $line->quantity,
            'price' => $line->product->price,
        ]);

        // Reducir el stock del producto
        $line->product->stock -= $line->quantity;
        $line->product->save();
    }

    // Vaciar el carrito
    $cart->lines()->delete();

    return redirect()->route('pedido.show', $order->id)->with('success', 'Compra realizada con éxito.');
}


    public function comprarProductoDirectamente(Request $request, $productId)
    {
        $user = auth()->user();
        $product = Product::findOrFail($productId);
        
        // Validar la cantidad
        $cantidad = max(1, min($request->quantity, $product->stock));

        // Crear el pedido
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $product->price * $cantidad,
        ]);

        // Crear la línea del pedido
        OrderLine::create([
            'order_id' => $order->id,
            'product_id' => $productId,
            'quantity' => $cantidad,
            'price' => $product->price,
        ]);

        // Reducir el stock del producto
        $product->stock -= $cantidad;
        $product->save();

        return redirect()->route('pedido.show', $order->id)->with('success', 'Producto comprado con éxito.');
    }

    public function show($id)
    {
        $order = Order::with('lines.product')->findOrFail($id);
        return view('pedido.show', compact('order'));
    }

    public function misPedidos()
    {
        $user = auth()->user();

        // Obtener los pedidos del usuario, junto con las líneas de pedido y productos
        $pedidos = $user->orders()->with('lines.product')->orderBy('created_at', 'desc')->paginate(10);

        return view('pedido.mis-pedidos', compact('pedidos'));
    }
}
