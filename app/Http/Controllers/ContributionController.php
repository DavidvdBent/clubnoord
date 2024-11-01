<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Boekjaar;
use App\Models\BookYear;
use App\Models\Contributie;
use App\Models\Contribution;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    // return view index met alle contributies, boekjaren en een lid
    public function index () {
        return view('contribution/index', [
            'contributions' => Contribution::all(),
            'bookyears' => BookYear::all(),
            'member' => Member::first()
        ]);
    }

    // return view waar je de geselecteerde contributie kan wijzigen
    public function edit (Contribution $contribution) {
        return view('contribution/edit', [
            'contribution' => $contribution
        ]);
    }

    // Update de geselecteerde contributie
    public function update (Contribution $contribution) {
        // check de input, minimaal 0 max 100 en moet een int zijn
        $attribute = request()->validate ([
            'leeftijd_korting' => 'required|integer|min:0|max:100'
          ]);
        
        // update de contributie, en redirect met een succesvolle flash message
        $contribution->update($attribute);
        session()->flash('flash', 'Contributie Bewerkt');
        return redirect('/contributions');
     }
}
