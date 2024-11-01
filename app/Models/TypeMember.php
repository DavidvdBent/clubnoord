<?php

namespace App\Models;

use App\Models\Contributie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeMember extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
