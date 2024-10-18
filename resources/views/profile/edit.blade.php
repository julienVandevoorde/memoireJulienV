@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile-edit.css') }}">

<div class="edit-profile-container">
    <h2 class="profile-heading">{{ __('Profile Settings') }}</h2>

    <div class="forms-container">
        <!-- Formulaire de mise à jour des informations du profil -->
        <div class="form-card">
            <h3 class="form-title">{{ __('Update Profile Information') }}</h3>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <!-- Nom -->
                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="form-input">
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="form-input">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bouton Mettre à Jour -->
                <div class="form-group">
                    <button type="submit" class="btn-save">{{ __('Save Changes') }}</button>
                </div>
            </form>
        </div>

        <!-- Formulaire de mise à jour du mot de passe -->
        <div class="form-card">
            <h3 class="form-title">{{ __('Update Password') }}</h3>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <!-- Mot de passe actuel -->
                <div class="form-group">
                    <label for="current_password">{{ __('Current Password') }}</label>
                    <input type="password" name="current_password" id="current_password" required class="form-input">
                    @error('current_password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nouveau mot de passe -->
                <div class="form-group">
                    <label for="password">{{ __('New Password') }}</label>
                    <input type="password" name="password" id="password" required class="form-input">
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirmation du mot de passe -->
                <div class="form-group">
                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="form-input">
                    @error('password_confirmation')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bouton Mettre à Jour le Mot de Passe -->
                <div class="form-group">
                    <button type="submit" class="btn-save">{{ __('Update Password') }}</button>
                </div>
            </form>
        </div>

        <!-- Formulaire de suppression du compte -->
        <div class="form-card delete-card">
            <h3 class="form-title text-danger">{{ __('Delete Account') }}</h3>
            <p class="delete-warning">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please download any data or information that you wish to retain before deleting your account.') }}</p>
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="form-group">
                    <button type="submit" class="btn-delete">{{ __('Delete Account') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
