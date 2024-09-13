@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">

<div class="cart-container">
    <h1>Votre Panier</h1>

    @if(count($cart) > 0)
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Sous-total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;  // Initialisation du total ici, en dehors de la boucle
                @endphp
                @foreach($products as $product)
                    @if(isset($cart[$product->id])) <!-- Vérifier si le produit est dans le panier -->
                        @php
                            $subtotal = $product->price * $cart[$product->id];
                            $total += $subtotal;  // Calcul du total
                        @endphp
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>
                                <div class="quantity-controls">
                                    <button class="btn-decrement" data-product-id="{{ $product->id }}">-</button>
                                    <span>{{ $cart[$product->id] }}</span>
                                    <button class="btn-increment" data-product-id="{{ $product->id }}">+</button>
                                </div>
                            </td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>${{ number_format($subtotal, 2) }}</td>
                            <td>
                                <button class="btn-remove" data-product-id="{{ $product->id }}">Supprimer</button>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <!-- Afficher le total du panier -->
        <div class="cart-total">
            <h3>Total : ${{ number_format($total, 2) }}</h3>
        </div>

        <!-- Section résumé du panier -->
        <div class="cart-summary">
            <a href="{{ route('checkout.index') }}" class="btn-checkout">Procéder au paiement</a>
        </div>
    @else
        <p>Votre panier est vide.</p>
    @endif
</div>

<script src="{{ asset('js/cart.js') }}"></script> <!-- Ajout du fichier JS pour la gestion de la quantité et suppression -->
@endsection
