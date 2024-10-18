<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Vous pouvez envoyer un email ici, ou enregistrer le message dans la base de données
        // Par exemple:
        // Mail::to('admin@example.com')->send(new ContactFormSubmitted($request->all()));

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
