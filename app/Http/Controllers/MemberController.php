<?php

namespace App\Http\Controllers;

use App\Models\Adress;
use App\Models\Family;
use App\Models\Member;
use App\Models\TypeMember;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Validation\ValidationException;

class MemberController extends Controller
{
    // // stuur de member view index terug met een collectie van alle leden met maximaal per pagina
    public function index () {
        return view('member/index', [
            'members' => Member::simplePaginate(10)
        ]);
    }
    // Return een view met informatie over het huidige lid
    public function show (Member $member) {
        return view('member/show', [
            'member' => $member
        ]);
    }
    
    // Return een view waar de user(admin) een nieuw lid kan aanmaken (met alle families en soort leden voor selectie)
    public function create () {
        return view('member/create',[
            'families' => Family::all(),
            'typemembers' => TypeMember::all()
        ]);
    }

    // Return een view waar de user het huidige lid kan bewerken (met de huidige member en de families, typeleden voor selectie)
    public function edit (Member $member) {
        return view('member/update',[
            'member' => $member,
            'families' => Family::all(),
            'typemembers' => TypeMember::all()
        ]);
    }

    // Sla een nieuw lid na validatie op (en mogelijk een nieuw adres en familie)
    public function store (Request $request) {
        // als de user een nieuwe familie selecteert op de checkbox
        if ($request['familie_check'] == 'new'){
            // check de member attributen, alles moet worden ingevuld
            $memberAttributes = request()->validate ([
              'naam' => 'required|min:3|max:255',
              'type_member_id' => 'required',
              'geboortedatum' => 'required',
            ]);
             
            // check de nieuwe adres gegevens, alles behalve toevoeging moet worden ingevuld
            $adresAttributes = request()->validate(([
                'straatnaam' => 'required|min:3', 
                'huisnummer' => 'required',
                'postcode' => 'required',
                'toevoeging' => ['max:255',
                // Check of het precieze huidige adres niet al in gebruik is door een andere familie
                    Rule::unique('adresses', 'toevoeging')
                        ->where('huisnummer', $request['huisnummer'])
                        ->where('postcode', $request['postcode'])
                        ->where('straatnaam', $request['straatnaam'])],
                
            ])); 
            
            
            // check de familie gegevens (alleen de naam) moet worden ingevuld
            $familyAttributes = request()->validate ([
                'fam_naam' => 'required|min:3|max:255',
            ]);
            // maak een nieuw adres aan
            $adres = Adress::create($adresAttributes);

            // Koppel het adres aan de huidige familie attributen
            $familyAttributes += ([
                'adress_id' => $adres->id
            ]);

            // Maak de familie aan met de familie attributen
            $fam = Family::create($familyAttributes);

            // koppel de familie aan het de attributen van het lid
            $memberAttributes += ([
                'family_id' => $fam->id
              ]);

            // Maak het lid aan met de member attributen en stuur de user terug met een flash message
            Member::create($memberAttributes);
            session()->flash('flash', 'Lid Aangemaakt');
            return redirect ('/');
        }

        // als de user het lid wilt toevoegen aan een huidige familie
        if ($request['familie_check'] == 'exist'){
            // check of de lid gegevens correct zijn ingevuld, dit keer ook de family id
            $memberAttributes = request()->validate ([
                'naam' => 'required|min:3|max:255',
                'type_member_id' => 'required',
                'geboortedatum' => 'required',
                'family_id' => 'max:255'
              ]);
            
            // maak het nieuwe lid aan en deze word toegevoegd dmv de foreign key aan het adres & familie en stuur de gebruiker terug met een flash message
            Member::create($memberAttributes);
        }
        session()->flash('flash', 'Lid Aangemaakt');
        return redirect ('/');
}
    // verwijder het geselecteerde lid
    public function destroy (Member $member) {
        // check of er nog meer familie leden zijn
        if ($member->family->members->count() == 1 ){
            // als dit lid het enige van de familie is, verwijder ook het adres en de familie en stuur de user terug met flashmessage
            $member->delete();
            $member->family->delete();
            $member->family->adress->delete();
            session()->flash('flash', 'Lid en Familie Verwijderd');
            return redirect('/');
        }
        // Verwijder het lid en stuur de user terug met een flashmessage
        $member->delete();
        session()->flash('flash', 'Lid Verwijderd');
        return redirect()->back();
    }

    // Update het geselecteerde lid
    public function update (Request $request, Member $member){
        // als de user een nieuwe familie selecteert op de checkbox
        if ($request['familie_check'] == 'new'){
            // check de member attributen, alles moet worden ingevuld
            $memberAttributes = request()->validate ([
              'naam' => 'required|min:3|max:255',
              'type_member_id' => 'required',
              'geboortedatum' => 'required',
            ]);

            // check de nieuwe adres gegevens, alles behalve toevoeging moet worden ingevuld
            $adresAttributes = request()->validate(([
                'straatnaam' => 'required|min:3', 
                'huisnummer' => 'required',
                'postcode' => 'required',
                // Check of het precieze huidige adres niet al in gebruik is door een andere familie
                'toevoeging' => ['max:255',
                    Rule::unique('adresses', 'toevoeging')
                        ->where('huisnummer', $request['huisnummer'])
                        ->where('postcode', $request['postcode'])
                        ->where('straatnaam', $request['straatnaam'])],
                
            ])); 
            
            // check de familie gegevens (alleen de naam) moet worden ingevuld
            $familyAttributes = request()->validate ([
                'fam_naam' => 'required|min:3|max:255',
            ]);

            // maak een nieuw adres aan 
            $adres = Adress::create($adresAttributes);
            
            // Koppel het adres aan de huidige familie attributen
            $familyAttributes += ([
                'adress_id' => $adres->id
            ]);

            // Maak de familie aan met de familie attributen
            $fam = Family::create($familyAttributes);

            // koppel de familie aan het de attributen van het lid
            $memberAttributes += ([
                'family_id' => $fam->id
              ]);
            
            //  Check hoeveel leden er nog in de familie zitten van de oude familie van het lid
             $old_mem = $member->family->members->count();

            // Als dit maar een is, dus alleen het huidige lid, moet de familie en het adres verwijderd worden
            if ($old_mem == 1 ){
                $member->update($memberAttributes);
                $member->family->delete();
                $member->family->adress->delete();
                // Stuur de user terug met flash message
                session()->flash('flash', 'Lid Bewerkt & Familie Verwijderd');
                return redirect('/');}
            
            // update het geselecteerde lid en stuur de user terug met een flashmessage
            $member->update($memberAttributes);
            session()->flash('flash', 'Lid Bewerkt');
            return redirect('/');
        
        }

        // als de user het lid wilt toevoegen aan een huidige andere familie
        if ($request['familie_check'] == 'exist'){
            // check of de lid gegevens correct zijn ingevuld, dit keer ook de family id
            $memberAttributes = request()->validate ([
                'naam' => 'required|min:3|max:255',
                'type_member_id' => 'required',
                'geboortedatum' => 'required',
                'family_id' => 'max:255'
              ]);
              
             //  Check hoeveel leden er nog in de familie zitten van de oude familie van het lid
            $old_mem = $member->family->members->count();
            
            // Als dit maar een is, dus alleen het huidige lid, moet de familie en het adres verwijderd worden
            if ($old_mem == 1 ){
                $member->update($memberAttributes);
                $member->family->delete();
                $member->family->adress->delete();
                // Stuur de user terug met flash message
                session()->flash('flash', 'Lid Bewerkt & Familie Verwijderd');
                return redirect('/');}
            
            }
            
            // update het geselecteerde lid en stuur de user terug met een flashmessage
            $member->update($memberAttributes);
            session()->flash('flash', 'Lid Bewerkt');
            return redirect('/');
            }
}

