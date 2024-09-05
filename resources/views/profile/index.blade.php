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
                <form id="upload-photo-form" action="{{ route('profile.uploadPhoto') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input id="file" type="file" name="profile_photo" onchange="submitForm()" />
                    <label class="-label" for="file">
                        <span class="glyphicon glyphicon-camera"></span>
                        <span>Changer l'image</span>
                    </label>
                    <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/default-avatar.png') }}" id="output" width="165" />
                </form>
            </div>

            <!-- Navigation de Profil -->
            <div class="profile-navigation">
                <a href="#">Messages</a>
                <a href="#">Rendez-vous</a>
                <a href="{{ route('profile.edit') }}">Éditer le profil</a>
            </div>
        </div>

        <!-- Colonne Droite : Informations du Profil -->
        <div class="profile-info">
            <div><h2>@ {{ $user->login }}</h2></div>
            <div><h3>{{ $user->name }}</h3></div>
            <div>
                <a href="{{ $user->instagram_link }}" class="insta" target="_blank">
                    <svg viewBox="0 0 16 16" class="bi bi-instagram" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg">...</svg>
                    <span>Instagram</span>
                </a>
            </div>
            <div><h3>Style :</h3>{{ $user->styles->pluck('name')->join(', ') ?? 'Non spécifié' }}</div>
            <div><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">...</svg> {{ $user->location ?? 'Non spécifiée' }}</div>
            <!-- Bloc de description -->
            <div class="profile-description">
                <h3>Bio</h3>
                <p>{{ $user->bio ?? 'Aucune description fournie.' }}</p>
            </div>
        </div>
    </div>

    <!-- Section de Portfolio -->
    <div class="portfolio-section">
        <h3>Mon Portfolio</h3>
        <!-- Formulaire pour ajouter une nouvelle image -->
        <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" required>
            <button type="submit" class="btn-upload">Ajouter au Portfolio</button>
        </form>

        <!-- Afficher les images du portfolio -->
        <div class="portfolio-gallery">
            @foreach($user->portfolios as $portfolio)
                <div class="portfolio-item">
                    <img src="{{ asset('storage/' . $portfolio->image_path) }}" alt="{{ $portfolio->title }}">
                    <p>{{ $portfolio->title }}</p>
                    <form action="{{ route('portfolio.delete', $portfolio->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Supprimer</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="{{ asset('js/profile.js') }}"></script>
@endsection
