<x-layout>
    <x-slot:title>Checkout</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-8">Checkout</h1>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Customer Information -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h2 class="font-bold text-2xl mb-6">Customer Information</h2>

                        <div class="space-y-4">
                            <!-- Name -->
                            <div>
                                <label class="block font-semibold mb-2">Full Name *</label>
                                <input type="text"
                                       name="customer_name"
                                       value="{{ old('customer_name') }}"
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent @error('customer_name') border-red-500 @enderror">
                                @error('customer_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block font-semibold mb-2">Email Address *</label>
                                <input type="email"
                                       name="customer_email"
                                       value="{{ old('customer_email') }}"
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent @error('customer_email') border-red-500 @enderror">
                                @error('customer_email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label class="block font-semibold mb-2">Phone Number *</label>
                                <input type="tel"
                                       name="customer_phone"
                                       value="{{ old('customer_phone') }}"
                                       required
                                       placeholder="+63 XXX XXX XXXX"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent @error('customer_phone') border-red-500 @enderror">
                                @error('customer_phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div>
                                <label class="block font-semibold mb-2">Complete Address *</label>
                                <textarea name="customer_address"
                                          rows="4"
                                          required
                                          placeholder="House/Unit No., Street, Barangay, City, Province, ZIP Code"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent @error('customer_address') border-red-500 @enderror">{{ old('customer_address') }}</textarea>
                                @error('customer_address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Notes -->
                            <div>
                                <label class="block font-semibold mb-2">Order Notes (Optional)</label>
                                <textarea name="notes"
                                          rows="3"
                                          placeholder="Any special instructions or requests..."
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-20">
                        <h3 class="font-bold text-xl mb-6">Order Summary</h3>

                        <!-- Cart Items -->
                        <div class="space-y-4 mb-6 max-h-64 overflow-y-auto">
                            @foreach($cartItems as $item)
                                <div class="flex gap-4 pb-4 border-b">
                                    <div class="w-16 h-16">
                                        <img class="rounded" src="https://images.unsplash.com/photo-1614607453779-44602e149456?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="knife" />
                                    </div>
                                    <div class="flex-grow">
                                        <p class="font-semibold text-sm">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-600">Qty: {{ $item->quantity }}</p>
                                        <p class="text-sm font-bold text-secondary">₱{{ number_format($item->subtotal, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Totals -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>₱{{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span>To be arranged</span>
                            </div>
                            <div class="border-t pt-3 flex justify-between font-bold text-xl">
                                <span>Total</span>
                                <span class="text-secondary">₱{{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <!-- Payment Info -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6 text-sm text-gray-600">
                            <p class="font-semibold mb-2">📦 Payment & Delivery</p>
                            <p>We will contact you to arrange payment and delivery details after your order is placed.</p>
                        </div>

                        <!-- Place Order Button -->
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-400 text-white font-bold py-4 px-6 rounded-lg transition">
                            Place Order
                        </button>

                        <a href="{{ route('cart.index') }}" class="block text-center mt-4 text-gray-600 hover:text-secondary font-semibold">
                            ← Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layout>
