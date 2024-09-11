<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Style;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer les styles et les localisations à partir de la base de données
        $styles = Style::all();
        $communes = json_decode(file_get_contents(public_path('data/communes.json')), true);
    
        // Filtrer les artistes en fonction des critères de recherche
        $query = User::where('role', 'tattoo artist'); // Filtre de base : rôle de tatoueur

        // Filtre par nom ou login
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('login', 'like', '%' . $request->input('search') . '%');
            });
        }

        // Filtre par localisation
        if ($request->filled('location')) {
            $query->where('location', $request->input('location'));
        }
    
        // Filtre par style
        if ($request->filled('styles')) {
            $query->whereHas('styles', function ($q) use ($request) {
                $q->whereIn('styles.id', $request->input('styles'));
            });
        }
    
        // Filtre par années d'expérience
        if ($request->filled('experience_years')) {
            $query->where('experience_years', $request->input('experience_years'));
        }

        // Filtre par genre
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }
    
        $artists = $query->with('styles')->get(); // Utilisez with() pour charger les relations nécessaires

        return view('artists.index', compact('artists', 'styles', 'communes'));
    }
}
