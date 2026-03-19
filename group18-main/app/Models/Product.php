<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'image_url',
        'brand',
        'category_id',
        'stock_quantity',
        'is_active',
    ];
}