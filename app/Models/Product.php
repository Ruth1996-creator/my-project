<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'productname',
        'description',
        'price',
        'user',
        'product_category',
        'reference'

    ];
    function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user");
    }
    function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, "product_category");
    }
    function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class, "classe")->with(["Division"]);
    }
}
