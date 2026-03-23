<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
public function index()
{
$wishlist = session()->get('wishlist', []);
return view('wishlist', compact('wishlist'));
}

public function add(Request $request)
{
$request->validate([
'product_id' => 'required',
'name' => 'required|string',
'price' => 'required|numeric',
'image' => 'nullable|string',
'slug' => 'nullable|string',
]);

$wishlist = session()->get('wishlist', []);

$productId = $request->product_id;

if (!isset($wishlist[$productId])) {
$wishlist[$productId] = [
'product_id' => $request->product_id,
'name' => $request->name,
'price' => (float) $request->price,
'image' => $request->image,
'slug' => $request->slug,
];

session()->put('wishlist', $wishlist);
}

return response()->json([
'success' => true,
'message' => 'Added to wishlist.',
'wishlist_count' => count($wishlist),
]);
}

public function remove(Request $request)
{
$request->validate([
'product_id' => 'required',
]);

$wishlist = session()->get('wishlist', []);
unset($wishlist[$request->product_id]);
session()->put('wishlist', $wishlist);

return response()->json([
'success' => true,
'message' => 'Removed from wishlist.',
'wishlist_count' => count($wishlist),
]);
}
}
