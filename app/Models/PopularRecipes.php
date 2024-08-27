<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopularRecipes extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipes::class);
    }
}
