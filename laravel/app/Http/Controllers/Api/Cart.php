<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Cart extends Controller
{
    public function index(Request $request)
    {
        [$userId, $authError] = $this->getAuthenticatedUserId($request);
        if ($authError) {
            return $authError;
        }

        try {
            $cart = DB::table('carts')
                ->select('cart_id')
                ->where('user_id', $userId)
                ->orderByDesc('created_at')
                ->first();

            if (!$cart) {
                return response()->json([
                    'cartId' => null,
                    'items' => []
                ]);
            }

            $items = DB::table('cart_items as ci')
                ->join('products as p', 'ci.product_id', '=', 'p.product_id')
                ->select(
                    'ci.cart_item_id',
                    'ci.quantity',
                    'ci.unit_price',
                    'ci.line_total',
                    'p.product_id',
                    'p.name'
                )
                ->where('ci.cart_id', $cart->cart_id)
                ->get();

            return response()->json([
                'cartId' => $cart->cart_id,
                'items' => $items
            ]);
        } catch (\Exception $err) {
            \Log::error('Error loading cart: ' . $err->getMessage());

            return response()->json([
                'error' => 'Server error while loading cart'
            ], 500);
        }
    }

    public function add(Request $request)
    {
        [$userId, $authError] = $this->getAuthenticatedUserId($request);
        if ($authError) {
            return $authError;
        }

        $productId = $request->input('productId');
        $quantity = $request->input('quantity');

        if (!$productId || !$quantity) {
            return response()->json([
                'error' => 'productId and quantity are required'
            ], 400);
        }

        $qtyToAdd = (int) $quantity;

        try {
            $existingCart = DB::table('carts')
                ->select('cart_id')
                ->where('user_id', $userId)
                ->orderByDesc('created_at')
                ->first();

            if ($existingCart) {
                $cartId = $existingCart->cart_id;
            } else {
                $cartId = (string) Str::uuid();

                DB::table('carts')->insert([
                    'cart_id' => $cartId,
                    'user_id' => $userId,
                ]);
            }

            $product = DB::table('products')
                ->select('base_price')
                ->where('product_id', $productId)
                ->first();

            if (!$product) {
                return response()->json([
                    'error' => 'Invalid productId'
                ], 400);
            }

            $unitPrice = (float) $product->base_price;

            $existingItem = DB::table('cart_items')
                ->select('cart_item_id', 'quantity')
                ->where('cart_id', $cartId)
                ->where('product_id', $productId)
                ->first();

            if ($existingItem) {
                $newQty = ((int) $existingItem->quantity) + $qtyToAdd;
                $newLineTotal = $unitPrice * $newQty;

                DB::table('cart_items')
                    ->where('cart_item_id', $existingItem->cart_item_id)
                    ->update([
                        'quantity' => $newQty,
                        'line_total' => $newLineTotal,
                    ]);

                return response()->json([
                    'message' => 'Cart item updated',
                    'cartId' => $cartId,
                    'cart_item_id' => $existingItem->cart_item_id,
                    'quantity' => $newQty,
                ]);
            }

            $cartItemId = (string) Str::uuid();
            $lineTotal = $unitPrice * $qtyToAdd;

            DB::table('cart_items')->insert([
                'cart_item_id' => $cartItemId,
                'cart_id' => $cartId,
                'product_id' => $productId,
                'quantity' => $qtyToAdd,
                'unit_price' => $unitPrice,
                'line_total' => $lineTotal,
            ]);

            return response()->json([
                'message' => 'Added to cart',
                'cartId' => $cartId,
                'cart_item_id' => $cartItemId,
                'quantity' => $qtyToAdd,
            ]);
        } catch (\Exception $err) {
            \Log::error('Error adding to cart: ' . $err->getMessage());

            return response()->json([
                'error' => 'Server error while adding to cart'
            ], 500);
        }
    }

    public function update(Request $request, $cartItemId)
    {
        [$userId, $authError] = $this->getAuthenticatedUserId($request);
        if ($authError) {
            return $authError;
        }

        $quantity = $request->input('quantity');

        if (!$quantity || $quantity < 1) {
            return response()->json([
                'error' => 'Quantity must be >= 1'
            ], 400);
        }

        try {
            $row = DB::table('cart_items')
                ->select('unit_price')
                ->where('cart_item_id', $cartItemId)
                ->first();

            if (!$row) {
                return response()->json([
                    'error' => 'Cart item not found'
                ], 404);
            }

            $unitPrice = (float) $row->unit_price;
            $qty = (int) $quantity;
            $lineTotal = $unitPrice * $qty;

            $updated = DB::table('cart_items')
                ->where('cart_item_id', $cartItemId)
                ->update([
                    'quantity' => $qty,
                    'line_total' => $lineTotal,
                ]);

            if ($updated === 0) {
                return response()->json([
                    'error' => 'Cart item not found'
                ], 404);
            }

            return response()->json([
                'message' => 'Quantity updated'
            ]);
        } catch (\Exception $err) {
            \Log::error('Error updating cart item: ' . $err->getMessage());

            return response()->json([
                'error' => 'Server error while updating cart item'
            ], 500);
        }
    }

    public function remove(Request $request, $cartItemId)
    {
        [$userId, $authError] = $this->getAuthenticatedUserId($request);
        if ($authError) {
            return $authError;
        }

        try {
            $deleted = DB::table('cart_items')
                ->where('cart_item_id', $cartItemId)
                ->delete();

            if ($deleted === 0) {
                return response()->json([
                    'error' => 'Cart item not found'
                ], 404);
            }

            return response()->json([
                'message' => 'Item removed from cart'
            ]);
        } catch (\Exception $err) {
            \Log::error('Error removing cart item: ' . $err->getMessage());

            return response()->json([
                'error' => 'Server error while removing cart item'
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