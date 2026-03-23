@extends('layouts.app')

@section('title', $product->name ?? 'Product Details')

@section('head')
<link rel="stylesheet" href="{{ asset('css/product-details.css') }}">
@endsection

@section('content')

<header id="main-header">
    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/Vibora_UK_logo.png') }}" alt="Vibora UK logo">
            <span>VIBORA UK</span>
        </a>
    </div>

    <nav>
        <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/rackets') }}">Rackets</a></li>
            <li><a href="{{ url('/sportswear') }}">Sportswear</a></li>
            <li class="dropdown">
                <a href="#">More</a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/bags') }}">Bags</a></li>
                    <li><a href="{{ url('/shoes') }}">Shoes</a></li>
                    <li><a href="{{ url('/balls') }}">Balls</a></li>
                    <li><a href="{{ url('/services') }}">Services</a></li>
                    <li><a href="{{ url('/reviews') }}">Reviews</a></li>
                    <li><a href="{{ route('admin.login') }}">ADMIN</a></li>
                </ul>
            </li>
            <li><a href="{{ url('/about') }}">About Us</a></li>
            <li><a href="{{ url('/contact') }}">Contact</a></li>
        </ul>
    </nav>

    <div class="login">
        <a href="{{ url('/basket') }}" class="basket-link">
            <img src="{{ asset('images/shopping-basket-icon-png-3309830814.png') }}" class="basket-icon" alt="Basket">
        </a>

        @auth
            <a href="{{ url('/account') }}" class="login-btn">My Account</a>
        @else
            <a href="{{ url('/account') }}" class="login-btn">Login</a>
        @endauth
    </div>
</header>

@php
    $productId = $product->id ?? $product->product_id ?? $product->slug;
    $slug = $product->slug ?? '';
    $imageFile = $product->image_url ?? '';

    $racketSlugImageMap = [
        'babolat-x-lamborghini-bl002-scandal-green' => 'BABOLAT X LAMBORGHINI BL002 SCANDAL GREEN.jpg',
        'babolat-air-origin' => 'BABOLAT AIR ORIGIN.jpg',
        'mirage-25-padel-racket' => 'Mirage-Front-2655789586.jpg',
        'panna-25-padel-racket' => 'Panna TF Padel Racket.jpg',
        'pro-x-25-padel-racket' => 'pro-x-25-padel-racket.jpeg',
        'arlo-25-padel-racket' => 'Arlo Padel Racket.jpg',
        'bullpadel-vertex-04-25' => 'RACKET BULLPADEL VERTEX 04 25.jpg',
        'bullpadel-vertex-04-mx-24' => 'RACKET BULLPADEL VERTEX 04 MX 24.jpg',
        'bullpadel-pearl-25' => 'bullpadel-pearl-25.jpeg',
        'bullpadel-vertex-jr-25' => 'bullpadel-vertex-jr-25.jpeg',
        'head-evo-extreme-2025' => 'HEAD EVO EXTREME 2025.jpg',
        'head-speed-motion-2025' => 'head-speed-motion-2025.jpeg',
        'nox-at10-genius-18k-alum-2026' => 'nox-at10-genius-18k-alum-2026.jpeg',
        'nox-x-one-casual-series-23' => 'nox-x-one-casual-series-23.jpeg',
    ];

    $bagCategoryId = 'e6660af2-cf7e-11f0-a24b-005056b707be';
    $shoeCategoryId = 'e6660a4e-cf7e-11f0-a24b-005056b707be';
    $sportswearCategoryId = 'e6660501-cf7e-11f0-a24b-005056b707be';
    $racketsCategoryId = '352883ba-cd3f-11f0-982a-005056b707be';
    $ballsCategoryId = 'e6660920-cf7e-11f0-a24b-005056b707be';

    if (($product->category_id ?? null) === $racketsCategoryId || array_key_exists($slug, $racketSlugImageMap)) {
        $category = 'rackets';
        $imageFile = $racketSlugImageMap[$slug] ?? $imageFile;
    } elseif (($product->category_id ?? null) === $sportswearCategoryId) {
        $category = 'tshirts';
    } elseif (($product->category_id ?? null) === $shoeCategoryId) {
        $category = 'shoes';
    } elseif (($product->category_id ?? null) === $bagCategoryId) {
        $category = 'bags';
    } elseif (($product->category_id ?? null) === $ballsCategoryId) {
        $category = 'balls';
    } else {
        $category = 'images';
        $imageFile = 'Vibora_UK_logo.png';
    }
@endphp

<div class="product-page">
    <div class="product-page-card">
        <div class="product-page-image">
            <img
                src="{{ asset('products/' . $category . '/' . rawurlencode($imageFile)) }}"
                alt="{{ $product->name }}"
                onerror="this.onerror=null;this.src='{{ asset('images/Vibora_UK_logo.png') }}';"
            >
        </div>

        <div class="product-page-info">
            <h1>{{ $product->name }}</h1>

            <p class="product-page-description">
                {{ $product->description ?? 'No description available yet.' }}
            </p>

            <ul class="product-page-meta">
                <li><strong>Brand:</strong> {{ $product->brand ?? 'Vibora' }}</li>
                <li><strong>Availability:</strong> {{ ($product->stock ?? 1) > 0 ? 'In stock' : 'Out of stock' }}</li>
                <li><strong>Slug:</strong> {{ $product->slug }}</li>
            </ul>

            <div class="product-page-price">
                £{{ number_format((float) $product->base_price, 2) }}
            </div>

            <button
                type="button"
                class="add-cart-btn"
                data-product-id="{{ $productId }}"
                data-product-name="{{ $product->name }}"
                data-product-price="{{ (float) $product->base_price }}"
            >
                Add to Basket
            </button>
        </div>
    </div>
</div>

<div class="product-reviews-section" style="max-width: 1000px; margin: 40px auto; padding: 20px;">
    <h2>Product Reviews</h2>

    @if(session('success'))
        <div style="background:#dff0d8; color:#3c763d; padding:12px; border-radius:8px; margin:15px 0;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background:#f2dede; color:#a94442; padding:12px; border-radius:8px; margin:15px 0;">
            <ul style="margin:0; padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reviews.store') }}" method="POST" style="display:flex; flex-direction:column; gap:15px; margin:25px 0;">
        @csrf

        <input type="hidden" name="product_id" value="{{ $product->product_id ?? $product->id }}">

        <input type="text" name="title" placeholder="Review title" required>

        <select name="rating" required>
            <option value="">Select Rating</option>
            <option value="5">5 - Excellent</option>
            <option value="4">4 - Very Good</option>
            <option value="3">3 - Good</option>
            <option value="2">2 - Fair</option>
            <option value="1">1 - Poor</option>
        </select>

        <textarea name="body" rows="5" placeholder="Write your review here..." required></textarea>

        <button type="submit" class="add-cart-btn" style="max-width:220px;">
            Submit Review
        </button>
    </form>

    @forelse($reviews ?? [] as $review)
    <div class="review-card">
        <h3>{{ $review->title }}</h3>

        <p class="review-rating">
            Rating: {{ $review->rating }}/5
        </p>

        <p class="review-body">
            {{ $review->body }}
        </p>

        <p class="review-date">
            {{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}
        </p>
    </div>
@empty
    <p>No reviews for this product yet.</p>
@endforelse
       
</div>
<footer>
    <h5>@ ViboraUK Ltd</h5>
    <div class="credentials">
        <h6><a href="{{ url('/terms') }}">Terms and Conditions</a></h6>
        <h6><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></h6>
        <h6><a href="{{ url('/cookies') }}">Cookies</a></h6>
        <h6><a href="{{ url('/delivery-information') }}">Delivery Information</a></h6>
        <h6><a href="{{ url('/returns') }}">Returns</a></h6>
        <h6><a href="{{ url('/contact') }}">Contact</a></h6>
    </div>
</footer>

@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    const button = document.querySelector(".add-cart-btn");
    if (!button) return;

    if (button.dataset.boundCart === "true") return;
    button.dataset.boundCart = "true";

    button.addEventListener("click", async () => {
        const productId = button.getAttribute("data-product-id");
        const productName = button.getAttribute("data-product-name");
        const productPrice = button.getAttribute("data-product-price");

        try {
            const res = await fetch("/cart/add", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute("content"),
                    "Accept": "application/json"
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    product_id: productId,
                    name: productName,
                    price: Number(productPrice),
                    quantity: 1
                })
            });

            let data = {};
            try {
                data = await res.json();
            } catch (e) {}

            if (!res.ok || !data.success) {
                alert(data.message || "Failed to add item to basket.");
                return;
            }

            alert(productName + " added to basket.");
        } catch (err) {
            console.error("Add to basket error:", err);
            alert("There was a problem adding this item to the basket.");
        }
    });
});
</script>
@endsection