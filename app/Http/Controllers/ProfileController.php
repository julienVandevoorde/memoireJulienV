<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function index(Request $request): View
    {
        // Charger les communes à partir du fichier JSON
        $communes = json_decode(file_get_contents(public_path('data/communes.json')), true);

        // Passe les informations utilisateur et les communes à la vue si nécessaire
        return view('profile.index', [
            'user' => $request->user(),
            'communes' => $communes,
        ]);
    }
    
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
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
            'value' => 'nullable|string',
        ]);

        $user = Auth::user();
        $field = $request->input('field');
        $value = $request->input('value');

        if (in_array($field, ['login', 'name', 'instagram_link', 'location', 'bio'])) {
            $user->$field = $value;
            $user->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}
