<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;

Route::post('/checkout', function (\Illuminate\Http\Request $request) {
$request->validate([
'nameOnCard' => 'required|string|max:255',
'numberOnCard' => 'required|string|max:50',
'expiry' => 'required|string|max:10',
'cvv' => 'required|string|max:10',
'promo_code' => 'nullable|string|max:50',
]);

$cart = session()->get('cart', []);

if (empty($cart)) {
return response()->json([
'success' => false,
'message' => 'Your basket is empty.'
], 400);
}

session()->forget('cart');
session()->save();

return response()->json([
'success' => true,
'message' => 'Order placed successfully.'
]);
})->name('checkout');


Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');

Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/inventory', [AdminController::class, 'inventory'])->name('admin.inventory');
});

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('/', [ProductController::class, 'home'])->name('home');
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

Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::post('/admin/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
Route::get('/admin/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
Route::put('/admin/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
Route::delete('/admin/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');