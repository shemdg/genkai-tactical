<x-layout>
    <x-slot:title>Home</x-slot:title>

    <!-- Hero Section with Alert Overlay -->
    <section class="lg:grid lg:h-screen lg:place-content-center relative">

        <!-- Flash Messages -->
        @if(session('success'))
            <!-- Alert positioned absolutely within hero section -->
            <div class="absolute top-4 left-4 right-4 sm:left-auto sm:right-4 z-10 flash-message">
                <div class="max-w-7xl sm:px-6 lg:px-8">
                    <div class="flex justify-end">
                        <div class="w-full sm:w-96">
                            <div role="alert" class="rounded-md border border-green-500 bg-green-50 p-4 shadow-lg">
                                <div class="flex items-start gap-3 sm:gap-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-mt-0.5 size-5 sm:size-6 text-green-700 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>

                                    <div class="flex-1 min-w-0">
                                        <strong class="block leading-tight font-medium text-green-800 text-sm sm:text-base">Success</strong>
                                        <p class="mt-0.5 text-xs sm:text-sm text-green-700">
                                            {{ session('success') }}
                                        </p>
                                    </div>

                                    <!-- Close button for mobile -->
                                    <button onclick="this.closest('.flash-message').remove()" class="text-green-700 hover:text-green-900 sm:hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Hero content -->
        <div class="mx-auto w-full max-w-7xl px-4 py-12 sm:px-6 sm:py-16 lg:px-8 lg:py-32">
            <div class="flex flex-col lg:flex-row items-center lg:items-center justify-between gap-8 lg:gap-12">
                <!-- Image -->
                <div class="w-full lg:w-1/2 order-1 lg:order-1">
                    <img
                        src="https://plus.unsplash.com/premium_photo-1679826780090-4c79fc382d9e?q=80&w=627&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="w-full h-64 sm:h-80 lg:w-auto lg:h-auto lg:max-h-[50rem] border-brand-secondary rounded-lg shadow-lg object-cover"
                        alt="Premium Tactical Knife"
                    />
                </div>

                <!-- Text Content -->
                <div class="w-full lg:w-1/2 order-2 lg:order-2 text-center lg:text-left">
                    <h1 class="text-3xl font-bold text-tertiary sm:text-4xl lg:text-5xl">
                        Premium
                        <strong class="text-brand-secondary"> Tactical </strong>
                        Knives
                    </h1>

                    <p class="mt-4 text-sm text-tertiary sm:text-base lg:text-lg/relaxed">
                        Discover our collection of professional-grade knives crafted for precision, durability, and excellence.
                    </p>

                    <div class="mt-6 flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center lg:justify-start">
                        <a class="inline-block rounded border border-green-500 bg-green-500 px-6 py-3 text-sm sm:text-base font-medium text-brand-primary shadow-sm transition-colors hover:bg-green-400" href="{{ route('products.index') }}">
                            Shop Now
                        </a>

                        <a class="inline-block rounded border border-gray-200 px-6 py-3 text-sm sm:text-base font-medium text-tertiary shadow-sm transition-colors hover:bg-gray-50 hover:text-gray-900" href="#featured">
                            View Featured
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Flash message slide-in animation */
        .flash-message {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>

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
