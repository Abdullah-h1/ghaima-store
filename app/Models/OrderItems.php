<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        "order_id",
        "product_id",
        "quantity",
        "product_size",
        "product_color",
        "price",
        "sar_price",
    ];
    
    public function products()
    {
        return $this->belongsTo(Products::class,'product_id');
    }
    
    public function orders()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }

    public function addresses()
    {
        return $this->belongsTo(Addresses::class, 'address_id');
    }
}
