<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $fillable = [
        'id',
        'name',
        'email',
        'avatar',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function addresses()
    {
        return $this->hasOne(Addresses::class,'customer_id');
    }

    public function orders()
    {
        return $this->hasOne(Orders::class,'customer_id');
    }

    public function products()
    {
        return $this->belongsToMany(Products::class,
                                    'favorite',
                                    'product_id',
                                    'customer_id');
    }


}
