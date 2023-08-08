<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{

    protected $table = 'add_to_cart';

    protected $fillable = [
        "customer_id",
        "product_id",
        "quantity",
        "product_size",
        "product_color",
        "price",
    ];


    public function products()
    {
        return $this->belongsTo(Products::class,'product_id');
    }
}
