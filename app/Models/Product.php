<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes , HasFactory;
    
    protected $fillable = [
        'name',
        'images',
        'description',
        'price',
        'quantity',
        'status',
    ];
    // define the attributes that should be cast to native types
    protected $casts = [
        'images' => 'array',
        'price' => 'float',
        'quantity' => 'integer',
    ];
}
