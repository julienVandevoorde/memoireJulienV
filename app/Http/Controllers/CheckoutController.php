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
        // Récupère le panier de la session
        $cart = Session::get('checkout', []);
    
        // Vérifie si le panier n'est pas vide
        if (empty($cart)) {
            $total = 0; // Panier vide, total est zéro
        } else {
            $products = Product::whereIn('id', array_keys($cart))->get();
    
            // Initialiser le montant total du panier à 0
            $total = 0;
    
            // Calculer le montant total du panier
            foreach ($products as $product) {
                $total += $product->price * $cart[$product->id];
            }
        }
    
        // Transmettez la variable $total à la vue
        return view('shop.checkout', compact('total'));
    }
    

    public function createSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));  // Utilisez votre clé secrète Stripe

        // Récupère le panier de la session
        $cart = Session::get('checkout', []);

        // Vérifie si le panier n'est pas vide
        if (empty($cart)) {
            return response()->json(['error' => 'Panier vide.'], 400);
        }

        $products = Product::whereIn('id', array_keys($cart))->get();

        // Initialiser le montant total du panier à 0
        $total = 0;

        // Calculer le montant total du panier
        foreach ($products as $product) {
            $total += $product->price * $cart[$product->id];
        }

        // Convertir le total en cents (pour Stripe)
        $amountInCents = $total * 100;

        // Créer une session de paiement Stripe avec le montant dynamique
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Total Cart',
                    ],
                    'unit_amount' => $amountInCents, // Utiliser le montant calculé
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
