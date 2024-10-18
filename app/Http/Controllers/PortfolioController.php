<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:70', // Le titre est obligatoire et limité à 70 caractères
            'description' => 'nullable|string', // La description est optionnelle
        ]);

        $imagePath = $request->file('image')->store('portfolio', 'public');

        Portfolio::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title', 'Portfolio Image'), // Si le titre est vide, un titre par défaut sera utilisé
            'image_path' => $imagePath,
        ]);

        return redirect()->route('profile.index')->with('success', 'Image ajoutée à votre portfolio.');
    }

    public function destroy(Portfolio $portfolio)
    {
        // Vérifier si c'est l'utilisateur propriétaire ou un admin
        if ($portfolio->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            return redirect()->route('profile.index')->with('error', 'Vous ne pouvez pas supprimer cette image.');
        }

        Storage::disk('public')->delete($portfolio->image_path);
        $portfolio->delete();

        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.portfolios.index')->with('success', 'Tatouage supprimé avec succès.');
        }

        return redirect()->route('profile.index')->with('success', 'Image supprimée du portfolio.');
    }

    // Nouvelle méthode pour afficher les tatouages dans l'admin avec recherche
    public function index(Request $request)
    {
        // Filtre par nom de tatouage
        $query = Portfolio::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        $portfolios = $query->with('user')->paginate(10);

        return view('admin.portfolios.index', compact('portfolios'));
    }
}
