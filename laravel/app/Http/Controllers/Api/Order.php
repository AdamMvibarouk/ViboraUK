<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Order extends Controller
{
    public function index(Request $request)
    {
        [$userId, $authError] = $this->getAuthenticatedUserId($request);
        if ($authError) {
            return $authError;
        }

        try {
            $rows = DB::table('orders as o')
                ->join('order_items as oi', 'o.order_id', '=', 'oi.order_id')
                ->select(
                    'o.order_id as orderId',
                    'o.order_number as orderNumber',
                    'o.status as status',
                    'o.subtotal as subtotal',
                    'o.discount_total as discountTotal',
                    'o.tax_total as taxTotal',
                    'o.shipping_total as shippingTotal',
                    'o.grand_total as grandTotal',
                    'o.placed_at as placedAt',
                    'oi.order_item_id as orderItemId',
                    'oi.variant_id as productId',
                    'oi.quantity as quantity',
                    'oi.unit_price as unitPrice',
                    'oi.line_total as lineTotal'
                )
                ->where('o.user_id', $userId)
                ->orderByDesc('o.placed_at')
                ->orderByDesc('o.order_id')
                ->get();

            $ordersById = [];

            foreach ($rows as $row) {
                if (!isset($ordersById[$row->orderId])) {
                    $ordersById[$row->orderId] = [
                        'order_id' => $row->orderId,
                        'order_number' => $row->orderNumber,
                        'status' => $row->status,
                        'subtotal' => $row->subtotal,
                        'discount_total' => $row->discountTotal,
                        'tax_total' => $row->taxTotal,
                        'shipping_total' => $row->shippingTotal,
                        'grand_total' => $row->grandTotal,
                        'placed_at' => $row->placedAt,
                        'items' => [],
                    ];
                }

                $ordersById[$row->orderId]['items'][] = [
                    'order_item_id' => $row->orderItemId,
                    'product_id' => $row->productId,
                    'quantity' => $row->quantity,
                    'unit_price' => $row->unitPrice,
                    'line_total' => $row->lineTotal,
                ];
            }

            return response()->json([
                'orders' => array_values($ordersById)
            ]);
        } catch (\Exception $err) {
            \Log::error('Error fetching past orders: ' . $err->getMessage());

            return response()->json([
                'message' => 'Server error while fetching past orders'
            ], 500);
        }
    }

    public function checkout(Request $request)
    {
        [$userId, $authError] = $this->getAuthenticatedUserId($request);
        if ($authError) {
            return $authError;
        }

        try {
            $cart = DB::table('carts')
                ->where('user_id', $userId)
                ->orderByDesc('created_at')
                ->first();

            if (!$cart) {
                return response()->json([
                    'error' => 'No basket found for this user'
                ], 400);
            }

            $cartId = $cart->cart_id;

            $items = DB::table('cart_items')
                ->select('cart_item_id', 'product_id', 'quantity', 'unit_price', 'line_total')
                ->where('cart_id', $cartId)
                ->get();

            if ($items->isEmpty()) {
                return response()->json([
                    'error' => 'Your basket is empty'
                ], 400);
            }

            $subtotal = 0;

            foreach ($items as $item) {
                $lineTotal = $item->line_total ?? ((float) $item->unit_price * (int) $item->quantity);
                $subtotal += (float) $lineTotal;
            }

            $pastOrder = DB::table('orders')
                ->select('order_id')
                ->where('user_id', $userId)
                ->first();

            $isNewCustomer = !$pastOrder;
            $discountRate = $isNewCustomer ? 0.1 : 0;
            $discountTotal = $subtotal * $discountRate;

            $taxableBase = $subtotal - $discountTotal;
            $taxTotal = $taxableBase * 0.2;
            $shippingTotal = 0.0;
            $grandTotal = $taxableBase + $taxTotal + $shippingTotal;

            $orderId = (string) Str::uuid();
            $orderNumber = 'ORD-' . time();

            DB::table('orders')->insert([
                'order_id' => $orderId,
                'user_id' => $userId,
                'order_number' => $orderNumber,
                'status' => 'paid',
                'subtotal' => $subtotal,
                'discount_total' => $discountTotal,
                'tax_total' => $taxTotal,
                'shipping_total' => $shippingTotal,
                'grand_total' => $grandTotal,
            ]);

            foreach ($items as $item) {
                $orderItemId = (string) Str::uuid();

                $unitPrice = (float) $item->unit_price;
                $qty = (int) $item->quantity;
                $lineTotal = $unitPrice * $qty;

                $variantId = $item->product_id;

                DB::table('order_items')->insert([
                    'order_item_id' => $orderItemId,
                    'order_id' => $orderId,
                    'variant_id' => $variantId,
                    'quantity' => $qty,
                    'unit_price' => $unitPrice,
                    'line_total' => $lineTotal,
                ]);
            }

            DB::table('cart_items')
                ->where('cart_id', $cartId)
                ->delete();

            return response()->json([
                'message' => 'Your order has been processed. You will receive a confirmation email shortly.',
                'orderId' => $orderId,
                'orderNumber' => $orderNumber,
                'subtotal' => $subtotal,
                'discountApplied' => $isNewCustomer,
                'discountTotal' => $discountTotal,
                'taxTotal' => $taxTotal,
                'grandTotal' => $grandTotal,
            ]);
        } catch (\Exception $err) {
            \Log::error('checkout error: ' . $err->getMessage());

            return response()->json([
                'error' => 'Server error while processing your order'
            ], 500);
        }
    }

    private function getAuthenticatedUserId(Request $request): array
    {
        $token = $request->bearerToken();

        if (!$token) {
            return [null, response()->json([
                'message' => 'No token provided'
            ], 401)];
        }

        $payload = $this->verifyJwt($token);

        if (!$payload || empty($payload['id'])) {
            return [null, response()->json([
                'message' => 'Invalid or expired token'
            ], 401)];
        }

        return [$payload['id'], null];
    }

    private function verifyJwt(string $token): ?array
    {
        $parts = explode('.', $token);

        if (count($parts) !== 3) {
            return null;
        }

        [$headerEncoded, $payloadEncoded, $signatureEncoded] = $parts;

        $expectedSignature = $this->base64UrlEncode(
            hash_hmac(
                'sha256',
                $headerEncoded . '.' . $payloadEncoded,
                config('app.key'),
                true
            )
        );

        if (!hash_equals($expectedSignature, $signatureEncoded)) {
            return null;
        }

        $payload = json_decode($this->base64UrlDecode($payloadEncoded), true);

        if (!$payload) {
            return null;
        }

        if (!empty($payload['exp']) && time() > $payload['exp']) {
            return null;
        }

        return $payload;
    }

    private function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64UrlDecode(string $data): string
    {
        $remainder = strlen($data) % 4;

        if ($remainder) {
            $data .= str_repeat('=', 4 - $remainder);
        }

        return base64_decode(strtr($data, '-_', '+/'));
    }
}