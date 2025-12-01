<x-layout>
    <x-slot:title>{{ isset($currentCategory) ? $currentCategory->name : 'All Products' }}</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            @if(isset($currentCategory))
                <h1 class="text-4xl font-bold mb-2">{{ $currentCategory->name }}</h1>
                <p class="text-gray-600">{{ $currentCategory->description }}</p>
            @else
                <h1 class="text-4xl font-bold mb-2">All Products</h1>
                <p class="text-gray-600">Browse our complete collection</p>
            @endif
        </div>

        <div class="grid lg:grid-cols-4 gap-8">
            <!-- Sidebar - Categories -->
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-20">
                    <h3 class="font-bold text-lg mb-4">Categories</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('products.index') }}"
                               class="block py-2 px-3 rounded {{ !isset($currentCategory) ? 'bg-secondary text-white' : 'hover:bg-gray-100' }}">
                                All Products
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('categories.show', $category->slug) }}"
                                   class="block py-2 px-3 rounded {{ isset($currentCategory) && $currentCategory->id === $category->id ? 'bg-secondary text-white' : 'hover:bg-gray-100' }}">
                                    {{ $category->name }}
                                    <span class="text-sm text-gray-500">({{ $category->products_count }})</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                <div class="mb-4 text-gray-600">
                    Showing {{ $products->count() }} of {{ $products->total() }} products
                </div>

                @if($products->isEmpty())
                    <div class="text-center py-12">
                        <p class="text-xl text-gray-600">No products found in this category.</p>
                    </div>
                @else
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    <div class="h-48">
                                        <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1584435191093-2d9ed132c88d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="knife" />
                                    </div>
                                    <div class="p-4">
                                        <div class="text-xs text-secondary font-semibold mb-1">{{ $product->category->name }}</div>
                                        <h3 class="font-bold text-lg mb-2 hover:text-secondary">{{ $product->name }}</h3>
                                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-xl font-bold text-secondary">₱{{ number_format($product->price, 2) }}</span>
                                            @if($product->stock > 0)
                                                <span class="text-xs text-green-600 font-semibold">In Stock</span>
                                            @else
                                                <span class="text-xs text-red-600 font-semibold">Out of Stock</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
