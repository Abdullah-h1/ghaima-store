<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    protected $table = 'customer_address';

    protected $fillable = [
        "address_type",
        "address",
        "latitude",
        "longitude",
        "customer_id",
        "contact_customer_number",
        "contact_customer_name",
    ];

    public function customers()
    {
        return $this->belongsTo(Customers::class,'customer_id');
    }

    public function orders()
    {
        return $this->hasMany(Orders::class, 'address_id');
    }

}
