<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Product extends Controller
{
    public function index(Request $request)
    {
        try {
            $categoryId = $request->query('category_id');

            $query = DB::table('products')
                ->select(
                    'product_id',
                    'category_id',
                    'name',
                    'slug',
                    'base_price',
                    'description'
                );

            if ($categoryId) {
                $query->where('category_id', $categoryId);
            }

            return response()->json($query->get());
        } catch (\Exception $err) {
            \Log::error('PRODUCT QUERY ERROR: ' . $err->getMessage());
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $row = DB::table('products')
                ->select(
                    'product_id',
                    'category_id',
                    'name',
                    'slug',
                    'base_price',
                    'description'
                )
                ->where('product_id', $id)
                ->first();

            if (!$row) {
                return response()->json(['error' => 'Product not found'], 404);
            }

            return response()->json($row);
        } catch (\Exception $err) {
            \Log::error('PRODUCT DETAIL ERROR: ' . $err->getMessage());
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }
}