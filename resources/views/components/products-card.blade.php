@foreach($products as $product)
    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
        <a href="{{ route('products.show', $product->slug) }}">
            <div class="h-48">
                <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1584435191093-2d9ed132c88d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="knife" />
            </div>
            <div class="p-4">
                <div class="text-xs text-brand-secondary font-semibold mb-1">{{ $product->category->name }}</div>
                <h3 class="font-bold text-lg mb-2 hover:text-brand-secondary">{{ $product->name }}</h3>
                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                <div class="flex items-center justify-between">
                    <span class="text-xl font-bold text-brand-secondary">₱{{ number_format($product->price, 2) }}</span>
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
