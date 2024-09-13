@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/shop.css') }}">
<script src="{{ asset('js/shop.js') }}"></script> <!-- Inclure le JS personnalisé pour la gestion du panier -->

<div class="container">
    <h1>Shop</h1>

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
