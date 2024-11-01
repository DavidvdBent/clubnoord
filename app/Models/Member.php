<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Family;
use App\Models\TypeMember;
use App\Models\Contributie;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function family()
    {
        return $this->belongsTo(Family::class);
    }
    
    public function type_member (){
        return $this->belongsTo(TypeMember::class);
    }

    // bereken onder welk leeftijdstype een lid valt dmv een switch statement
    public function getContributionType(Member $member) {

        // bereken de huidige leeftijd in jaren van het lid dmv zijn geboortedatum
        $age =  Carbon::parse($this->attributes['geboortedatum'])->age;

        // return zijn leeftijdstype (jeugd, aspirant etc...)
        switch ($age) {
            case($age < 8):
                $agetype = 'jeugd';
                return $agetype;
                break;

            case($age >= 8 && $age <= 12):
                $agetype = 'aspirant';
                return $agetype;
                break;
            
            case($age >= 13 && $age <= 17):
                $agetype = 'junior';
                return $agetype;
                break;
            
            case($age >= 18 && $age <= 50):
                $agetype = 'senior';
                return $agetype;
                break;
            
            case($age >= 51):
                $agetype = 'oudere';
                return $agetype;
                break;

            default:
               return $agetype ="Something went wrong";
        }
    }
    
    // Bereken de contributie van het gegeven lid dmv van de totale contributie te verminderen met de leeftijd- en typelid-/korting van het huidige lid.
    public function getContribution ($agetype, Member $member) {

        // haal het kolom op uit contributies wat matcht met het leeftijdtype
        $contribution = DB::table('contributions')
        ->where('leeftijd', 'LIKE', "%$agetype%") 
        ->get();
            
        // sla de leeftijdkorting op van deze kolom
        $leeftijd_korting = $contribution->first()->leeftijd_korting;

        // sla de typekorting van het huidige lid op
        $type_korting = $member->type_member->korting;

        // sla het huidige boekjaar op
        $boekjaar_id = $contribution->first()->boekjaar_id;

        // verkrijg de basiscontributie dmv het boekjaar id
        $basis_contributie = DB::table('book_years')
        ->where('id', 'LIKE', "%$boekjaar_id%") 
        ->get();

        // bereken het totale korting percentage (leeftijdkorting + typelidkorting)
        $korting_percentage = (100 - ($type_korting + $leeftijd_korting)) /100;
    
        // Als de korting meer dan 100%, sla op als 100%
        if($korting_percentage < 0){
            $korting_percentage = 0;
        }

        // bereken de contributie * korting voor het huidige lid en return deze waarde
        $contributie = ($korting_percentage * $basis_contributie->first()->basis_contributie );

        return ($contributie);      
        }
}
 