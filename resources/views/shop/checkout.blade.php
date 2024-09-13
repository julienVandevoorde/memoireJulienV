@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>
    <form id="payment-form">
        <button id="checkout-button" class="btn btn-primary">Payer avec Stripe</button>
    </form>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    document.getElementById('checkout-button').addEventListener('click', function(e) {
        e.preventDefault();

        fetch('{{ route('checkout.createSession') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(session) {
            var stripe = Stripe('{{ env('STRIPE_KEY') }}');
            return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function(result) {
            if (result.error) {
                alert(result.error.message);
            }
        })
        .catch(function(error) {
            console.error('Erreur:', error);
        });
    });
</script>
@endsection
