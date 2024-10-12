<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request, $portfolioId)
    {
        $portfolio = Portfolio::findOrFail($portfolioId);
        $like = new Like();
        $like->user_id = auth()->id(); // ID de l'utilisateur qui like
        $like->portfolio_id = $portfolio->id; // ID du tatouage
        $like->save();

        return response()->json(['message' => 'Liked successfully']);
    }

    public function unlike(Request $request, $portfolioId)
    {
        $like = Like::where('portfolio_id', $portfolioId)
                    ->where('user_id', auth()->id())
                    ->first();

        if ($like) {
            $like->delete();
            return response()->json(['message' => 'Unliked successfully']);
        }

        return response()->json(['message' => 'Like not found'], 404);
    }
}
