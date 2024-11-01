<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adress extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function family()
    {
        return $this->hasOne(Family::class);
    }
}
