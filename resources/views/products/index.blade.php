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
                        <x-products-card :products="$products" />
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
