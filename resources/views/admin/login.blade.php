<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Genkai Tactical</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="{{ asset('fonts/inter/inter.css') }}" />
</head>
<body class="bg-brand-secondary text-tertiary">
<div class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="bg-brand-primary p-8 rounded-lg shadow-2xl w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">Admin Login</h1>
            <p class="mt-2">Genkai Tactical</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-2">Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-secondary focus:border-transparent @error('email') border-red-500 @enderror">
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">Password</label>
                <input type="password"
                       name="password"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-secondary focus:border-transparent @error('password') border-red-500 @enderror">
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2 rounded">
                    <span class="text-sm">Remember me</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-brand-secondary hover:bg-brand-secondary-hover text-white font-bold py-3 rounded-lg transition">
                Login
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-brand-secondary">
                ← Back to Website
            </a>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('admin.register') }}" class="text-gray-600 hover:text-brand-secondary">
                Don't have an account? Register
            </a>
        </div>
    </div>
</div>
</body>
</html>
