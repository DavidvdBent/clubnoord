<?php

namespace App\Http\Controllers;

use App\Models\Adress;
use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FamilyController extends Controller
{

// stuur de view index terug met een collectie van alle families met maximaal 10 families per pagina
public function index() {
    return view('family/index', [
        'families' => Family::simplePaginate(10)
    ]);
    }

// stuur de view show terug met de geselecteerde familie
public function show(Family $family) {
    return view('family/show', [
        'family' => $family,
    ]);
}

// stuur de view edit terug met de geselecteerde familie
public function edit(Family $family) {
    return view('family/edit', [
        'family' => $family
    ]);
}

// Update de huidige familie
public function update (Request $request, Family $family) {
    // check of de adres gegevens kloppen, alles is required behalve de toevoeging
    $adresAttributes = request()->validate(([
        'straatnaam' => 'required|min:3', 
        'huisnummer' => 'required',
        'postcode' => 'required',
        // check of er al een familie staat ingeschreven met precies hetzelfde adres, dit moet namelijk uniek zijn.
        'toevoeging' => ['max:255',
            Rule::unique('adresses')->ignore($family->adress->id)
                ->where('toevoeging', $request['toevoeging'])
                ->where('huisnummer', $request['huisnummer'])
                ->where('postcode', $request['postcode'])
                ->where('straatnaam', $request['straatnaam'])],
            ])); 
    // check of de familie naam is ingevuld
    $familyAttributes = request()->validate ([
        'fam_naam' => 'required|min:3|max:255',
    ]);

    // update het adress van de gegeven familie met de gevalideerde adresatrributen
    $family->adress->update($adresAttributes);

    // update de familie met de gevalideerde familieattributen
    $family->update($familyAttributes);

    // stuur user terug met flash message naar de bewerkte familie show view
    session()->flash('flash', 'Familie Bewerkt');
    return redirect('/family/'.$family->id);

}

// delete de geselecteerde familie
public function destroy (Family $family) {
    // verwijder dmv een loop alle leden van de familie
    foreach ($family->members as $member) {
        $member->delete();
    }

    // delete de familie
    $family->delete();

    // delete het adres gekoppeld aan de familie en stuur de user terug met een flash message
    $family->adress->delete();
    session()->flash('flash', 'Familie Verwijderd');
    return redirect('/');
} 
}
