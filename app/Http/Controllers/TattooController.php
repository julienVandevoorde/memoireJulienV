<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;

class TattooController extends Controller
{
    public function index(Request $request)
    {
        // Obtenir le texte de recherche de l'utilisateur
        $search = $request->input('search');

        // Récupérer les images de tatouage des portfolios avec filtre de recherche
        $tattooImages = Portfolio::with('user')
            ->when($search, function ($query, $search) {
                $query->where('title', 'LIKE', "%{$search}%");
            })
            ->inRandomOrder()
            ->get();

        return view('tattoos.index', compact('tattooImages'));
    }
}

