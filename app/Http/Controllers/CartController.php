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
        $cart = $this->getCart();
        $products = Product::whereIn('id', array_keys($cart))->get();

        return view('shop.cart', compact('products', 'cart'));
    }

    // Ajouter un produit au panier
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1); // Par défaut, ajouter une quantité de 1

        $cart = $this->getCart();

        // Si le produit existe déjà dans le panier, augmenter la quantité
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        $this->updateCart($cart);

        // Calculer le nombre total de produits dans le panier
        $cartCount = $this->calculateCartCount($cart);

        return response()->json(['success' => true, 'cartCount' => $cartCount]);
    }

    // Mettre à jour la quantité d'un produit dans le panier
    public function updateQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1); // Quantité à mettre à jour

        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $cart[$productId] = $quantity;
        }

        $this->updateCart($cart);

        $cartCount = $this->calculateCartCount($cart);

        return response()->json(['success' => true, 'cartCount' => $cartCount]);
    }

    // Supprimer un produit du panier
    public function removeProduct(Request $request)
    {
        $productId = $request->input('product_id');

        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        $this->updateCart($cart);

        $cartCount = $this->calculateCartCount($cart);

        return response()->json(['success' => true, 'cartCount' => $cartCount]);
    }

    // Compter les articles dans le panier
    public function count()
    {
        $cart = $this->getCart();
        $cartCount = $this->calculateCartCount($cart);

        return response()->json(['cartCount' => $cartCount]);
    }

    // Méthode privée pour récupérer le panier de la session
    private function getCart()
    {
        return Session::get('cart', []);
    }

    // Méthode privée pour mettre à jour le panier dans la session
    private function updateCart($cart)
    {
        Session::put('cart', $cart);
    }

    // Méthode privée pour calculer le nombre total d'articles dans le panier
    private function calculateCartCount($cart)
    {
        return array_sum($cart);
    }
}
