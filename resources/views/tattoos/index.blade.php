@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/tattoos.css') }}">

<div class="tattoos-container">
    <h1>Découvrir des Tatouages</h1>

    <div class="search-bar">
        <form action="{{ route('tattoos.index') }}" method="GET">
            <input type="text" name="search" placeholder="Rechercher par mots-clés..." value="{{ request('search') }}">
            <button type="submit">Rechercher</button>
        </form>

        <!-- Si l'utilisateur est connecté, il peut voir ses likes, sinon on le redirige vers login -->
        @if(auth()->check())
            @if(request('liked') === 'true')
                <!-- Bouton pour afficher tous les tatouages quand l'utilisateur est sur la page "Mes likes" -->
                <a href="{{ route('tattoos.index') }}" class="btn-likes">Tous les tatouages</a>
            @else
                <!-- Bouton pour afficher les likes quand l'utilisateur est sur la page des tatouages -->
                <a href="{{ route('tattoos.index', ['liked' => 'true']) }}" class="btn-likes">Mes likes</a>
            @endif
        @else
            <!-- Redirection vers login si non connecté -->
            <a href="{{ route('login') }}" class="btn-likes">Mes likes</a>
        @endif
    </div>

    <div class="tattoo-feed">
        @foreach ($tattooImages as $tattoo)
            <div class="tattoo-item">
                <img src="{{ asset('storage/' . $tattoo->image_path) }}" alt="Tattoo by {{ $tattoo->user->name }}">
                <div class="tattoo-info">
                    <p><strong>{{ $tattoo->title }}</strong></p>
                    <p><a href="{{ route('profile.showProfile', $tattoo->user->login) }}">&#64;{{ $tattoo->user->login }}</a></p>

                    <!-- Bouton de like/unlike -->
                    <label class="like">
                        <input type="checkbox" class="like-checkbox" data-tattoo-id="{{ $tattoo->id }}" data-authenticated="{{ auth()->check() ? 'true' : 'false' }}" {{ $tattoo->isLikedBy(auth()->user()) ? 'checked' : '' }}>
                        <div class="checkmark">
                            <svg viewBox="0 0 256 256">
                                <rect fill="none" height="256" width="256"></rect>
                                <path d="M224.6,51.9a59.5,59.5,0,0,0-43-19.9,60.5,60.5,0,0,0-44,17.6L128,59.1l-7.5-7.4C97.2,28.3,59.2,26.3,35.9,47.4a59.9,59.9,0,0,0-2.3,87l83.1,83.1a15.9,15.9,0,0,0,22.6,0l81-81C243.7,113.2,245.6,75.2,224.6,51.9Z" stroke-width="20px" stroke="#FFF" fill="none"></path>
                            </svg>
                        </div>
                    </label>

                    <!-- Bouton de signalement -->
                    <a href="{{ route('tattoo.report', $tattoo->id) }}" class="report-icon">Signaler</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.querySelectorAll('.like-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const isAuthenticated = this.dataset.authenticated === 'true';
            if (!isAuthenticated) {
                window.location.href = `{{ route('login') }}`;
                return;
            }

            const tattooId = this.dataset.tattooId;
            const method = this.checked ? 'POST' : 'DELETE';
            const url = this.checked ? `/tattoos/${tattooId}/like` : `/tattoos/${tattooId}/unlike`;

            fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Vous pouvez ajouter une logique pour mettre à jour l'interface utilisateur ici si besoin
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>

@endsection
