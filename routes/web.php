<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;



Route::view('/', 'home');
Route::view('/basket', 'basket');
Route::view('/about', 'about');
Route::view('/contact', 'contact');
Route::view('/services', 'services');

Route::view('/terms', 'terms');
Route::view('/privacy-policy', 'privacy-policy');
Route::view('/cookies', 'cookies');
Route::view('/delivery-information', 'delivery-information');
Route::view('/returns', 'returns');



Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');

Route::get('/account', [AuthController::class, 'showAccount'])->name('account');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::post('/account/profile-picture', [AuthController::class, 'uploadProfilePicture'])
    ->name('profile.picture.upload');



Route::get('/rackets', [ProductController::class, 'rackets'])->name('rackets');

Route::get('/sportswear', [ProductController::class, 'sportswear'])->name('sportswear');

Route::get('/shoes', [ProductController::class, 'shoes'])->name('shoes');

Route::get('/balls', [ProductController::class, 'balls'])->name('balls');

Route::get('/bags', [ProductController::class, 'bags'])->name('bags');