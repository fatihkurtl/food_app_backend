<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'name_en',
        'image',
        // 'recipes_id',
    ];

    public function recipes()
    {
        return $this->hasMany(Recipes::class, 'category_id');
    }
}
