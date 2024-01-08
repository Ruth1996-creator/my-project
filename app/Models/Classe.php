<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classe extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'division'

    ];
    function Division(): BelongsTo
    {
        return $this->belongsTo(Division::class, "division")->with(["Category"]);
    }
    function Products(): HasMany
    {
        return $this->hasMany(Product::class, "classe");
    }
}
