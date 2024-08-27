<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tokens extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'token',
        'expires_at',
    ];

    /**
     * Get the customer that owns the token.
     */
    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }
}
