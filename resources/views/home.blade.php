<x-layout>
    <x-slot:title>Home</x-slot:title>

    <!-- Hero Section -->
    <section class="lg:grid lg:h-screen lg:place-content-center">
        <div class="mx-auto w-screen max-w-7xl px-4 py-20 sm:px-6 sm:py-24 lg:px-8 lg:py-32">
            <div class="max-w-prose text-left">
                <h1 class="text-4xl font-bold text-tertiary sm:text-5xl">
                    Premium
                    <strong class="text-secondary"> Tactical </strong>
                    Knives
                </h1>

                <p class="mt-4 text-base text-pretty text-tertiary sm:text-lg/relaxed">
                    Discover our collection of professional-grade knives crafted for precision, durability, and excellence.
                </p>

                <div class="mt-4 flex gap-4 sm:mt-6">
                    <a class="inline-block rounded border border-secondary bg-secondary px-5 py-3 font-medium text-primary shadow-sm transition-colors hover:bg-secondary-hover" href="{{ route('products.index') }}">
                        Shop Now
                    </a>

                    <a class="inline-block rounded border border-gray-200 px-5 py-3 font-medium text-tertiary shadow-sm transition-colors hover:bg-gray-50 hover:text-gray-900" href="#featured">
                        View Featured
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="py-16 bg-primary">
        <div class="container mx-auto px-4">
            <div class="flex items-center gap-4 mb-12">
                <div class="h-px flex-1 bg-gray-300"></div>
                <h2 class="text-3xl font-bold text-center whitespace-nowrap text-tertiary">Shop by Category</h2>
                <div class="h-px flex-1 bg-gray-300"></div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category->slug) }}" class="group block">
                        <img src="https://images.unsplash.com/photo-1643502858916-be910fe145a3?q=80&w=627&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="aspect-square w-full rounded-sm object-cover">

                        <div class="mt-3">
                            <h3 class="font-medium text-tertiary group-hover:underline group-hover:underline-offset-4">
                                {{ $category->name }}
                            </h3>

                            <p class="mt-1 text-sm text-tertiary">{{ $category->products_count }} products</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section id="featured" class="py-16 bg-primary">
        <div class="container mx-auto px-4">
            <div class="flex items-center gap-4 mb-12">
                <div class="h-px flex-1 bg-gray-300"></div>
                <h2 class="text-3xl font-bold text-center whitespace-nowrap text-tertiary">Featured Products</h2>
                <div class="h-px flex-1 bg-gray-300"></div>
            </div>
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
        </div>
    </section>
</x-layout>
