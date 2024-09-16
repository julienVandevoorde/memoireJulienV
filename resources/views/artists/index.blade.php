@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/artists.css') }}">

<div class="artists-container">
    <h1>Find your tattoo artist</h1>

    <!-- Section de filtres -->
    <div class="filter-section">
        <form action="{{ route('artists.index') }}" method="GET" class="filter-form">
            <!-- Ligne avec Nom ou Login et Localisation -->
            <div class="filter-row">
                <div class="filter-group">
                    <label for="search">Name or Login</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search by name or login">
                </div>

                <div class="filter-group">
                    <label for="location">Locations</label>
                    <select name="location" id="location">
                        <option value="">All locations</option>
                        @foreach ($communes as $commune)
                            <option value="{{ $commune }}" {{ request('location') == $commune ? 'selected' : '' }}>{{ $commune }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Filtre par style -->
            <div class="filter-group">
                <label for="styles">Tattoo styles</label>
                <select name="styles[]" id="styles" multiple>
                    @foreach ($styles as $style)
                        <option value="{{ $style->id }}" {{ in_array($style->id, request('styles', [])) ? 'selected' : '' }}>{{ $style->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Ligne avec Années d'expérience et Genre -->
            <div class="filter-row">
                <div class="filter-group">
                    <label for="experience_years">Years of experience</label>
                    <select name="experience_years" id="experience_years">
                        <option value="">Toutes les années</option>
                        <option value="Less than 5 years" {{ request('experience_years') == 'Less than 5 years' ? 'selected' : '' }}>Less than 5 years</option>
                        <option value="5 to 10 years" {{ request('experience_years') == '5 to 10 years' ? 'selected' : '' }}>5 to 10 years</option>
                        <option value="More than 10 years" {{ request('experience_years') == 'More than 10 years' ? 'selected' : '' }}>More than 10 years</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="gender">gender</label>
                    <select name="gender" id="gender">
                        <option value="">All genders</option>
                        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="non-binary" {{ request('gender') == 'non-binary' ? 'selected' : '' }}>Non-Binary</option>
                        <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
            </div>

            <!-- Bouton de soumission -->
            <div class="filter-group">
                <button type="submit" class="btn-filter">Search</button>
            </div>
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
                <p>Genre: {{ ucfirst($artist->gender) }}</p>
                <a href="{{ route('profile.showProfile', $artist->login) }}" class="btn-view-profile">Voir le profil</a>
            </div>
        @empty
            <p>Aucun artiste trouvé pour les critères de recherche sélectionnés.</p>
        @endforelse
    </div>
</div>

@endsection
