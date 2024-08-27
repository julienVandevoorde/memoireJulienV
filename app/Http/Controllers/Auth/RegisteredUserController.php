<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:30', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:client,tattoo artist,admin'],
            'gender' => ['nullable', 'string'],
            'location' => ['nullable', 'string'],
            'bio' => ['nullable', 'string'],
            'instagram_link' => ['nullable', 'string'],
            'experience_years' => ['nullable', 'integer'],
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'gender' => $request->gender,
            'location' => $request->location,
            'bio' => $request->bio,
            'instagram_link' => $request->instagram_link,
            'experience_years' => $request->experience_years,
        ]);
    
        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect(RouteServiceProvider::HOME);
    }
    
}
