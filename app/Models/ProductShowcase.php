<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShowcase extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'showcase_id'
    ];

    public function product() 
    {
        return $this->belongsTo('App\Models\ProductVariation', 'product_id', 'product_id');
    }

    public function showcase() 
    {
        return $this->belongsTo('App\Models\Showcase', 'showcase_id', 'id');
    }
}