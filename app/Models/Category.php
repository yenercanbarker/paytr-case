<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'title',
        'created_at',
        'updated_at'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\CategoryProduct', 'category_id', 'id');
    }
}
