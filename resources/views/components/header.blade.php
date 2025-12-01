<header class="bg-secondary">
    <div class="mx-auto max-w-7xl w-full px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex-1 md:flex md:items-center md:gap-12">
                <a href="/">
                    <img src="{{ asset('logo.svg') }}" alt="logo" class="h-5" />
                </a>
            </div>

            <div class="md:flex md:items-center md:gap-12">
                <nav aria-label="Global" class="hidden md:block">
                    <ul class="flex items-center gap-6 text-sm">
                        <li>
                            <a class="text-primary transition hover:text-tertiary" href="{{ route('home') }}"> Home </a>
                        </li>

                        <li>
                            <a class="text-primary transition hover:text-tertiary" href="{{ route('products.index') }}"> Products </a>
                        </li>

                        <li>
                            <a class="text-primary transition hover:text-tertiary flex items-center space-x-1" href="{{ route('cart.index') }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>Cart</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</header>

<div class="border-gray-200 bg-tertiary py-2 text-primary">

    @auth('admin')
        <!-- Logged in view -->
        <div class="flex justify-between mx-auto max-w-7xl w-full px-4 sm:px-6 lg:px-8">
            <p class="font-medium text-primary">
                Welcome, {{ Auth::guard('admin')->user()->name }}
            </p>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button class="font-medium hover:text-secondary transition">
                    Logout
                </button>
            </form>
        </div>

    @else
        <!-- Guest -->
        <p class="text-center font-medium">
            Welcome, Guest!
        </p>
    @endauth

</div>
