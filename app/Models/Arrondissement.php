<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Arrondissement extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'commune_id'

    ];
    function users(): HasMany
    {
        return $this->hasMany(User::class, "arrondissement_id");
    }
    function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class, "commune_id")->with(["pays"]);
    }
    function quatiers(): HasMany
    {
        return $this->hasMany(Quatier::class, "arrondissement_id");
    }
}
