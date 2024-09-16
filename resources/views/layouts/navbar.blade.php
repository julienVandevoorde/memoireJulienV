<!-- resources/views/layouts/navbar.blade.php -->
<header>
    <a href="{{ route('home.index') }}" class="logo">
        <img src="{{ asset('images/logoNeedleInkNow.png') }}" alt="NeedleInkNow Logo" class="logo-image">
    </a>
    <ul>
        <li><a href="{{ route('tattoos.index') }}">TATTOOS</a></li>
        <li><a href="{{ route('artists.index') }}">ARTISTS</a></li>
        <li><a href="{{ route('shop.index') }}">SHOP</a></li>
        <li><a href="{{ route('about.index') }}">ABOUT US</a></li>
        @if(Auth::check() && Auth::user()->role === 'admin')
            <li><a href="{{ route('admin.dashboard') }}">DASHBOARD</a></li>
        @endif
    </ul>
    <ul class="navbar-auth">
        <li class="relative cart-icon">
            <a href="{{ route('cart.index') }}" class="active">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" />
                    <path d="M9 11v-5a3 3 0 0 1 6 0v5" />
                </svg>
                <!-- Afficher le nombre total d'articles dans le panier -->
                <small id="cart-count" class="bg-red-500 text-xs text-white w-4 h-4 absolute -top-2 -right-2 rounded-full">
                    {{ array_sum(session('cart', [])) }}
                </small>
            </a>
        </li>
        @if(Auth::check())
            <!-- Afficher l'icône du panier -->
            <li>
                <a href="{{ route('profile.index') }}">PROFILE</a>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOG OUT</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}">LOG IN</a></li>
            <li><a href="{{ route('register') }}">REGISTER</a></li>
        @endif
    </ul>
</header>
