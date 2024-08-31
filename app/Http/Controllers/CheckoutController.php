<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('shop.checkout');
    }

    public function createSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));  // Utilisez votre clé secrète Stripe

        // Créer une session de paiement Stripe
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Total Cart',
                    ],
                    'unit_amount' => 2000, // Montant en cents, mettez à jour avec votre montant dynamique
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        return response()->json(['id' => $session->id]);
    }

    public function success()
    {
        return view('shop.success'); // Assurez-vous d'avoir une vue de succès
    }

    public function cancel()
    {
        return view('shop.cancel'); // Assurez-vous d'avoir une vue d'annulation
    }
}
