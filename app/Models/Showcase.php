<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showcase extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
    ];
}