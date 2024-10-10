<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserReport;

class UserReportController extends Controller
{
    // Afficher le formulaire de signalement pour un utilisateur spécifique
    public function showReportForm($id)
    {
        $user = User::findOrFail($id); // Trouver l'utilisateur par son ID

        return view('artists.report', compact('user')); // Retourner la vue avec l'utilisateur à signaler
    }

    // Enregistrer le signalement dans la base de données
    public function submitReport(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
            'reported_user_id' => 'required|exists:users,id', // Assurez-vous que l'ID existe
        ]);

        $user = User::findOrFail($id); // Récupérer l'utilisateur signalé

        UserReport::create([
            'reported_user_id' => $request->input('reported_user_id'), // ID de l'utilisateur signalé
            'reporting_user_id' => auth()->id(), // ID de l'utilisateur qui fait le signalement
            'reason' => $request->input('reason'), // Raison du signalement
        ]);

        return redirect()->route('profile.showProfile', $user->login)->with('success', 'Signalement envoyé avec succès.');
    }
}
