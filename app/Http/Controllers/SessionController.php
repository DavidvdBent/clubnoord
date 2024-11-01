<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{   
    // Return de create view voor de user (login page)
    public function create () {
        return view('session/create');
    }

    // sla/log de huidige user op/in, na validatie
    public function store () {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Als de gegevens kloppen, word de user doorgestuurd naar de admin homepage met flashmessage
        if (auth()->attempt($attributes)){
            session()->flash('flash', 'Gebruiker ingelogd');
            return redirect('/');
        }
        
        // Als de gegevens niet kloppen, geef dit aan met een error in de create view
        throw ValidationException::withMessages([
            'email' => 'Gegevens zijn niet bij ons bekend'
        ]);
    }

    // log de huidige user uit
    public function destroy () {
        auth()->logout();
        // en stuur de nu guest terug naar het inlog scherm
        session()->flash('flash', 'Gebruiker uitgelogd');
        return redirect('/login');
    }
  
}
