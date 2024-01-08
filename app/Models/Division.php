<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'product_category'
    ];

    protected $table = "divisions";

    function Category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, "product_category");
    }
    function Classes(): HasMany
    {
        return $this->hasMany(Classe::class, "division");
    }
}
