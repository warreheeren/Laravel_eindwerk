<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index() {
        // Pas de views aan zodat je de juiste item counts kunt tonen in de knoppen op de profiel pagina.
        return view('profile.index');
    }

    public function edit() {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
        return view('profile.edit');
    }

    public function updateEmail(Request $request) {
        // Valideer het formulier, zorg dat het terug ingevuld wordt, en toon de foutmeldingen
         $validated = $request->validate([
            'email' =>'required|string|email|max:255|unique:users',
            Rule::unique('users')->ignore(Auth::id())
        ]);

         Auth::user()->update([
            'email' => $validated['email'],
        ]);

        return back()->with('success', 'E-mailadres succesvol gewijzigd!');
    }

    public function updatePassword(Request $request) {
        // Valideer het formulier, zorg dat het terug ingevuld wordt, en toon de foutmeldingen
        // Wachtwoord is verplicht en moet confirmed zijn.
        // Update de gegevens van de ingelogde gebruiker met het nieuwe "hashed" password

        // BONUS: Stuur een e-mail naar de gebruiker met de melding dat zijn wachtwoord gewijzigd is.

        return redirect()->route('profile.edit');
    }
}