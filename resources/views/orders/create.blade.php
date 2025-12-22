<x-layout>
    <x-slot:title>Checkout</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-8">Checkout</h1>

        <form action="{{ route('orders.store') }}" method="POST" id="checkoutForm">
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
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-secondary focus:border-transparent @error('customer_name') border-red-500 @enderror">
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
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-secondary focus:border-transparent @error('customer_email') border-red-500 @enderror">
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
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-secondary focus:border-transparent @error('customer_phone') border-red-500 @enderror">
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
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-secondary focus:border-transparent @error('customer_address') border-red-500 @enderror">{{ old('customer_address') }}</textarea>
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
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-secondary focus:border-transparent">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="font-bold text-2xl mb-6">Payment Method *</h2>

                        <div class="space-y-4">
                            <!-- GCash Option -->
                            <label class="flex items-start p-4 border-2 rounded-lg cursor-pointer hover:border-green-500 transition @error('payment_method') border-red-500 @enderror" id="gcash-label">
                                <input type="radio" 
                                       name="payment_method" 
                                       value="gcash" 
                                       class="mt-1 mr-4"
                                       {{ old('payment_method') == 'gcash' ? 'checked' : '' }}>
                                <div class="flex-grow">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="font-bold text-lg">GCash Payment</span>
                                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-semibold">ONLINE</span>
                                    </div>
                                    <p class="text-gray-600 text-sm">Pay instantly via GCash. Fast and secure.</p>
                                </div>
                            </label>

                            <!-- COD Option -->
                            <label class="flex items-start p-4 border-2 rounded-lg cursor-pointer hover:border-blue-500 transition" id="cod-label">
                                <input type="radio" 
                                       name="payment_method" 
                                       value="cod" 
                                       class="mt-1 mr-4"
                                       {{ old('payment_method') == 'cod' || !old('payment_method') ? 'checked' : '' }}>
                                <div class="flex-grow">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="font-bold text-lg">Cash on Delivery</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-semibold">COD</span>
                                    </div>
                                    <p class="text-gray-600 text-sm">Pay with cash when you receive your order.</p>
                                </div>
                            </label>

                            @error('payment_method')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- GCash Instructions (Hidden by default) -->
                        <div id="gcash-instructions" class="mt-6 bg-green-50 border-2 border-green-200 rounded-lg p-6" style="display: none;">
                            <div class="flex items-start gap-3 mb-4">
                                <div class="bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 font-bold">1</div>
                                <div>
                                    <h3 class="font-bold text-lg mb-1">Send Payment to GCash</h3>
                                    <p class="text-gray-700 mb-2">Send <span class="font-bold text-green-700">₱{{ number_format($total, 2) }}</span> to:</p>
                                    <div class="bg-white rounded-lg p-4 border-2 border-green-300">
                                        <p class="text-sm text-gray-600 mb-1">GCash Number:</p>
                                        <p class="text-2xl font-bold text-green-700">09918846494</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 mb-4">
                                <div class="bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 font-bold">2</div>
                                <div class="flex-grow">
                                    <h3 class="font-bold text-lg mb-1">Get Your Reference Number</h3>
                                    <p class="text-gray-700 mb-3">After sending, check your GCash transaction history for the reference number.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 font-bold">3</div>
                                <div class="flex-grow">
                                    <h3 class="font-bold text-lg mb-2">Enter Reference Number</h3>
                                    <input type="text" 
                                           id="payment_reference"
                                           name="payment_reference" 
                                           value="{{ old('payment_reference') }}"
                                           placeholder="e.g., 1234567890123"
                                           class="w-full px-4 py-3 border-2 border-green-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent font-mono text-lg @error('payment_reference') border-red-500 @enderror">
                                    <p class="text-sm text-gray-600 mt-2">💡 This helps us verify your payment quickly</p>
                                    @error('payment_reference')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
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
                                        <p class="text-sm font-bold text-brand-secondary">₱{{ number_format($item->quantity * $item->product->price, 2) }}</p>
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
                                <span class="text-brand-secondary">₱{{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <!-- Place Order Button -->
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-400 text-white font-bold py-4 px-6 rounded-lg transition">
                            Place Order
                        </button>

                        <a href="{{ route('cart.index') }}" class="block text-center mt-4 text-gray-600 hover:text-brand-secondary font-semibold">
                            ← Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gcashRadio = document.querySelector('input[name="payment_method"][value="gcash"]');
            const codRadio = document.querySelector('input[name="payment_method"][value="cod"]');
            const gcashInstructions = document.getElementById('gcash-instructions');
            const paymentReference = document.getElementById('payment_reference');
            const gcashLabel = document.getElementById('gcash-label');
            const codLabel = document.getElementById('cod-label');

            function togglePaymentMethod() {
                if (gcashRadio.checked) {
                    gcashInstructions.style.display = 'block';
                    paymentReference.required = true;
                    gcashLabel.classList.add('border-green-500', 'bg-green-50');
                    codLabel.classList.remove('border-blue-500', 'bg-blue-50');
                } else {
                    gcashInstructions.style.display = 'none';
                    paymentReference.required = false;
                    paymentReference.value = '';
                    gcashLabel.classList.remove('border-green-500', 'bg-green-50');
                    codLabel.classList.add('border-blue-500', 'bg-blue-50');
                }
            }

            gcashRadio.addEventListener('change', togglePaymentMethod);
            codRadio.addEventListener('change', togglePaymentMethod);

            // Check on page load
            togglePaymentMethod();
        });
    </script>
</x-layout>