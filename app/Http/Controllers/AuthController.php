<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Mailer as MailerMailer;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function handleLogin(Request $request) {
        $credentials = $request->validate([
            'email' =>'required|email|string|max:255',
            'password' => 'required|string|min:8'
        ]);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('profile'));
        }
        return back()->withErrors(['email' => 'Het ingevoerde emailadres of wachtwoord is onjuist.']);
    }

    public function register() {
        return view('auth.register');
    }

    public function handleRegister(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' =>'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('login');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('login');

        return back();
    }
}