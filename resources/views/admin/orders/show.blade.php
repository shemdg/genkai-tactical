<x-admin.layout>
    <x-slot:title>Order Details</x-slot:title>

    <div class="max-w-5xl">
        <div class="mb-6">
            <a href="{{ route('admin.orders.index') }}" class="text-gray-600 hover:text-red-600">
                ← Back to Orders
            </a>
        </div>

        <!-- Order Header -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Order #{{ $order->order_number }}</h2>
                    <p class="text-gray-600">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-600 mb-2">Status</div>
                    <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full
                        {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $order->status === 'confirmed' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>

            <!-- Update Status -->
            <div class="border-t pt-6">
                <h3 class="font-bold mb-3">Update Order Status</h3>
                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="flex items-center gap-4">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg">
                        Update Status
                    </button>
                </form>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <!-- Customer Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-bold text-lg mb-4">Customer Information</h3>
                <div class="space-y-2 text-gray-700">
                    <p><span class="font-semibold">Name:</span> {{ $order->customer_name }}</p>
                    <p><span class="font-semibold">Email:</span> {{ $order->customer_email }}</p>
                    <p><span class="font-semibold">Phone:</span> {{ $order->customer_phone }}</p>
                    <p><span class="font-semibold">Address:</span> {{ $order->customer_address }}</p>
                    @if($order->notes)
                        <p><span class="font-semibold">Notes:</span> {{ $order->notes }}</p>
                    @endif
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-bold text-lg mb-4">Order Summary</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-semibold">₱{{ number_format($order->total, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping</span>
                        <span class="font-semibold">To be arranged</span>
                    </div>
                    <div class="border-t pt-2 flex justify-between text-lg">
                        <span class="font-bold">Total</span>
                        <span class="font-bold text-red-600">₱{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-bold text-lg mb-4">Order Items</h3>
            <div class="space-y-4">
                @foreach($order->orderItems as $item)
                    <div class="flex items-center gap-4 pb-4 border-b last:border-b-0">
                        <div class="bg-gray-200 rounded w-20 h-20 flex items-center justify-center flex-shrink-0">
                            <span class="text-3xl">🔪</span>
                        </div>
                        <div class="flex-grow">
                            <p class="font-bold">{{ $item->product_name }}</p>
                            <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                            <p class="text-sm text-gray-600">Price: ₱{{ number_format($item->price, 2) }} each</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-lg">₱{{ number_format($item->subtotal, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-admin.layout>
