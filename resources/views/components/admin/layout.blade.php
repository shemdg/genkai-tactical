<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }} | Genkai Tactical</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex">
    <!-- Sidebar -->

    <div class="flex h-screen w-72 flex-col justify-between border-e border-gray-100 bg-white">
        <div class="px-4 py-6">
    <span class="grid h-10 w-32 place-content-center rounded-lg text-xs text-gray-600 ml-1">
      <img src="{{ asset('logo-secondary.svg') }}" />
    </span>

            <ul class="mt-6 space-y-1">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500
           {{ request()->routeIs('admin.dashboard') ? 'bg-secondary text-white hover:bg-gray-0' : 'hover:bg-gray-100 hover:text-gray-700' }}">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.products.index') }}"
                       class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500
           {{ request()->routeIs('admin.products.*') ? 'bg-secondary text-white' : 'hover:bg-gray-100 hover:text-gray-700' }}">
                        Products
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.orders.index') }}"
                       class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500
           {{ request()->routeIs('admin.orders.*') ? 'bg-secondary text-white' : 'hover:bg-gray-100 hover:text-gray-700' }}">
                        Orders
                    </a>
                </li>

                <li>
                    <a href="{{ route('home') }}"
                       class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500
           {{ request()->routeIs('home') ? 'bg-secondary text-white' : 'hover:bg-gray-100 hover:text-gray-700' }}">
                        View Site
                    </a>
                </li>

                <li>
                    <details class="group [&_summary::-webkit-details-marker]:hidden">
                        <summary
                            class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-gray-100
                {{ request()->routeIs('admin.account.*') ? 'bg-secondary text-white' : 'hover:text-gray-700' }}">
                            <span class="text-sm font-medium"> Account </span>

                            <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </span>
                        </summary>

                        <ul class="mt-2 space-y-1 px-4">
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="flex items-center text-gray-500 hover:bg-gray-100 w-full rounded-lg px-4 py-2 [text-align:_inherit] text-sm font-medium">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </ul>
                    </details>
                </li>
            </ul>

        </div>

        <div class="sticky inset-x-0 bottom-0 border-t border-gray-100">
            <a href="#" class="flex items-center gap-2 bg-white p-4 hover:bg-gray-50">
                <img alt="" src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?auto=format&amp;fit=crop&amp;q=80&amp;w=1160" class="size-10 rounded-full object-cover">

                <div>
                    <p class="text-xs">
                        <strong class="block font-medium">{{ auth()->user()->name ?? 'Admin'  }}</strong>

                        <span> {{ auth()->user()->email ?? 'admin@email.com'  }} </span>
                    </p>
                </div>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-1">
        <!-- Top Bar -->
        <header class="bg-white shadow">
            <div class="px-8 py-4">
                <h1 class="text-2xl font-bold text-gray-800">{{ $title ?? 'Admin Panel' }}</h1>
            </div>
        </header>

        <!-- Flash Messages -->
        @if(session('success'))
{{--            <div class="mx-8 mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">--}}
{{--                {{ session('success') }}--}}
{{--            </div>--}}

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

        @if(session('error'))
            <div class="mx-8 mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- Content -->
        <div class="p-8">
            {{ $slot }}
        </div>
    </main>
</div>
</body>
</html>
