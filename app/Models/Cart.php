<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'status',
        'created_at',
        'updated_at'
    ];

    public function cartProducts()
    {
        return $this->hasMany('App\Models\CartProduct', 'cart_id', 'id');
    }
}
