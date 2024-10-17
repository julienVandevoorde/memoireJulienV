@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/orders.css') }}">


<div class="container">
    <h1 class="text-center mb-5">Mes Commandes</h1>
    <br>
    <br>
    
    @if($orders->isEmpty())
        <p class="text-center">Vous n'avez pas encore passé de commande.</p>
    @else
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle order-table">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Produits commandés</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="order-row">
                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                    <td>{{ number_format($order->total_price, 2) }} €</td>
                                    <td>
                                        <ul class="list-unstyled">
                                            @foreach($order->products as $product)
                                                <li>{{ $product->name }} - {{ $product->pivot->quantity }} x {{ number_format($product->pivot->price, 2) }} €</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td><span class="badge bg-success">{{ ucfirst($order->status) }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
