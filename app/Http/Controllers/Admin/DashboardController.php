<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_revenue' => Order::where('status', '!=', 'cancelled')->sum('total'),
        ];

        $recentOrders = Order::latest()->take(5)->get();
        $lowStock = Product::where('stock', '<', 5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'lowStock'));
    }
}
