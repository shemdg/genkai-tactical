<x-layout>
    <x-slot:title>Order Confirmation</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <!-- Success Message -->
            <div class="bg-green-50 border-2 border-green-200 rounded-lg p-8 text-center mb-8">
                <div class="text-6xl mb-4">✅</div>
                <h1 class="text-3xl font-bold mb-2">Order Placed Successfully!</h1>
                <p class="text-gray-600 mb-4">Order #<span class="font-bold">{{ $order->order_number }}</span></p>
                
                @if($order->payment_method === 'gcash')
                    <div class="bg-yellow-100 border-2 border-yellow-300 rounded-lg p-4 mt-4">
                        <div class="flex items-center justify-center gap-2 mb-2">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="font-bold text-lg text-yellow-800">Payment Pending Verification</h3>
                        </div>
                        <p class="text-yellow-800">
                            We've received your GCash reference: <span class="font-bold">{{ $order->payment_reference }}</span>
                        </p>
                        <p class="text-yellow-800 text-sm mt-2">
                            We'll verify your payment and send you a confirmation email at <span class="font-semibold">{{ $order->customer_email }}</span> shortly.
                        </p>
                    </div>
                @elseif($order->payment_method === 'cod')
                    <div class="bg-blue-100 border-2 border-blue-300 rounded-lg p-4 mt-4">
                        <div class="flex items-center justify-center gap-2 mb-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <h3 class="font-bold text-lg text-blue-800">Cash on Delivery</h3>
                        </div>
                        <p class="text-blue-800">
                            Please prepare <span class="font-bold text-xl">₱{{ number_format($order->total, 2) }}</span> when your order arrives.
                        </p>
                        <p class="text-blue-800 text-sm mt-2">
                            We'll contact you at <span class="font-semibold">{{ $order->customer_phone }}</span> to arrange delivery.
                        </p>
                    </div>
                @endif
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
                        <p class="text-sm text-gray-600 mb-1">Payment Method</p>
                        <div class="flex items-center gap-2">
                            @if($order->payment_method === 'gcash')
                                <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    GCash
                                </span>
                                @if($order->payment_status === 'verified')
                                    <span class="text-xs text-green-600">✓ Verified</span>
                                @elseif($order->payment_status === 'pending')
                                    <span class="text-xs text-yellow-600">⏳ Pending</span>
                                @endif
                            @else
                                <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    Cash on Delivery
                                </span>
                            @endif
                        </div>
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
                                <p class="font-bold text-lg">₱{{ number_format($item->price * $item->quantity, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Actions -->
            <div class="text-center">
                <a href="{{ route('home') }}" class="inline-block bg-brand-secondary hover:bg-brand-secondary-hover text-white font-bold py-3 px-8 rounded-lg transition">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</x-layout>