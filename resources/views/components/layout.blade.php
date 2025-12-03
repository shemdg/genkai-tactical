<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Genkai Tactical' }} | Premium Knife Shop</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <link rel="stylesheet" href="{{ asset('fonts/inter/inter.css') }}" />
</head>
<body class="text-tertiary">

    <!-- Navigation -->
    <x-header/>

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
