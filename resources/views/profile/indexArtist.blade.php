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
                        <span>Change picture</span>
                    </label>
                    <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/defaultProfile.jpg') }}" id="output" width="165" />
                </form>
            </div>

            <!-- Navigation de Profil -->
            <div class="profile-navigation">
                <a href="{{ url('/chatify') }}">My messages</a>
                <a href="{{ route('orders') }}">My orders</a>
                <a href="{{ route('profile.edit') }}">Reset password</a>
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
            <div class="editable-field" data-field="name">
                <h3>Name : <span class="field-value">{{ $user->name }}</span></h3>
                <input type="text" class="field-input" value="{{ $user->name }}" style="display: none;" />
                <button class="edit-button">Edit</button>
                <button class="save-button" style="display: none;">Save</button>
            </div>
            <div class="editable-field" data-field="instagram_link">
                <h3>Instagram Link : <span class="field-value">{{ $user->instagram_link }}</span></h3>
                <input type="text" class="field-input" value="{{ $user->instagram_link }}" style="display: none;" />
                <button class="edit-button">Edit</button>
                <button class="save-button" style="display: none;">Save</button>
            </div>
            <div class="editable-field" data-field="location">
                <h3>Location : <span class="field-value">{{ $user->location }}</span></h3>
                <!-- Liste déroulante pour sélectionner une commune -->
                <select class="field-input" style="display: none;">
                    @foreach ($communes as $commune)
                        <option value="{{ $commune }}" {{ $user->location == $commune ? 'selected' : '' }}>{{ $commune }}</option>
                    @endforeach
                </select>
                <button class="edit-button">Edit</button>
                <button class="save-button" style="display: none;">Save</button>
            </div>

            <!-- Liste des styles de tatouage -->
            <div class="editable-field" data-field="styles">
                <h3>Styles de Tatouage : <span class="field-value">{{ implode(', ', $user->styles->pluck('name')->toArray()) }}</span></h3>
                <select multiple class="field-input" style="display: none;">
                    @foreach ($styles as $style)
                        <option value="{{ $style->id }}" {{ in_array($style->id, $userStyles) ? 'selected' : '' }}>{{ $style->name }}</option>
                    @endforeach
                </select>
                <button class="edit-button">Edit</button>
                <button class="save-button" style="display: none;">Save</button>
            </div>

            <!-- Nombre d'années d'expérience -->
            <div class="editable-field" data-field="experience_years">
                <h3>Années d'expérience : <span class="field-value">{{ $user->experience_years ?? '0' }}</span></h3>
                <select class="field-input" style="display: none;">
                    <option value="Less than 5 years" {{ $user->experience_years == 'Less than 5 years' ? 'selected' : '' }}>Less than 5 years</option>
                    <option value="5 to 10 years" {{ $user->experience_years == '5 to 10 years' ? 'selected' : '' }}>5 to 10 years</option>
                    <option value="More than 10 years" {{ $user->experience_years == 'More than 10 years' ? 'selected' : '' }}>More than 10 years</option>
                </select>
                <button class="edit-button">Edit</button>
                <button class="save-button" style="display: none;">Save</button>
            </div>


            
            <!-- Bloc de description (Bio) dans le même conteneur -->
            <div class="profile-description editable-field" data-field="bio">
                <h3>Bio</h3>
                <p class="field-value">{{ $user->bio ?? 'The bio is empty.' }}</p>
                <textarea class="field-input" style="display: none;">{{ $user->bio }}</textarea>
                <button class="edit-button">Edit</button>
                <button class="save-button" style="display: none;">Save</button>
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

<script src="{{ asset('js/profile.js') }}"></script> <!-- Inclure le fichier JS -->
@endsection
