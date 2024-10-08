<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Style; // Importer le modèle Style
use App\Models\User; // Importer le modèle User

class ProfileController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        // Charger les communes à partir du fichier JSON
        $communes = json_decode(file_get_contents(public_path('data/communes.json')), true);

        // Charger les styles depuis la base de données
        $styles = Style::all(); // Récupère tous les styles de la table 'styles'
        $userStyles = $user->styles->pluck('id')->toArray(); // Récupère les IDs des styles de l'utilisateur

        // Vérifier le rôle de l'utilisateur et retourner la vue appropriée
        if ($user->isTattooArtist()) {
            return view('profile.indexArtist', compact('user', 'communes', 'styles', 'userStyles'));
        } else {
            return view('profile.indexClient', compact('user'));
        }
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Limite de taille et type de fichier
        ]);

        $user = $request->user();

        // Supprime l'ancienne photo si elle existe
        if ($user->profile_photo_path) {
            Storage::delete('public/' . $user->profile_photo_path);
        }

        // Enregistre la nouvelle photo avec l'extension correcte
        $extension = $request->file('profile_photo')->getClientOriginalExtension();
        $path = $request->file('profile_photo')->storeAs('profile_photos', uniqid() . '.' . $extension, 'public');

        // Met à jour le chemin de la photo dans la base de données
        $user->profile_photo_path = $path;
        $user->save();

        return response()->json(['success' => true, 'path' => $path]);
    }

    public function updateField(Request $request)
    {
        $request->validate([
            'field' => 'required|string',
            'value' => 'nullable',
        ]);

        $user = Auth::user();
        $field = $request->input('field');
        $value = $request->input('value');

        if ($user->isTattooArtist() && $field === 'styles') {
            $styleIds = $request->input('value', []);
            $user->styles()->sync($styleIds); // Mise à jour des styles pour le tatoueur
            return response()->json(['success' => true]);
        } elseif (in_array($field, ['login', 'name', 'instagram_link', 'location', 'bio', 'experience_years'])) {
            $user->$field = $value;
            $user->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }

    public function showProfile($login)
    {
        // Recherche de l'utilisateur par login
        $user = User::where('login', $login)->first();

        // Si l'utilisateur n'est pas trouvé, renvoyer une erreur 404
        if (!$user) {
            abort(404, 'User not found');
        }

        // Déterminer le type d'utilisateur et retourner la vue appropriée
        if ($user->role === 'tattoo artist') {
            // Récupérer les styles de l'utilisateur tatoueur
            $styles = $user->styles;

            return view('artists.showArtist', compact('user', 'styles'));
        } elseif ($user->role === 'client') {
            return view('artists.showClient', compact('user'));
        } else {
            // Gérer d'autres types d'utilisateurs si nécessaire
            abort(404, 'Invalid user role');
        }
    }



}
