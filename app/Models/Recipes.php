<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipes extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'name_en',
        'image',
        'content',
        'content_en',
        'category_id',
        'likes_count',
        'record_count',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function popularRecipes()
    {
        return $this->hasOne(PopularRecipes::class);
    }
    public function favorites()
    {
        return $this->hasMany(CustomerFavoriteRecipes::class);
    }
}
