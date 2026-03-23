<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'product_id',
        'category_id',
        'name',
        'slug',
        'description',
        'image_url',
        'base_price',
        'is_active',
        'product_url',
    ];

    public $timestamps = false;
}