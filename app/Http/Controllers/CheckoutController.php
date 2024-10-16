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

    public function createSession()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $cart = Session::get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();

        // Créez la liste des articles pour Stripe Checkout
        $lineItems = [];
        foreach ($products as $product) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price * 100, // Convertir en cents
                ],
                'quantity' => $cart[$product->id],
            ];
        }

        // Créer la session de paiement Stripe avec collecte d'adresse de livraison
        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),

            // Ajouter la collecte d'adresse de livraison
            'shipping_address_collection' => [
                'allowed_countries' => ['BE'], // Pays autorisés pour la livraison
            ],
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        // Réinitialiser le panier après le paiement réussi
        Session::forget('cart');
        
        // Ajouter un message flash de confirmation de commande
        return redirect()->route('shop.index')->with('success', 'Votre commande a été passée avec succès ! 
        Consultez la section "Mes commandes" pour plus de détails.');
    }

    public function cancel()
    {
        return redirect()->route('cart.index')->with('error', 'Paiement annulé.');
    }
}
