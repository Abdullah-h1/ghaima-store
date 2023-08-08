<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function colors()
    {
        return $this->belongsToMany(Colors::class,
                                    'products_color',
                                    'product_id',
                                    'color_id');
    }
    
    public function sizes()
    {
        return $this->belongsToMany(Sizes::class,
                                'products_size',
                                'product_id',
                                'size_id');
    }
    public function categories()
    {
        return $this->belongsToMany(Categories::class,
                                'product_categories',
                                'product_id',
                                'category_id');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class,'product_id');
    }
    
    public function carts()
    {
        return $this->hasMany(Carts::class, 'product_id');
    }
    
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'product_id');
    }

    public function galleries()
    {
        return $this->hasMany(Galleries::class,'product_id');
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class,'product_id');
    }

    public function customers()
    {
        return $this->belongsToMany(Customers::class,
                                    'favorite',
                                    'product_id',
                                    'customer_id');
    }
    
}
