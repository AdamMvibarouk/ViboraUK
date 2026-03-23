<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'review_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'review_id',
        'user_id',
        'product_id',
        'rating',
        'title',
        'body',
        'is_verified_purchase',
        'created_at',
    ];
}