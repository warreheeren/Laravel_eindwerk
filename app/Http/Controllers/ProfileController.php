<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())]
        ]);

        $user = $request->user();
        $user->email = $validated['email'];
        $user->save();

        return back()->with('success', 'E-mailadres succesvol gewijzigd!');
    }

    public function updatePassword(Request $request) {
       $validated = $request->validate([
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();
        $user->password = Hash::make($validated['password']);
        $user->save();

        return back()->with('success_password', 'Wachtwoord is succesvol gewijzigd!');
    }
}