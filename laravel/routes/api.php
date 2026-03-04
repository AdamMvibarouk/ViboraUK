<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Product;
use App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Api\Cart;
use App\Http\Controllers\Api\Order;

Route::get('/products', [Product::class, 'index']);
Route::get('/products/{id}', [Product::class, 'show']);

Route::prefix('auth')->group(function () {
    Route::post('/register', [Auth::class, 'register']);
    Route::post('/login', [Auth::class, 'login']);
    Route::get('/profile', [Auth::class, 'profile']);
});

Route::prefix('cart')->group(function () {
    Route::get('/', [Cart::class, 'index']);
    Route::post('/add', [Cart::class, 'add']);
    Route::patch('/update/{cartItemId}', [Cart::class, 'update']);
    Route::delete('/remove/{cartItemId}', [Cart::class, 'remove']);
});

Route::prefix('orders')->group(function () {
    Route::get('/', [Order::class, 'index']);
    Route::post('/checkout', [Order::class, 'checkout']);
});