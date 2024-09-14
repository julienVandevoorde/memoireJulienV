<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs avec des options de recherche et de filtrage.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filtrage par nom
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filtrage par login
        if ($request->filled('login')) {
            $query->where('login', 'like', '%' . $request->login . '%');
        }

        // Filtrage par email
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // Filtrage par rôle
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filtrage par genre
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Récupérer les utilisateurs filtrés
        $users = $query->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Affiche le formulaire de création d'un utilisateur.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Stocke un nouvel utilisateur dans la base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'login' => 'required|string|max:30|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:client,tattoo artist,admin',
            'gender' => 'required|in:male,female,non-binary,other',
        ]);

        User::create([
            'name' => $request->name,
            'login' => $request->login,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'gender' => $request->gender,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Supprime un utilisateur spécifique.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    /**
     * Met à jour un utilisateur spécifique.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'login' => 'required|string|max:30|unique:users,login,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:client,tattoo artist,admin',
            'gender' => 'required|in:male,female,non-binary,other',
        ]);

        $user->update($request->only(['name', 'login', 'email', 'role', 'gender']));

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Affiche le formulaire d'édition d'un utilisateur.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
}
