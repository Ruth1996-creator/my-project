<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pays extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    function Villes(): HasMany
    {
        return $this->hasMany(Villes::class, "pays_id");
    }
}
