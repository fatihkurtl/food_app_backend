<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFavoriteRecipes extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'recipe_id'
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipes::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }
}
