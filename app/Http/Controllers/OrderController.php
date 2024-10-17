<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Récupérer toutes les commandes avec les utilisateurs et produits associés
        $orders = Order::with(['user', 'products'])->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Afficher les détails d'une commande spécifique
        return view('admin.orders.show', compact('order'));
    }
}
