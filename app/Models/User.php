<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category',
        'type',
        'username',
        'password',
        'enseigne',
        "indication",
        'phone',
        'sexe',
        'photo',
        "annee",
        "email",
        "pays_id",
        "quatier",
        "arrondissement_id",
        "commune_id"

        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class, "category");
    }
    function Typeuser(): BelongsTo
    {
        return $this->belongsTo(Typeuser::class, "type_user");
    }
    function Products(): HasMany
    {
        return $this->hasMany(Product::class, "user");
    }
    function Likes(): HasMany
    {
        return $this->hasMany(Like::class, "user");
    }
    
    function pays(): BelongsTo
    {
        return $this->belongsTo(Pays::class, "pays_id")->with(["communes"]);
    }
    function arrondissement(): BelongsTo
    {
        return $this->belongsTo(Arrondissement::class, "arrondissement_id");
    }function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class, "commune_id");
    }
}
