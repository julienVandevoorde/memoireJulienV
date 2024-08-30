<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Récupérer tous les produits de la base de données
        return view('shop.index', compact('products')); // Passer les produits à la vue
    }
}
