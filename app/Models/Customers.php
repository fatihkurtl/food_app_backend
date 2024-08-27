<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'profile_photo_path',
        'email',
        'password',
        'gender',
        'age',
    ];

    protected $hidden = [
        'password',
    ];

    public function tokens()
    {
        return $this->hasMany(Tokens::class);
    }

    public function favoriteRecipes()
    {
        return $this->hasMany(CustomerFavoriteRecipes::class);
    }
}
