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
        $cart = Session::get('cart', []);

        // Si le panier est vide, on redirige vers la page du panier
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $products = Product::whereIn('id', array_keys($cart))->get();

        // Calculer le montant total du panier
        $total = 0;
        foreach ($products as $product) {
            $total += $product->price * $cart[$product->id];
        }

        return view('shop.checkout', compact('total', 'products', 'cart'));
    }

    public function createSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));  // Utilisez votre clé secrète Stripe

        // Récupère le panier de la session
        $cart = Session::get('cart', []);

        // Vérifie si le panier n'est pas vide
        if (empty($cart)) {
            return response()->json(['error' => 'Panier vide.'], 400);
        }

        $products = Product::whereIn('id', array_keys($cart))->get();

        // Créer des lignes de produits pour Stripe Checkout
        $lineItems = [];
        foreach ($products as $product) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price * 100, // Convertir le montant en cents
                ],
                'quantity' => $cart[$product->id],
            ];
        }

        // Créer une session de paiement Stripe Checkout
        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        return response()->json(['id' => $session->id]);
    }

    public function success()
    {
        return view('shop.success'); // Vue de succès après le paiement
    }

    public function cancel()
    {
        return view('shop.cancel'); // Vue d'annulation du paiement
    }
}
