<?php

namespace App\Http\Controllers;

use App\Models\TypeMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TypeMemberController extends Controller
{   
    // return de index view van typemember, met alle type leden
    public function index () {
        return view('typemember/index', [
            'typemembers' => TypeMember::all()
        ]);
    }

    // verwijder een type lid
    public function destroy (Typemember $typemember) {
        // als er nog leden onder het type lid vallen kan deze  niet worden verwijderd
        if ($typemember->members->count() > 0){
            return Redirect::back()->withErrors(['msg' => 'Je kan geen typelid verwijderen waar nog leden onder vallen']);
        }
        // andere verwijder het type lid en stuur de user terug met een flash message
        $typemember->delete();
        session()->flash('flash', 'Type Lid is verwijderd');
        return back();
    }

    // return het edit view zodat het geselecteerde type lid bewerkt kan worden
    public function edit (Typemember $typemember) {
        return view('typemember/edit', [
            'typemember' => $typemember
        ]);
    }

    // return een create view zodat een nieuwe type lid kan worden toegevoegd
    public function create () {
        return view('typemember/create');
    }
    
    // valideer en maak een nieuw lid aan
    public function store (Request $request) {
        // check of alle gegevens ingevuld zijn en binnen de normen valt
        $attributes = request()->validate ([
          'soort_lid' => 'required|min:3|max:255',
          'omschrijving' => 'required|max:50',
          'korting' => 'required',
        ]);

        // maak een nieuw type lid aan met de opgegeven attributen en stuur de user terug met een flashmessage
        Typemember::create($attributes);
        session()->flash('flash', 'Type lid Aangemaakt');
        return redirect('/typemembers');
    }


    // valideer en Update het geselecteerde lid
    public function update (TypeMember $typemember) {
        // check of alle gegevens ingevuld zijn en binnen de normen valt
            $attributes = request()->validate ([
              'soort_lid' => 'required|min:3|max:255',
              'omschrijving' => 'required|max:50',
              'korting' => 'required|integer|min:0|max:100',
            ]);

            // update het typelid het de opgegeven attributen en stuur de user terug met een flashmessage
            $typemember->update($attributes);
            session()->flash('flash', 'Type lid Bewerkt');
            return redirect('/typemembers');
    }

}