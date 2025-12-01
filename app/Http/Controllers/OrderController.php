<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private function getSessionId()
    {
        return session()->get('cart_session');
    }

    public function create()
    {
        $cartItems = CartItem::where('session_id', $this->getSessionId())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('orders.create', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'customer_address' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $cartItems = CartItem::where('session_id', $this->getSessionId())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        // Create Order
        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'customer_address' => $validated['customer_address'],
            'total' => $total,
            'notes' => $validated['notes'] ?? null,
        ]);

        // Create Order Items
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_name' => $cartItem->product->name,
                'price' => $cartItem->product->price,
                'quantity' => $cartItem->quantity,
            ]);
        }

        // Clear Cart
        CartItem::where('session_id', $this->getSessionId())->delete();

        return redirect()->route('orders.show', $order->order_number)
            ->with('success', 'Order placed successfully!');
    }

    public function show(Order $order)
    {
        $order->load('orderItems.product');

        return view('orders.show', [
            'order' => $order,
        ]);
    }
}
