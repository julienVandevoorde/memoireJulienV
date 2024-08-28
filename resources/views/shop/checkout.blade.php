@extends('layouts.app')

@section('content')
    <form action="{{ url('/checkout') }}" method="post" id="payment-form">
        @csrf
        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ env('STRIPE_KEY') }}"
                data-description="Example Charge"
                data-amount="1000"
                data-locale="auto"></script>
    </form>
@endsection