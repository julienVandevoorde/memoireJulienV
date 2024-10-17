@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">

<div class="cart-container">
    <h1>Your Cart</h1>

    @if(count($cart) > 0)
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;  // Initialize total outside the loop
                @endphp
                @foreach($products as $product)
                    @if(isset($cart[$product->id])) <!-- Check if the product is in the cart -->
                        @php
                            $subtotal = $product->price * $cart[$product->id];
                            $total += $subtotal;  // Calculate the total
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
                                <button class="btn-remove" data-product-id="{{ $product->id }}">Remove</button>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <!-- Display the cart total -->
        <div class="cart-total">
            <h3>Total: ${{ number_format($total, 2) }}</h3>
        </div>

        <!-- Cart summary section with direct payment option -->
        <div class="cart-summary">
            <!-- Form to directly proceed to payment with Stripe -->
            <form action="{{ route('checkout.createSession') }}" method="POST">
                @csrf
                <button type="submit" class="btn-checkout">Proceed to Checkout</button>
            </form>
        </div>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>

<script src="{{ asset('js/cart.js') }}"></script> <!-- Include JS file for quantity management and removal -->
@endsection
