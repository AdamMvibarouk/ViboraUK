<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::view('/', 'home');
Route::view('/basket', 'basket');
Route::view('/signup', 'signup');
Route::view('/account', 'account');
Route::view('/about', 'about');
Route::view('/contact', 'contact');
Route::view('/bags', 'bags');
Route::view('/services', 'services');

Route::view('/terms', 'terms');
Route::view('/privacy-policy', 'privacy-policy');
Route::view('/cookies', 'cookies');
Route::view('/delivery-information', 'delivery-information');
Route::view('/returns', 'returns');

Route::get('/rackets', [ProductController::class, 'rackets'])->name('rackets');
Route::get('/sportswear', [ProductController::class, 'sportswear'])->name('sportswear');
Route::get('/shoes', [ProductController::class, 'shoes'])->name('shoes');
Route::get('/balls', [ProductController::class, 'balls'])->name('balls');
Route::get('/bags', [ProductController::class, 'bags'])->name('bags');