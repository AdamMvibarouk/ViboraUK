<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function rackets()
    {
        $products = Product::where('category_id', '352883ba-cd3f-11f0-982a-005056b707be')->get();
        return view('rackets', compact('products'));
    }

    public function sportswear()
    {
        $products = Product::where('category_id', 'e6660501-cf7e-11f0-a24b-005056b707be')->get();
        return view('sportswear', compact('products'));
    }

    public function shoes()
    {
        $products = Product::where('category_id', 'e6660a4e-cf7e-11f0-a24b-005056b707be')->get();
        return view('shoes', compact('products'));
    }

    public function balls()
    {
        $products = Product::where('category_id', 'e6660920-cf7e-11f0-a24b-005056b707be')->get();
        return view('balls', compact('products'));
    }

    public function bags()
    {
        $products = Product::where('category_id', 'e6660af2-cf7e-11f0-a24b-005056b707be')->get();
        return view('bags', compact('products'));
    }
}