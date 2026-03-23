<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
public function add(Request $request)
{
$request->validate([
'product_id' => 'required',
'name' => 'required|string',
'price' => 'required|numeric',
'quantity' => 'required|integer|min:1',
]);

$cart = session()->get('cart', []);
$productId = (string) $request->product_id;

if (isset($cart[$productId])) {
$cart[$productId]['quantity'] += (int) $request->quantity;
} else {
$cart[$productId] = [
'product_id' => $productId,
'name' => $request->name,
'price' => (float) $request->price,
'quantity' => (int) $request->quantity,
];
}

session()->put('cart', $cart);
session()->save();

return response()->json([
'success' => true,
'message' => 'Item added to basket.',
'items' => array_values($cart),
'count' => count($cart),
]);
}

public function items()
{
$cart = session()->get('cart', []);

return response()->json([
'success' => true,
'items' => array_values($cart),
'count' => count($cart),
]);
}

public function remove(Request $request)
{
$request->validate([
'product_id' => 'required',
]);

$cart = session()->get('cart', []);
$productId = (string) $request->product_id;

if (isset($cart[$productId])) {
unset($cart[$productId]);
session()->put('cart', $cart);
session()->save();
}

return response()->json([
'success' => true,
'message' => 'Item removed from basket.',
'items' => array_values($cart),
'count' => count($cart),
]);
}

public function checkout(Request $request)
{
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
'message' => 'Your basket is empty.',
], 400);
}

session()->forget('cart');
session()->save();

return response()->json([
'success' => true,
'message' => 'Order placed successfully.',
]);
}
}
