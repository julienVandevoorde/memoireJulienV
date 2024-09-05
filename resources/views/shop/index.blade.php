@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Shop page</h1>
        <br>
        <h1>To do :</h1>
        <h2>- Ajouter un système de filtre et recherche des produits</h2>
    </div>

<div class="container my-4">
    <!-- Inclure les fichiers CSS de la navbar et les styles de produit -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-product-card.css') }}">

    <!-- Inclure le JavaScript personnalisé -->
    <script src="{{ asset('js/custom-product-card.js') }}"></script>

    <div class="shop-container">
        @foreach($products as $product)
            <div class="wrapper">
                <div class="container">
                <div class="top" style="background: url('/storage/{{ $product->image_path }}') no-repeat center center; background-size: cover;"></div>
                    <div class="bottom">
                        <div class="left">
                            <div class="details">
                                <h1 class="product-name">{{ $product->name }}</h1>
                                <p class="product-price">
                                    $<span id="price-{{ $product->id }}" data-base-price="{{ $product->price }}">{{ number_format($product->price, 2) }}</span>
                                    <button class="btn-increment" data-product-id="{{ $product->id }}" data-increment="1">+1</button>
                                    <!-- Bouton -1 -->
                                    <button class="btn-decrement" data-product-id="{{ $product->id }}" data-increment="1" style="display: none;">-</button>
                                </p>
                            </div>
                            <div class="buy" data-product-id="{{ $product->id }}" onclick="addToCart('{{ $product->id }}')">
                                <i class="material-icons">add_shopping_cart</i>
                            </div>
                        </div>
                        <!-- Partie droite et animations supprimées -->
                    </div>
                </div>
                <div class="inside">
                    <div class="icon"><i class="material-icons">info_outline</i></div>
                    <div class="contents">
                        <h2 style="color: white;">{{ $product->name }}</h2>
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
