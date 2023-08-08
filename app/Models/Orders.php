<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        "customer_id",
        "total_price",
        "order_status",
        "address_id",
        "currency",
        "created_at",
    ];
    
    public function customers()
    {
        return $this->belongsTo(Customers::class,'customer_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }
    
    public function addresses()
    {
        return $this->belongsTo(Addresses::class, 'address_id');
    }
    
    public function payments()
    {
        return $this->hasOne(Payments::class, 'order_id');
    }
}
