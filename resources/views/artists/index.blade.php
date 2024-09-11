@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/artists.css') }}">

<div class="artists-container">
    <h1>Rechercher un Tatoueur</h1>

    <!-- Section de filtres -->
    <div class="filter-section">
        <form action="{{ route('artists.index') }}" method="GET">
            <!-- Filtre par localisation -->
            <div class="filter-group">
                <label for="location">Localisation</label>
                <select name="location" id="location">
                    <option value="">Toutes les localisations</option>
                    @foreach ($communes as $commune)
                        <option value="{{ $commune }}" {{ request('location') == $commune ? 'selected' : '' }}>{{ $commune }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filtre par style -->
            <div class="filter-group">
                <label for="styles">Styles de Tatouage</label>
                <select name="styles[]" id="styles" multiple>
                    @foreach ($styles as $style)
                        <option value="{{ $style->id }}" {{ in_array($style->id, request('styles', [])) ? 'selected' : '' }}>{{ $style->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filtre par années d'expérience -->
            <div class="filter-group">
                <label for="experience_years">Années d'expérience</label>
                <select name="experience_years" id="experience_years">
                    <option value="">Toutes les années</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ request('experience_years') == $i ? 'selected' : '' }}>{{ $i }} ans</option>
                    @endfor
                    <option value="10+" {{ request('experience_years') == '10+' ? 'selected' : '' }}>10+ ans</option>
                </select>
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="btn-filter">Rechercher</button>
        </form>
    </div>

    <!-- Section d'affichage des artistes -->
    <div class="artists-list">
        @forelse($artists as $artist)
            <div class="artist-card">
                <img src="{{ $artist->profile_photo_path ? asset('storage/' . $artist->profile_photo_path) : asset('images/defaultProfile.jpg') }}" alt="{{ $artist->name }}">
                <h3>{{ $artist->name }}</h3>
                <p>Localisation: {{ $artist->location }}</p>
                <p>Styles: {{ implode(', ', $artist->styles->pluck('name')->toArray()) }}</p>
                <p>Années d'expérience: {{ $artist->experience_years }}</p>
                <a href="{{ route('profile.index', $artist->id) }}" class="btn-view-profile">Voir le profil</a>
            </div>
        @empty
            <p>Aucun artiste trouvé pour les critères de recherche sélectionnés.</p>
        @endforelse
    </div>
</div>

@endsection
