<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // 🔹 HOMEPAGE
    public function home()
    {
        $featuredRackets = Product::where('category_id', '352883ba-cd3f-11f0-982a-005056b707be')
            ->where('is_active', 1)
            ->limit(3)
            ->get();

        $featuredBalls = Product::where('category_id', 'e6660920-cf7e-11f0-a24b-005056b707be')
            ->where('is_active', 1)
            ->limit(3)
            ->get();

        $featuredSportswear = Product::where('category_id', 'e6660501-cf7e-11f0-a24b-005056b707be')
            ->where('is_active', 1)
            ->limit(3)
            ->get();

        return view('home', compact('featuredRackets', 'featuredBalls', 'featuredSportswear'));
    }

    // 🔹 PRODUCT DETAILS PAGE
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $reviews = DB::table('reviews')
            ->where('product_id', $product->product_id)
            ->get();

        return view('product-details', compact('product', 'reviews'));
    }

    // 🔹 CATEGORY PAGES
    public function rackets()
    {
        $products = Product::where('category_id', '352883ba-cd3f-11f0-982a-005056b707be')
            ->where('is_active', 1)
            ->get();

        return view('rackets', compact('products'));
    }

    public function sportswear()
    {
        $products = Product::where('category_id', 'e6660501-cf7e-11f0-a24b-005056b707be')
            ->where('is_active', 1)
            ->get();

        return view('sportswear', compact('products'));
    }

   

    public function balls()
    {
        $products = Product::where('category_id', 'e6660920-cf7e-11f0-a24b-005056b707be')
            ->where('is_active', 1)
            ->get();

        return view('balls', compact('products'));
    }
public function shoes()
{
    $products = Product::where('category_id', 'e6660a4e-cf7e-11f0-a24b-005056b707be')
        ->where('is_active', 1)
        ->get();

    return view('shoes', compact('products'));
}

public function bags()
{
    $products = Product::where('category_id', 'e6660af2-cf7e-11f0-a24b-005056b707be')
        ->where('is_active', 1)
        ->get();

    return view('bags', compact('products'));
}
 
}