<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Affiche le dashboard principal pour l'administrateur.
     */

    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'role:admin']);
    }

    public function index()
    {
        // Récupération des statistiques de base
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $latestUsers = User::latest()->take(5)->get();
        $latestProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalProducts', 'latestUsers', 'latestProducts'));
    }
}
