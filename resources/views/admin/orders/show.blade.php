@extends('layouts.app')

@section('content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="dashboard-container">
    <h1 class="dashboard-title text-center mb-5">Order Details #{{ $order->id }}</h1>

    <div class="order-details-container">
        <div class="order-info">
            <p><strong>User:</strong> {{ $order->user->name }}</p>
            <p><strong>Date:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
            <p><strong>Total:</strong> {{ number_format($order->total_price, 2) }} €</p>
        </div>

        <h3 class="text-center mt-4">Ordered Products</h3>
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
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
            <a href="{{ route('admin.orders.index') }}" class="custom-button">Back to Orders</a>
        </div>
    </div>
</div>
@endsection
