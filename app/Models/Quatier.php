<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quatier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'arrondissement_id',

    ];
    function users(): HasMany
    {
        return $this->hasMany(User::class, "quatier");
    }
    function arrondissement(): BelongsTo
    {
        return $this->belongsTo(Arrondissement::class, "arrondissement_id")->with(["commune"]);
    }
    
}
