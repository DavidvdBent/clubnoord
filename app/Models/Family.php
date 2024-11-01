<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Family extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function adress (){
        return $this->belongsTo(Adress::class);
    }

    // loop over alle leden van de gegeven familie en tel hun individuele contributie bij elkaar op
    public function getSumContribution (Family $family) {
        $members = $family->members;
        $sum = 0;

        foreach ($members as $member){
            $agetype = $member->getContributionType($member);
            $sum += $member->getContribution($agetype, $member);
        }
        return $sum;
    }
}
