<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
public function store(Request $request)
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
'message' => 'Your basket is empty.'
], 400);
}

$subtotal = 0;
foreach ($cart as $item) {
$subtotal += ((float) $item['price']) * ((int) $item['quantity']);
}

$promoCode = strtoupper(trim($request->promo_code ?? ''));
$discountTotal = 0;

if ($promoCode === 'VIBORA10') {
$discountTotal = round($subtotal * 0.10, 2);
}

$shippingTotal = $subtotal >= 50 ? 0 : 4.99;
$taxTotal = 0;
$grandTotal = round($subtotal - $discountTotal + $shippingTotal + $taxTotal, 2);

DB::beginTransaction();

try {
$orderId = (string) Str::uuid();
$orderNumber = 'ORD-' . time() . rand(100, 999);

DB::table('orders')->insert([
'order_id' => $orderId,
'user_id' => auth()->id(),
'order_number' => $orderNumber,
'status' => 'paid',
'subtotal' => $subtotal,
'discount_total' => $discountTotal,
'tax_total' => $taxTotal,
'shipping_total' => $shippingTotal,
'grand_total' => $grandTotal,
'placed_at' => now(),
]);

foreach ($cart as $item) {
DB::table('order_items')->insert([
'order_item_id' => (string) Str::uuid(),
'order_id' => $orderId,
'variant_id' => null,
'quantity' => (int) $item['quantity'],
'unit_price' => (float) $item['price'],
'line_total' => ((float) $item['price']) * ((int) $item['quantity']),
]);
}

session()->forget('cart');
session()->save();

DB::commit();

return response()->json([
'success' => true,
'message' => 'Order placed successfully.',
'order_id' => $orderId,
'order_number' => $orderNumber,
]);
} catch (\Throwable $e) {
DB::rollBack();

return response()->json([
'success' => false,
'message' => 'Checkout failed.',
'error' => $e->getMessage(),
], 500);
}
}
}
