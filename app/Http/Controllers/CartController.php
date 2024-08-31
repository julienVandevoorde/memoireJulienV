<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CartController extends Controller
{
    // Afficher le panier
    public function index()
    {
        $cart = Session::get('cart', []); // Récupère le panier de la session
        $products = Product::whereIn('id', array_keys($cart))->get();

        return view('shop.cart', compact('products', 'cart'));
    }

    // Ajouter un produit au panier
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1); // Par défaut, ajouter une quantité de 1

        // Récupérer le panier de la session ou initialiser un panier vide
        $cart = Session::get('cart', []);

        // Si le produit existe déjà dans le panier, augmenter la quantité
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        // Mettre à jour le panier dans la session
        Session::put('cart', $cart);

        // Calculer le nombre total de produits dans le panier
        $cartCount = array_sum($cart);

        // Retourner une réponse JSON avec le nouveau total
        return response()->json(['success' => true, 'cartCount' => $cartCount]);
    }

    // Supprimer un produit du panier
    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1); // Quantité à retirer

        // Récupérer le panier de la session ou initialiser un panier vide
        $cart = Session::get('cart', []);

        // Si le produit existe déjà dans le panier, diminuer la quantité ou le retirer
        if (isset($cart[$productId])) {
            $cart[$productId] -= $quantity;
            if ($cart[$productId] <= 0) {
                unset($cart[$productId]); // Retirer complètement le produit si la quantité est 0 ou moins
            }
        }

        // Mettre à jour le panier dans la session
        Session::put('cart', $cart);

        // Calculer le nombre total de produits dans le panier
        $cartCount = array_sum($cart);

        // Retourner une réponse JSON avec le nouveau total
        return response()->json(['success' => true, 'cartCount' => $cartCount]);
    }

    // Compter les articles dans le panier
    public function count()
    {
        $cart = Session::get('cart', []);
        $cartCount = array_sum($cart);

        return response()->json(['cartCount' => $cartCount]);
    }
}
