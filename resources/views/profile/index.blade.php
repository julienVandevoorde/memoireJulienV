@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<div class="container profile-container">
    <!-- Photo de Profil -->
    <div class="profile-photo">
    <div class="profile-pic">
    <label class="-label" for="file">
        <span class="glyphicon glyphicon-camera"></span>
        <span>Changer l'image</span>
    </label>
    <form id="upload-photo-form" action="{{ route('profile.uploadPhoto') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input id="file" type="file" name="profile_photo" onchange="submitForm()" />
    </form>
    <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/default-avatar.png') }}" id="output" width="200" />
</div>

    </div>

    <!-- Informations Personnelles -->
    <div class="profile-info">
        <h2>Informations du Tatoueur</h2>
        <div class="info-item">
            <strong>Login :</strong> {{ $user->login }}
        </div>
        <div class="info-item">
            <strong>Nom Complet :</strong> {{ $user->name }}
        </div>
        <div class="info-item">
            <strong>Instagram :</strong> <a href="{{ $user->instagram_link }}" target="_blank">{{ $user->instagram_link }}</a>
        </div>
        <div class="info-item">
            <strong>Style :</strong> {{ implode(', ', $user->styles->pluck('name')->toArray()) }}
        </div>
        <div class="info-item">
            <strong>Commune :</strong> {{ $user->location }}
        </div>
    </div>

    <!-- Description -->
    <div class="profile-description">
        <h2>Description</h2>
        <p>{{ $user->bio }}</p>
    </div>

    <!-- Likes -->
    <div class="profile-likes">
        <h2>Mes Likes</h2>
        <!-- Ici tu pourras afficher la liste des posts ou tattoos likés par l'utilisateur -->
        <!-- Par exemple : -->
        <ul>
            @foreach($user->likes as $like)
                <li>{{ $like->likeable->title ?? 'Tatouage' }}</li>
            @endforeach
        </ul>
    </div>

    <!-- Navigation pour Messagerie et Rendez-vous -->
    <div class="profile-navigation">
        <a href="#" class="btn-nav">Messages</a>
        <a href="#" class="btn-nav">Rendez-vous</a>
        <a href="{{ route('profile.edit') }}" class="btn-nav">Éditer le profil</a>
    </div>

    <!-- Portfolio -->
    <div class="profile-portfolio">
        <h2>Mon Portfolio</h2>
        <!-- Ici tu pourras afficher le portfolio de l'utilisateur -->
        <!-- Par exemple : -->
        <div class="portfolio-gallery">
            @foreach($user->portfolios as $portfolio)
                <div class="portfolio-item">
                    <img src="{{ asset('storage/' . $portfolio->image_path) }}" alt="{{ $portfolio->title }}" />
                    <p>{{ $portfolio->title }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- JavaScript pour charger l'image de profil en direct -->
<script src="{{ asset('js/profile.js') }}"></script>

@endsection
