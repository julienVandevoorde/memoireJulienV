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
                <!-- Affichage de la photo de profil sans possibilité de la changer -->
                <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/defaultProfile.jpg') }}" id="output" width="165" />
            </div>

            <!-- Navigation de Profil -->
            <div class="profile-navigation">
                <!-- Lien pour envoyer un message au client via Chatify -->
                <a href="{{ url('/chatify', $user->id) }}">Send a message</a>
                <!-- Lien pour signaler l'utilisateur -->
                <a href="{{ route('report.user.form', $user->id) }}">Signaler</a>
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

            <!-- Bloc de description (Bio) -->
            <div class="profile-description">
                <h3>Bio</h3>
                <p class="field-value">{{ $user->bio ?? 'Aucune description fournie.' }}</p>
            </div>
        </div>
    </div>
</div>

@endsection
