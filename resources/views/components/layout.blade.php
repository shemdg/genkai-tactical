<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Genkai Tactical' }} | Premium Knife Shop</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    @vite('resources/css/app.css')
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <link rel="stylesheet" href="{{ asset('fonts/inter/inter.css') }}" />
</head>
<body class="text-tertiary">

    <!-- Navigation -->
    <x-header/>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-3 text-center">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white px-4 py-3 text-center">
            {{ session('error') }}
        </div>
    @endif

    <!-- Main Content -->
    <main class="bg-primary">
        {{ $slot }}
    </main>

    {{--Footer--}}
    <x-footer/>

</body>
</html>
