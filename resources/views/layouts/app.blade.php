<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Ajouter ton propre fichier CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="min-h-screen bg-gray-100">
        <!-- Inclure la navbar depuis le fichier layouts -->
        @include('layouts.navbar')

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
