<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commune extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    function users(): HasMany
    {
        return $this->hasMany(User::class, "commune_id");
    }
    function Pays(): BelongsTo
    {
        return $this->belongsTo(Pays::class, "pays_id");
    }
    function arrondissements(): HasMany
    {
        return $this->hasMany(Arrondissement::class, "commune_id")->with(["quatiers"]);
    }
}
