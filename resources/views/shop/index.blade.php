@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/shop.css') }}">
<script src="{{ asset('js/shop.js') }}"></script> <!-- Inclure le JS personnalisé pour la gestion du panier -->

<div class="container">
    <h1>Shop</h1>

    <!-- Formulaire de recherche de produit -->
    <form action="{{ route('shop.index') }}" method="GET" class="search-form">
        <h3>Search for a product</h3>

        <!-- Champs alignés sur une seule ligne -->
        <div class="form-group-inline">
            <div class="form-group">
                <label for="searchName">By name</label>
                <input type="text" id="searchName" name="name" value="{{ request('name') }}">
            </div>
            <div class="form-group">
                <label for="searchCategory">By category</label>
                <select id="searchCategory" name="category">
                    <option value="">All categories</option>
                    <option value="Ink" {{ request('category') == 'Ink' ? 'selected' : '' }}>Ink</option>
                    <option value="Machine" {{ request('category') == 'Machine' ? 'selected' : '' }}>Machine</option>
                    <option value="Needles" {{ request('category') == 'Needles' ? 'selected' : '' }}>Needles</option>
                    <option value="Aftercare" {{ request('category') == 'Aftercare' ? 'selected' : '' }}>Aftercare</option>
                </select>
            </div>
        </div>

        <!-- Champs de prix alignés sur une seule ligne -->
        <div class="form-group-inline">
            <div class="form-group">
                <label for="minPrice">Minimum rice</label>
                <input type="number" step="0.01" id="minPrice" name="min_price" value="{{ request('min_price') }}">
            </div>
            <div class="form-group">
                <label for="maxPrice">Maximum price</label>
                <input type="number" step="0.01" id="maxPrice" name="max_price" value="{{ request('max_price') }}">
            </div>
        </div>

        <!-- Bouton de recherche centré -->
        <div class="button-container">
            <button type="submit" class="small-button">Search</button>
        </div>
    </form>

    <!-- Liste des produits -->
    <div class="shop-feed">
        @foreach($products as $product)
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
                <p>${{ number_format($product->price, 2) }}</p>
                <button class="btn-add-to-cart" data-product-id="{{ $product->id }}">Add to Cart</button>
            </div>
        @endforeach
    </div>
</div>

@endsection
