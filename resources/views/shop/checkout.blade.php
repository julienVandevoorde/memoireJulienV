@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>

    <!-- Stripe Checkout Form -->
    <form action="{{ url('/checkout') }}" method="post" id="payment-form">
    @csrf
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ env('STRIPE_KEY') }}"
            data-description="Paiement pour les articles"
            data-amount="{{ $total * 100 }}" 
            data-locale="auto"></script>
</form>

</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    document.getElementById('payment-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        try {
            const response = await fetch('{{ url("/checkout/session") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            if (!response.ok) {
                const error = await response.json();
                console.error('Erreur:', error.error);
                return;
            }

            const { id: sessionId } = await response.json();
            const stripe = Stripe("{{ env('STRIPE_KEY') }}");  // Correction de la syntaxe ici
            stripe.redirectToCheckout({ sessionId });
        } catch (error) {
            console.error('Erreur:', error);
        }
    });
</script>
@endsection
