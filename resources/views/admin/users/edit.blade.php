@extends('layouts.app')

@section('content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="dashboard-container">
    <h3>Modifier l'utilisateur</h3>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" id="login" name="login" value="{{ $user->login }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label for="role">Rôle</label>
            <select id="role" name="role" required>
                <option value="client" {{ $user->role == 'client' ? 'selected' : '' }}>Client</option>
                <option value="tattoo artist" {{ $user->role == 'tattoo artist' ? 'selected' : '' }}>Tattoo Artist</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="form-group">
            <label for="gender">Genre</label>
            <select id="gender" name="gender" required>
                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                <option value="non-binary" {{ $user->gender == 'non-binary' ? 'selected' : '' }}>Non-binary</option>
                <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit">Enregistrer les modifications</button>
        </div>
    </form>
</div>
@endsection
