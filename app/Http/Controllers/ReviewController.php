<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::whereNull('product_id')
            ->latest('created_at')
            ->get();

        return view('reviews', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:2000',
            'product_id' => 'nullable|string',
        ]);

        Review::create([
            'review_id' => (string) Str::uuid(),
            'user_id' => Auth::check() ? Auth::user()->user_id : null,
            'product_id' => $request->product_id ?: null,
            'rating' => $request->rating,
            'title' => $request->title,
            'body' => $request->body,
            'is_verified_purchase' => 0,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Review submitted successfully.');
    }
}