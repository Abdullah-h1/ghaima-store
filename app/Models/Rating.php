<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'products_rating';
    public function products()
    {
        return $this->belongsTo(Products::class,'product_id');
    }
}
