@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>
    <form action="{{ route('checkout.createSession') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Payer avec Stripe</button>
    </form>
</div>
@endsection
