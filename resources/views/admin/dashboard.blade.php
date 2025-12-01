<x-admin.layout>
    <x-slot:title>Dashboard</x-slot:title>

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Total Products</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_products'] }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Total Orders</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_orders'] }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Pending Orders</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['pending_orders'] }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Total Revenue</p>
                    <p class="text-3xl font-bold text-gray-900">₱{{ number_format($stats['total_revenue'], 2) }}</p>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-8">
        <!-- Recent Orders -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b flex items-center justify-between">
                <h2 class="text-xl font-bold">Recent Orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-red-600 hover:text-red-700 font-semibold text-sm">
                    View All →
                </a>
            </div>
            <div class="p-6">
                @if($recentOrders->isEmpty())
                    <p class="text-gray-500 text-center py-4">No orders yet</p>
                @else
                    <div class="space-y-4">
                        @foreach($recentOrders as $order)
                            <div class="flex items-center justify-between border-b pb-4">
                                <div>
                                    <p class="font-semibold">{{ $order->order_number }}</p>
                                    <p class="text-sm text-gray-600">{{ $order->customer_name }}</p>
                                    <p class="text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-red-600">₱{{ number_format($order->total, 2) }}</p>
                                    <span class="inline-block px-2 py-1 text-xs rounded-full
                                    {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $order->status === 'confirmed' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b flex items-center justify-between">
                <h2 class="text-xl font-bold">Low Stock Alert</h2>
                <a href="{{ route('admin.products.index') }}" class="text-red-600 hover:text-red-700 font-semibold text-sm">
                    Manage Products →
                </a>
            </div>
            <div class="p-6">
                @if($lowStock->isEmpty())
                    <p class="text-gray-500 text-center py-4">All products have sufficient stock</p>
                @else
                    <div class="space-y-4">
                        @foreach($lowStock as $product)
                            <div class="flex items-center justify-between border-b pb-4">
                                <div>
                                    <p class="font-semibold">{{ $product->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $product->category->name }}</p>
                                </div>
                                <div class="text-right">
                                <span class="inline-block px-3 py-1 bg-red-100 text-red-800 rounded-full font-bold">
                                    {{ $product->stock }} left
                                </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin.layout>
