<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'created_at',
        'updated_at',
    ];

    public function variations()
    {
        return $this->hasOne('App\Models\ProductVariation', 'product_id', 'id')->latest();
    }
}