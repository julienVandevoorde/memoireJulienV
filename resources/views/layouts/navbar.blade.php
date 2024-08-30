<!-- resources/views/layouts/navbar.blade.php -->
<header>
    <a href="{{ route('home.index') }}" class="logo">NeedleInkNow</a>
    <ul>
        <li><a href="{{ route('tattoos.index') }}">Tattoos</a></li>
        <li><a href="{{ route('artists.index') }}">Artists</a></li>
        <li><a href="{{ route('shop.index') }}">Shop</a></li>
        <li><a href="{{ route('about.index') }}">About Us</a></li>
        @if(Auth::check())
            @if(Auth::user()->role === 'admin')
                <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            @endif
        @endif
    </ul>
    <ul class="navbar-auth">
        @if(Auth::check())
            <li>
                <a href="{{ route('profile.edit') }}">{{ Auth::user()->name }}</a>
            </li>
            <li>
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Log Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}">Log in</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @endif
    </ul>
</header>
