@extends('layouts.app')

@section('content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<div class="dashboard-container">
<h1 class="text-center mb-5">Gestion des utilisateurs</h1>

    <!-- Conteneur pour le formulaire d'ajout d'utilisateur et de recherche -->
    <div class="form-row">
        <!-- Formulaire d'ajout d'utilisateur -->
        <div class="form-container small-form">
            <h3>Ajouter un utilisateur</h3>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" id="name" name="name" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" id="login" name="login" required>
                    @if($errors->has('login'))
                        <span class="text-danger">{{ $errors->first('login') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <!-- Champ de confirmation du mot de passe -->
                <div class="form-group">
                    <label for="password_confirmation">Confirmer le mot de passe</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                    @if($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="role">Rôle</label>
                    <select id="role" name="role" required>
                        <option value="client">Client</option>
                        <option value="tattoo artist">Tattoo Artist</option>
                        <option value="admin">Admin</option>
                    </select>
                    @if($errors->has('role'))
                        <span class="text-danger">{{ $errors->first('role') }}</span>
                    @endif
                </div>
                <!-- Champ de sélection du genre -->
                <div class="form-group">
                    <label for="gender">Genre</label>
                    <select id="gender" name="gender" required>
                        <option value="male">Homme</option>
                        <option value="female">Femme</option>
                        <option value="non-binary">Non-binaire</option>
                        <option value="other">Autre</option>
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="small-button">Ajouter</button>
                </div>
            </form>
        </div>

        <!-- Formulaire de recherche et de filtrage -->
        <div class="form-container search-form">
            <h3>Rechercher des utilisateurs</h3>
            <form action="{{ route('admin.users.index') }}" method="GET">
                <div class="form-group">
                    <label for="searchName">Nom</label>
                    <input type="text" id="searchName" name="name" value="{{ request('name') }}">
                </div>
                <div class="form-group">
                    <label for="searchLogin">Login</label>
                    <input type="text" id="searchLogin" name="login" value="{{ request('login') }}">
                </div>
                <div class="form-group">
                    <label for="searchEmail">Email</label>
                    <input type="text" id="searchEmail" name="email" value="{{ request('email') }}">
                </div>
                <div class="form-group">
                    <label for="searchRole">Rôle</label>
                    <select id="searchRole" name="role">
                        <option value="">Tous les rôles</option>
                        <option value="client" {{ request('role') == 'client' ? 'selected' : '' }}>Client</option>
                        <option value="tattoo artist" {{ request('role') == 'tattoo artist' ? 'selected' : '' }}>Tattoo Artist</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <!-- Champ de sélection du genre pour la recherche -->
                <div class="form-group">
                    <label for="searchGender">Genre</label>
                    <select id="searchGender" name="gender">
                        <option value="">Tous les genres</option>
                        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Homme</option>
                        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Femme</option>
                        <option value="non-binary" {{ request('gender') == 'non-binary' ? 'selected' : '' }}>Non-binaire</option>
                        <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>Autre</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="small-button">Rechercher</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Gestion des utilisateurs -->
    <div class="table-container">
        <h3>Gestion des utilisateurs</h3>
        <table class="custom-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}" class="custom-button">Modifier</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="custom-button" type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
