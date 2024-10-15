<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;

class TattooController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $liked = $request->input('liked'); // Récupérer le paramètre liked
    
        // Si l'utilisateur veut voir seulement ses likes
        if ($liked && auth()->check()) {
            $tattooImages = Portfolio::whereHas('likes', function ($query) {
                $query->where('user_id', auth()->id());
            })->with('user')
              ->when($search, function ($query, $search) {
                  $query->where('title', 'LIKE', "%{$search}%");
              })
              ->orderBy(function ($query) {
                  $query->select('created_at')
                        ->from('likes')
                        ->whereColumn('likes.portfolio_id', 'portfolios.id')
                        ->where('likes.user_id', auth()->id());
              }, 'desc') // Trie par date de like (du plus récent au plus ancien)
              ->get();
        } else {
            // Si l'utilisateur veut voir tous les tatouages
            $tattooImages = Portfolio::with('user')
                ->when($search, function ($query, $search) {
                    $query->where('title', 'LIKE', "%{$search}%");
                })
                ->inRandomOrder()
                ->get();
        }
    
        return view('tattoos.index', compact('tattooImages'));
    }
}
