<?php

namespace App\Http\Controllers;

use App\Models\TattooReport;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TattooReportController extends Controller
{
    // Afficher le formulaire de signalement
    public function create($portfolioId)
    {
        $portfolio = Portfolio::findOrFail($portfolioId);
        return view('tattoos.report', compact('portfolio'));
    }

    // Gérer la soumission du signalement
    public function store(Request $request, $portfolioId)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        TattooReport::create([
            'portfolio_id' => $portfolioId,
            'user_id' => Auth::id(),
            'reason' => $request->reason,
        ]);

        return redirect()->route('tattoos.index')->with('success', 'Tatouage signalé avec succès.');
    }
}

