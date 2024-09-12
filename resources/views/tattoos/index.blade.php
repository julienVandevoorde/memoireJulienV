@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/tattoos.css') }}">

<div class="tattoos-container">
    <h1>Découvrir des Tatouages</h1>

    <!-- Fil d'actualité de tatouages -->
    <div class="tattoo-feed">
        @foreach ($tattooImages as $tattoo)
            <div class="tattoo-item">
                <img src="{{ asset('storage/' . $tattoo->image_path) }}" alt="Tattoo by {{ $tattoo->user->name }}">
                <div class="tattoo-info">
                    <p>&#64;{{ $tattoo->user->login }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
