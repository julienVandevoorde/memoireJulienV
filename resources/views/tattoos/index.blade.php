@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/tattoos.css') }}">

<div class="tattoos-container">
    <h1>Découvrir des Tatouages</h1>

    <!-- Champ de recherche -->
    <div class="search-bar">
        <form action="{{ route('tattoos.index') }}" method="GET">
            <input type="text" name="search" placeholder="Rechercher par titre de tatouage..." value="{{ request('search') }}">
            <button type="submit">Rechercher</button>
        </form>
    </div>

    <!-- Fil d'actualité de tatouages -->
    <div class="tattoo-feed">
        @foreach ($tattooImages as $tattoo)
            <div class="tattoo-item">
                <img src="{{ asset('storage/' . $tattoo->image_path) }}" alt="Tattoo by {{ $tattoo->user->name }}">
                <div class="tattoo-info">
                    <p><strong>{{ $tattoo->title }}</strong></p>
                    <p><a href="{{ route('profile.showProfile', $tattoo->user->login) }}">&#64;{{ $tattoo->user->login }}</a></p>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
