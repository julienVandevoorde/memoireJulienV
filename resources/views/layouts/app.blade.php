<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Ajouter ton propre fichier CSS -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}"> <!-- Ton CSS Laravel personnalisé, si nécessaire -->
</head>
<body>
    <!-- Utiliser le design du header de ton template -->
    @include('layouts.navbar') <!-- Inclure la barre de navigation -->

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Script du template pour rendre le header sticky au scroll -->
    <script>
        window.addEventListener('scroll', function() {
            var header = document.querySelector('header');
            var scrollTop = window.scrollY;

            if (scrollTop > 50) {
                header.classList.add('sticky');
            } else {
                header.classList.remove('sticky');
            }
        });
    </script>
</body>
</html>
