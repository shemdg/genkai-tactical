<x-layout>
    <x-slot:title>{{ $product->name }}</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="mb-8 text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-brand-secondary">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('products.index') }}" class="hover:text-brand-secondary">Products</a>
            <span class="mx-2">/</span>
            <a href="{{ route('categories.show', $product->category->slug) }}" class="hover:text-brand-secondary">{{ $product->category->name }}</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">{{ $product->name }}</span>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12 mb-16">
            <!-- Product Image -->
            <div>
                <div class="bg-gray-200 rounded-lg h-96 lg:h-full flex items-center justify-center sticky top-20">
                    <img class="w-full h-full object-cover rounded-lg" src="https://images.unsplash.com/photo-1732942553411-ce0d40238aae?q=80&w=1169&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="knife" />
                </div>
            </div>

            <!-- Product Info -->
            <div>
                <div class="text-sm text-brand-secondary font-semibold mb-2">{{ $product->category->name }}</div>
                <h1 class="text-4xl font-bold mb-4">{{ $product->name }}</h1>

                <!-- Price -->
                <div class="mb-6">
                    <span class="text-4xl font-bold text-brand-secondary">₱{{ number_format($product->price, 2) }}</span>
                </div>

                <!-- Stock Status -->
                <div class="mb-6">
                    @if($product->stock > 0)
                        <span class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold">
                            ✓ In Stock ({{ $product->stock }} available)
                        </span>
                    @else
                        <span class="inline-block bg-red-100 text-red-800 px-4 py-2 rounded-full text-sm font-semibold">
                            ✗ Out of Stock
                        </span>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h3 class="font-bold text-lg mb-3">Description</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                </div>

                <!-- Add to Cart Form -->
                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block font-semibold mb-2">Quantity</label>
                            <input type="number"
                                   name="quantity"
                                   value="1"
                                   min="1"
                                   max="{{ $product->stock }}"
                                   class="w-24 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        </div>
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-400 text-white font-bold py-4 px-8 rounded-lg transition text-lg">
                            Add to Cart
                        </button>
                    </form>
                @else
                    <button disabled class="w-full bg-gray-400 text-white font-bold py-4 px-8 rounded-lg cursor-not-allowed text-lg">
                        Out of Stock
                    </button>
                @endif
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->isNotEmpty())
            <section class="border-t pt-16">
                <h2 class="text-3xl font-bold mb-8">Related Products</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                            <a href="{{ route('products.show', $related->slug) }}">
                                <div class="h-48">
                                    <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1584435191128-3124f85686b5?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="knife" />
                                </div>

                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-2 hover:text-brand-secondary">{{ $related->name }}</h3>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xl font-bold text-brand-secondary">₱{{ number_format($related->price, 2) }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-layout>
