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
        <!-- Navbar personnalisée -->
        <nav class="navbar">
            <a href="{{ route('home.index') }}" class="navbar-brand">Tattoo Platform</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('tattoos.index') }}" class="nav-link">Tattoos</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('artists.index') }}" class="nav-link">Artists</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('shop.index') }}" class="nav-link">Shop</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('about.index') }}" class="nav-link">About Us</a>
                </li>
                @if(Auth::check())
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a href="{{ route('dashboard.index') }}" class="nav-link">Dashboard</a>
                        </li>
                    @endif
                @endif
            </ul>
            <ul class="navbar-auth">
                @if(Auth::check())
                    <li class="nav-item">
                        <a href="{{ route('profile.edit') }}" class="nav-link">{{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Log in</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </li>
                @endif
            </ul>
        </nav>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
