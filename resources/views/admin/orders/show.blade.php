@extends('layouts.app')

@section('content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="dashboard-container">
    <h1 class="dashboard-title text-center mb-5">Détails de la commande #{{ $order->id }}</h1>

    <div class="order-details-container">
        <div class="order-info">
            <p><strong>Utilisateur :</strong> {{ $order->user->name }}</p>
            <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y') }}</p>
            <p><strong>Total :</strong> {{ number_format($order->total_price, 2) }} €</p>
        </div>

        <h3 class="text-center mt-4">Produits commandés</h3>
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Nom du produit</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>{{ number_format($product->pivot->price, 2) }} €</td>
                        <td>{{ number_format($product->pivot->quantity * $product->pivot->price, 2) }} €</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('admin.orders.index') }}" class="custom-button">Retour aux commandes</a>
        </div>
    </div>
</div>
@endsection
