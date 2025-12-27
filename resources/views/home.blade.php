<x-layout>
    <x-slot:title>Home</x-slot:title>

    <!-- Hero Section with Alert Overlay -->
    <section class="lg:grid lg:h-screen lg:place-content-center relative">

        <!-- Flash Messages -->
        @if(session('success'))
            <!-- Alert positioned absolutely within hero section -->
            <div class="absolute top-4 right-0 z-10 flash-message">
                <div class="max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-end">
                        <div class="w-full lg:w-96">
                            <div role="alert" class="rounded-md border border-green-500 bg-green-50 p-4 shadow-lg">
                                <div class="flex items-start gap-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-mt-0.5 size-6 text-green-700">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>

                                    <div class="flex-1">
                                        <strong class="block leading-tight font-medium text-green-800">Success</strong>
                                        <p class="mt-0.5 text-sm text-green-700">
                                            {{ session('success') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Hero content remains unchanged -->
        <div class="mx-auto w-screen max-w-7xl px-4 py-20 sm:px-6 sm:py-24 lg:px-8 lg:py-32 flex items-center text-center justify-between">
            <div>
                <img
                    src="https://plus.unsplash.com/premium_photo-1679826780090-4c79fc382d9e?q=80&w=627&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    class="w-auto max-h-200 border-brand-secondary rounded-lg shadow-lg object-cover"
                    alt="Premium Tactical Knife"
                />
            </div>
            <div class="max-w-prose text-left">
                <h1 class="text-4xl font-bold text-tertiary sm:text-5xl">
                    Premium
                    <strong class="text-brand-secondary"> Tactical </strong>
                    Knives
                </h1>

                <p class="mt-4 text-base text-pretty text-tertiary sm:text-lg/relaxed">
                    Discover our collection of professional-grade knives crafted for precision, durability, and excellence.
                </p>

                <div class="mt-4 flex gap-4 sm:mt-6">
                    <a class="inline-block rounded border border-brand-secondary bg-brand-secondary px-5 py-3 font-medium text-brand-primary shadow-sm transition-colors hover:bg-brand-secondary-hover" href="{{ route('products.index') }}">
                        Shop Now
                    </a>

                    <a class="inline-block rounded border border-gray-200 px-5 py-3 font-medium text-tertiary shadow-sm transition-colors hover:bg-gray-50 hover:text-gray-900" href="#featured">
                        View Featured
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Rest of your content remains the same -->
    <!-- Categories -->
    <section class="py-16 bg-brand-primary">
        <div class="container mx-auto px-4">
            <div class="flex items-center gap-4 mb-12">
                <div class="h-px flex-1 bg-gray-300"></div>
                <h2 class="text-3xl font-bold text-center whitespace-nowrap text-tertiary">Shop by Category</h2>
                <div class="h-px flex-1 bg-gray-300"></div>
            </div>
            <x-product-categories-card :categories="$categories" />
        </div>
    </section>

    <!-- Featured Products -->
    <section id="featured" class="py-16 bg-brand-primary">
        <div class="container mx-auto px-4">
            <div class="flex items-center gap-4 mb-12">
                <div class="h-px flex-1 bg-gray-300"></div>
                <h2 class="text-3xl font-bold text-center whitespace-nowrap text-tertiary">Featured Products</h2>
                <div class="h-px flex-1 bg-gray-300"></div>
            </div>
            <x-featured-products-card :featuredProducts="$featuredProducts" />
        </div>
    </section>
</x-layout>
