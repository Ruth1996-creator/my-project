<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    function Products(): HasMany
    {
        return $this->hasMany(Product::class, "product_category");
    }
    function Divisions(): HasMany
    {
        return $this->hasMany(Division::class, "product_category")->with(["Classes"]);
    }
}
