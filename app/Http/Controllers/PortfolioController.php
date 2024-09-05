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
        ]);

        $imagePath = $request->file('image')->store('portfolio', 'public');

        Portfolio::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title', 'Portfolio Image'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('profile.index')->with('success', 'Image ajoutée à votre portfolio.');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->user_id !== Auth::id()) {
            return redirect()->route('profile.index')->with('error', 'Vous ne pouvez pas supprimer cette image.');
        }

        Storage::disk('public')->delete($portfolio->image_path);
        $portfolio->delete();

        return redirect()->route('profile.index')->with('success', 'Image supprimée du portfolio.');
    }
}
