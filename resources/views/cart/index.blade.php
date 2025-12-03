<x-layout>
    <x-slot:title>Shopping Cart</x-slot:title>

    <div class="container mx-auto px-4 py-8 h-[600px]">
        <h1 class="text-4xl font-bold mb-8">Shopping Cart</h1>

        @if($cartItems->isEmpty())
            <!-- Empty Cart -->
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <div class="text-6xl mb-4">🛒</div>
                <h2 class="text-2xl font-bold mb-4">Your cart is empty</h2>
                <p class="text-gray-600 mb-8">Add some awesome knives to get started!</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-secondary hover:bg-secondary-hover text-white font-bold py-3 px-8 rounded-lg transition">
                    Browse Products
                </a>
            </div>
        @else
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cartItems as $item)
                        <div class="bg-white rounded-lg shadow-md p-6 flex items-center gap-6">
                            <!-- Product Image -->
                            <div class="bg-gray-200 rounded-lg w-24 h-24 flex items-center justify-center flex-shrink-0">
                                <img src="https://images.unsplash.com/photo-1685894102362-bd09b756ff6d?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="knife" />
                            </div>

                            <!-- Product Info -->
                            <div class="flex-grow">
                                <a href="{{ route('products.show', $item->product->slug) }}" class="font-bold text-lg hover:text-secondary">
                                    {{ $item->product->name }}
                                </a>
                                <p class="text-sm text-gray-600">{{ $item->product->category->name }}</p>
                                <p class="text-lg font-bold text-secondary mt-2">₱{{ number_format($item->product->price, 2) }}</p>
                            </div>

                            <!-- Quantity -->
                            <div class="flex items-center gap-4">
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number"
                                           name="quantity"
                                           value="{{ $item->quantity }}"
                                           min="1"
                                           max="{{ $item->product->stock }}"
                                           class="w-20 px-3 py-2 border border-gray-300 rounded-lg text-center"
                                           onchange="this.form.submit()">
                                </form>

                                <!-- Subtotal -->
                                <div class="text-right w-28">
                                    <p class="font-bold text-lg">₱{{ number_format($item->subtotal, 2) }}</p>
                                </div>

                                <!-- Remove Button -->
                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-secondary hover:text-red-800 p-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <!-- Clear Cart -->
                    <form action="{{ route('cart.clear') }}" method="POST" id="clearCartForm">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                                class="text-red-600 hover:text-red-800 font-semibold"
                                onclick="openClearCartModal()">
                            Clear Cart
                        </button>
                    </form>

                    <!-- Modal (hidden by default), i noticed the bg-black/50 doesnt fully cover the page and it icks me lmao. i added h-screen -->
                    <div class="fixed inset-0 z-50 grid place-content-center h-screen bg-black/50 p-4 hidden"
                         id="clearCartModal"
                         role="dialog"
                         aria-modal="true"
                         aria-labelledby="modalTitle">
                        <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-lg">
                            <h2 id="modalTitle" class="text-xl font-bold text-gray-900 sm:text-2xl">Clear Cart</h2>

                            <div class="mt-4">
                                <p class="text-pretty text-gray-700">
                                    Are you sure you want to clear your cart? This action cannot be undone.
                                </p>
                            </div>

                            <footer class="mt-6 flex justify-end gap-2">
                                <button type="button"
                                        class="rounded bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-200"
                                        onclick="closeClearCartModal()">
                                    Cancel
                                </button>

                                <button type="button"
                                        class="rounded bg-red-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-red-700"
                                        onclick="submitClearCartForm()">
                                    Clear Cart
                                </button>
                            </footer>
                        </div>
                    </div>

                    <script>
                        function openClearCartModal() {
                            document.getElementById('clearCartModal').classList.remove('hidden');
                        }

                        function closeClearCartModal() {
                            document.getElementById('clearCartModal').classList.add('hidden');
                        }

                        function submitClearCartForm() {
                            document.getElementById('clearCartForm').submit();
                        }

                        // Close modal when clicking outside
                        document.getElementById('clearCartModal').addEventListener('click', function(e) {
                            if (e.target === this) {
                                closeClearCartModal();
                            }
                        });

                        // Close modal with Escape key
                        document.addEventListener('keydown', function(e) {
                            if (e.key === 'Escape') {
                                closeClearCartModal();
                            }
                        });
                    </script>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-20">
                        <h3 class="font-bold text-xl mb-6">Order Summary</h3>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                                <span>₱{{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span>Calculated at checkout</span>
                            </div>
                            <div class="border-t pt-3 flex justify-between font-bold text-xl">
                                <span>Total</span>
                                <span class="text-secondary">₱{{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout') }}" class="block w-full bg-green-500 hover:bg-green-400 text-white font-bold py-4 px-6 rounded-lg text-center transition">
                            Proceed to Checkout
                        </a>

                        <a href="{{ route('products.index') }}" class="block w-full text-center mt-4 text-gray-600 hover:text-secondary font-semibold">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layout>
