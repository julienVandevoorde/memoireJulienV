@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Cart</h1>
    @if(count($cart) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    @if(isset($cart[$product->id])) <!-- Check if the product is in the cart -->
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $cart[$product->id] }}</td>
                            <td>${{ number_format($product->price * $cart[$product->id], 2) }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <!-- Bouton pour accéder au checkout -->
        <a href="{{ route('checkout.index') }}" class="btn btn-primary mt-3">Proceed to Checkout</a>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
