<?php

namespace App\Models;

use App\Models\Contributie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookYear extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }
}
