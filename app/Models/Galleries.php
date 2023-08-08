<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galleries extends Model
{
    protected $fillable = ['product_id', 'url'];
    public function products()
    {
        return $this->belongsTo(Products::class,'product_id');
    }
}
