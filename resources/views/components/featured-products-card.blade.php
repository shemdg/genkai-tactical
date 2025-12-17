<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($featuredProducts as $product)
        <div class="group relative block overflow-hidden rounded-lg ">

            <div class="h-64">
                <img class="transition duration-500 group-hover:scale-105 sm:h-72 w-full h-full object-cover" src="https://images.unsplash.com/photo-1606976467874-31e4342935f4?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="knife" />

            </div>

            <div class="relative border border-gray-100 bg-white p-6">
                <div class="flex justify-between">
                    <p class="text-tertiary">
                        ₱{{ number_format($product->price, 2) }}
                    </p>

                    <span class="rounded-full border border-secondary px-2.5 py-0.5 text-sm whitespace-nowrap text-secondary">
                                  Stock: {{ $product->stock }}
                                </span>

                </div>

                <h3 class="mt-1.5 text-lg font-medium text-tertiary">{{ $product->name }}</h3>

                <p class="mt-1.5 line-clamp-3 text-gray-700">
                    {{ $product->description }}
                </p>

                <div class="mt-4 flex gap-4 text-center items-center">
                    <a href="{{ route('categories.show', $product->category->slug) }}"
                       class="block w-full rounded-sm bg-primary px-4 py-3 text-sm font-medium text-tertiary transition">
                        {{ $product->category->name }}
                    </a>

                    <a href="{{ route('products.show', $product->slug) }}"
                       class="block w-full rounded-sm bg-secondary px-4 py-3 text-sm font-medium text-white transition hover:scale-105">
                        View Details
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
