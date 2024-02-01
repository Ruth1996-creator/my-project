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
    function Communes(): HasMany
    {
        return $this->hasMany(Commune::class, "pays_id");
    }
    function users(): HasMany
    {
        return $this->hasMany(User::class, "pays_id");
    }
}
