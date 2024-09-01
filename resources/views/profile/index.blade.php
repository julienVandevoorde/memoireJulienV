{{-- resources/views/profile/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('My Profile') }}</h1>
    <p>Welcome, {{ $user->name }}!</p>

    <!-- Ajoute les détails du profil ici -->
    <div>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <!-- Ajoute d'autres informations nécessaires ici -->
    </div>

    <!-- Lien pour modifier le profil -->
    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
</div>
@endsection
