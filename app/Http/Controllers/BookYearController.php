<?php

namespace App\Http\Controllers;

use App\Models\Boekjaar;
use App\Models\BookYear;
use Illuminate\Http\Request;

class BookYearController extends Controller
{
    // return view voor het bewerken van de basis contributie van het huidige boekjaar
    public function edit (BookYear $bookyear) {
        return view('bookyear/edit', [
            'boekjaar' => $bookyear
        ]);
    }

    // Update de basis contributie van het huidige boekjaar
    public function update (BookYear $bookyear) {
        // check de gegeven input, moet minimaal 0 zijn en een int zijn.
        $attribute = request()->validate ([
            'basis_contributie' => 'required|integer|min:0'
          ]);
        
        // update
        $bookyear->update($attribute);

        // maak een flash message aan en redirect naar contributies index
        session()->flash('flash', 'Contributie Bewerkt');
        return redirect('/contributions');
     }
}
