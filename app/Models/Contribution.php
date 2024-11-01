<?php

namespace App\Models;

use App\Models\Boekjaar;
use App\Models\TypeMember;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contribution extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function bookyear()
    {
        return $this->belongsTo(BookYear::class);
    }

    // loop over alle leden en tel de contributie op voor een totale contributie
    public function getTotalContribution () {
        $members = Member::all();
        $sum = 0;

        foreach ($members as $member){
            $agetype = $member->getContributionType($member);
            $sum += $member->getContribution($agetype, $member);
        }
        return $sum;
    }
}
