<x-layout>
    <x-slot:title>Order Confirmation</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <!-- Success Message -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-8 text-center mb-8">
                <div class="text-6xl mb-4">✅</div>
                <h1 class="text-3xl font-bold mb-2">Order Placed Successfully!</h1>
                <p class="text-gray-600">Thank you for your order. We'll contact you shortly.</p>
            </div>

            <!-- Order Details -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="font-bold text-2xl mb-4">Order Details</h2>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Order Number</p>
                        <p class="font-bold text-lg">{{ $order->order_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Order Date</p>
                        <p class="font-bold text-lg">{{ $order->created_at->format('F d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Status</p>
                        <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Amount</p>
                        <p class="font-bold text-lg text-red-600">₱{{ number_format($order->total, 2) }}</p>
                    </div>
                </div>

                <div class="border-t pt-6">
                    <h3 class="font-bold mb-3">Customer Information</h3>
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
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h3 class="font-bold text-xl mb-4">Order Items</h3>

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

            <!-- Actions -->
            <div class="text-center">
                <a href="{{ route('home') }}" class="inline-block bg-secondary hover:bg-secondary-hover text-white font-bold py-3 px-8 rounded-lg transition">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</x-layout>
