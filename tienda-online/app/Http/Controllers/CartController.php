<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartLine;
use App\Models\Product;

class CartController extends Controller
{
    public function agregar(Request $request, $productoId)
    {
        // Obtener el producto
        $producto = Product::findOrFail($productoId);

        // Obtener o crear el carrito del usuario autenticado
        $user = auth()->user();
        $carrito = $user->carts ?? $user->carts()->create();

        // Validar la cantidad
        $cantidad = max(1, min($request->quantity, $producto->stock));

        // Agregar o actualizar la línea del carrito
        $linea = $carrito->lines()->where('product_id', $productoId)->first();

        if ($linea) {
            $linea->quantity += $cantidad; // Incrementar la cantidad

            // Validar la cantidad
            $linea->quantity = max(1, min($linea->quantity, $producto->stock));
            $linea->save();
        } else {
            CartLine::create([
                'cart_id' => $carrito->id,
                'product_id' => $productoId,
                'quantity' => $cantidad,
            ]);
        }

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    public function index()
    {
        $cartItems = auth()->user()->carts->lines ?? collect();
        $cartTotal = $cartItems->sum(function ($line) {
            return $line->quantity * $line->product->price;
        });

        return view('carrito.index', compact('cartItems', 'cartTotal'));
    }

    public function updateAjax(Request $request)
    {
        // Validar la solicitud
        $validated = $request->validate([
            'lineId' => 'required|exists:cart_lines,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Obtener la línea del carrito y el producto asociado
        $line = CartLine::findOrFail($validated['lineId']);
        $maxStock = $line->product->stock;

        $cantidad = $validated['quantity'];

        // Validar que la cantidad no exceda el stock disponible
        if ($cantidad > $maxStock) {
            $cantidad = $maxStock;
        }

        // Actualizar la cantidad en la línea del carrito
        $line->quantity = $cantidad;
        $line->save();

        // Recalcular subtotal y total del carrito
        $subtotal = number_format($line->product->price * $line->quantity, 2);
        $cartTotal = number_format($line->cart->lines->sum(function ($line) {
            return $line->product->price * $line->quantity;
        }), 2);

        return response()->json([
            'success' => true,
            'subtotal' => $subtotal,
            'cartTotal' => $cartTotal,
            'updatedQuantity' => $cantidad, // Devolver la cantidad actualizada
        ]);
    }

    public function remove($id)
    {
        $line = CartLine::findOrFail($id);
        $line->delete();

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
    }
}
