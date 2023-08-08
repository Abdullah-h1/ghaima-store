<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    protected $table = 'colors';

    protected $fillable = [
        "name",
        "code",
    ];

    public function products()
    {
        return $this->belongsToMany(Products::class,
                                    'products_color',
                                    'product_id',
                                    'color_id');
    }
}
