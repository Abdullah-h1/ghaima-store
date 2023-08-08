<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sizes extends Model
{
    public function products()
    {
        return $this->belongsToMany(Products::class,
                                    'products_size',
                                    'size_id',
                                    'product_id');
    }
}
