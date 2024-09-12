@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<!-- Conteneur principal pour le cadre -->
<div class="profile-wrapper">
    <div class="profile-container">
        <!-- Colonne Gauche : Photo de Profil et Navigation -->
        <div class="profile-left">
            <!-- Photo de Profil -->
            <div class="profile-pic">
                <!-- Image de profil sans bouton de modification -->
                <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/defaultProfile.jpg') }}" id="output" width="165" />
            </div>

            <!-- Navigation de Profil -->
            <div class="profile-navigation">
                <a href="{{ url('/chatify/' . $user->id) }}">Send a message</a>
            </div>
        </div>

        <!-- Colonne Droite : Informations du Profil -->
        <div class="profile-info">
            <div>
                <h1>STATUS : {{ $user->role }}</h1>
            </div>
            <div>
                <h3>Login : @<span class="field-value">{{ $user->login }}</span></h3>
            </div>
            <div>
                <h3>Name : <span class="field-value">{{ $user->name }}</span></h3>
            </div>
            <div>
                <h3>Instagram Link : <span class="field-value">{{ $user->instagram_link }}</span></h3>
            </div>
            <div>
                <h3>Location : <span class="field-value">{{ $user->location }}</span></h3>
            </div>

            <!-- Liste des styles de tatouage -->
            <div>
                <h3>Styles de Tatouage : <span class="field-value">{{ implode(', ', $user->styles->pluck('name')->toArray()) }}</span></h3>
            </div>
            
            <!-- Bloc de description (Bio) -->
            <div class="profile-description">
                <h3>Bio</h3>
                <p class="field-value">{{ $user->bio ?? 'Aucune description fournie.' }}</p>
            </div>
        </div>
    </div>

    <!-- Section de Portfolio -->
    <div class="portfolio-section">
        <h3>@<span class="field-value">{{ $user->login}}'s portfolio</h3>

        <!-- Afficher les images du portfolio sans options de suppression -->
        <div class="portfolio-gallery">
            @foreach($user->portfolios as $portfolio)
                <div class="portfolio-item">
                    <img src="{{ asset('storage/' . $portfolio->image_path) }}" alt="{{ $portfolio->title }}">
                    <p>{{ $portfolio->title }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
