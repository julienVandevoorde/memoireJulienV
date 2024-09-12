<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Portfolio;

class TattooController extends Controller
{
    public function index()
    {
        // Récupérer toutes les images de tatouages des portfolios des tatoueurs
        $tattooImages = Portfolio::inRandomOrder()->get();

        // Retourner la vue avec les images de tatouages
        return view('tattoos.index', compact('tattooImages'));
    }
}
