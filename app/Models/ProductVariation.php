<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    public $timestamps = true;

    public $primaryKey = 'product_variation_id';

    protected $fillable = [
        'product_variation_id',
        'product_id',
        'title',
        'description',
        'price',
        'discount_percent',
        'currency_code',
        'category_id',
        'created_at',
        'updated_at'
    ];

    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
}
