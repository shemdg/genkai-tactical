<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function getSessionId()
    {
        if (!session()->has('cart_session')) {
            session()->put('cart_session', uniqid('cart_', true));
        }
        return session()->get('cart_session');
    }

    public function index()
    {
        $cartItems = CartItem::where('session_id', $this->getSessionId())
            ->with('product')
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('cart.index', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $sessionId = $this->getSessionId();

        $cartItem = CartItem::where('session_id', $sessionId)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'session_id' => $sessionId,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }

    public function clear()
    {
        CartItem::where('session_id', $this->getSessionId())->delete();

        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}
