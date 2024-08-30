@extends('layouts.app')

@section('content')
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
                    <div class="top" style="background: url('{{ asset($product->image_path) }}') no-repeat center center; background-size: cover;"></div>
                    <div class="bottom">
                        <div class="left">
                            <div class="details">
                                <h1 class="product-name">{{ $product->name }}</h1>
                                <p class="product-price">
                                    $<span id="price-{{ $product->id }}" data-base-price="{{ $product->price }}">{{ number_format($product->price, 2) }}</span>
                                    <button class="btn-increment" data-product-id="{{ $product->id }}" data-increment="1">+1</button>
                                    <!-- Bouton -1 -->
                                    <button class="btn-decrement" data-product-id="{{ $product->id }}" data-increment="1" style="display: none;">-1</button>
                                </p>
                            </div>
                            <div class="buy" data-product-id="{{ $product->id }}" onclick="addToCart({{ $product->id }})">
                                <i class="material-icons">add_shopping_cart</i>
                            </div>
                        </div>
                        <div class="right">
                            <div class="done"><i class="material-icons">done</i></div>
                            <div class="details">
                                <h1 class="product-name">{{ $product->name }}</h1>
                                <p id="added-message-{{ $product->id }}">Added to your cart</p>
                            </div>
                            <div class="remove"><i class="material-icons">clear</i></div>
                        </div>
                    </div>
                </div>
                <div class="inside">
                    <div class="icon"><i class="material-icons">info_outline</i></div>
                    <div class="contents">
                        <h1>{{ $product->name }}</h1>
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
