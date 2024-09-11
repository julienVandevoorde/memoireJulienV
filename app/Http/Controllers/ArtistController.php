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
    
        if ($request->filled('location')) {
            $query->where('location', $request->input('location'));
        }
    
        if ($request->filled('styles')) {
            $query->whereHas('styles', function ($q) use ($request) {
                $q->whereIn('styles.id', $request->input('styles'));
            });
        }
    
        if ($request->filled('experience_years')) {
            if ($request->input('experience_years') === '10+') {
                $query->where('experience_years', '>=', 10);
            } else {
                $query->where('experience_years', $request->input('experience_years'));
            }
        }
    
        $artists = $query->with('styles')->get(); // Utilisez with() pour charger les relations nécessaires
        // Débogage pour vérifier les résultats
        // dd($artists);
    
        return view('artists.index', compact('artists', 'styles', 'communes'));
    }
    
}
