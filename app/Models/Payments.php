<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        "order_id",
        "method",
        "amount",
        "prove_img",
        "created_at",
    ];
    
    public function orders()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
}
