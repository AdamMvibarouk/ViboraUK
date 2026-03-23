@extends('layouts.app')

@section('title', 'Rackets')

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
<li><a href="{{ url('/rackets') }}" class="active">Rackets</a></li>
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

<!-- ✅ FIXED NAVBAR ICONS -->
<div class="login">
<a href="{{ route('wishlist.index') }}" class="wishlist-link">
<img src="{{ asset('images/heart-icon.png') }}" class="wishlist-icon" alt="Wishlist">
</a>

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

<div class="page-title">
<h1>Rackets</h1>
</div>

<div class="searchbar">
<input type="text" id="searchInput" placeholder="Search Products">
<button id="searchBtn">OK</button>
</div>

<!-- ADDED BRAND FILTER -->
<div class="filter-container">
<div class="filter">
<label for="brands">Brand:</label>
<select id="brands">
<option value="all">All</option>
<option value="babolat">Babolat</option>
<option value="bullpadel">Bullpadel</option>
<option value="head">Head</option>
<option value="nox">NOX</option>
</select>
</div>

<div class="filter">
<label for="price">Price:</label>
<select name="price" id="price">
<option value="all">All</option>
<option value="under50">Under £50</option>
<option value="50to75">£50–75</option>
<option value="75to100">£75–100</option>
<option value="100to150">£100–150</option>
<option value="over150">£150+</option>
</select>
</div>

<div class="filter">
<label for="sortBy">Sort by:</label>
<select name="sortBy" id="sortBy">
<option value="default">Default</option>
<option value="name-asc">Name A–Z</option>
<option value="name-desc">Name Z–A</option>
<option value="price-asc">Price Low to High</option>
<option value="price-desc">Price High to Low</option>
</select>
</div>
</div>

<div class="products-container" id="productsContainer">
@forelse($products as $product)
@php
$productId = $product->product_id ?? $product->id ?? $product->slug;
$slug = $product->slug ?? '';

$slugImageMap = [
'babolat-x-lamborghini-bl002-scandal-green' => 'BABOLAT X LAMBORGHINI BL002 SCANDAL GREEN.jpg',
'babolat-air-origin' => 'BABOLAT AIR ORIGIN.jpg',
'mirage-25-padel-racket' => 'Mirage-Front-2655789586.jpg',
'panna-25-padel-racket' => 'Panna TF Padel Racket.jpg',
'pro-x-25-padel-racket' => 'pro-x-25-padel-racket.jpeg',
'arlo-25-padel-racket' => 'Arlo Padel Racket.jpg',
'bullpadel-vertex-04-25' => 'RACKET BULLPADEL VERTEX 04 25.jpg',
'bullpadel-vertex-04-mx-24' => 'RACKET BULLPADEL VERTEX 04 MX 24.jpg',
'bullpadel-vertex-jr-25' => 'bullpadel-vertex-jr-25.jpeg',
'head-evo-extreme-2025' => 'HEAD EVO EXTREME 2025.jpg',
'head-speed-motion-2025' => 'head-speed-motion-2025.jpeg',
'nox-at10-genius-18k-alum-2026' => 'nox-at10-genius-18k-alum-2026.jpeg',
'nox-x-one-casual-series-23' => 'nox-x-one-casual-series-23.jpeg',
];

$imageFile = $slugImageMap[$slug] ?? null;
@endphp

<!-- ✅ ADDED data-brand -->
<div
class="product-card"
data-name="{{ strtolower($product->name) }}"
data-slug="{{ strtolower($product->slug) }}"
data-description="{{ strtolower($product->description ?? '') }}"
data-price="{{ (float) $product->base_price }}"
data-brand="{{ strtolower($product->brand ?? '') }}"
>
<a href="{{ route('product.show', $product->slug) }}">
<img
src="{{ $imageFile ? asset('products/rackets/' . rawurlencode($imageFile)) : asset('images/Vibora_UK_logo.png') }}"
alt="{{ $product->name }}"
onerror="this.onerror=null;this.src='{{ asset('images/Vibora_UK_logo.png') }}';"
>
</a>

<h3>
<a href="{{ route('product.show', $product->slug) }}">
{{ $product->name }}
</a>
</h3>

<p>{{ $product->slug }}</p>
<p>£{{ number_format((float) $product->base_price, 2) }}</p>

<button
type="button"
class="add-to-basket-btn"
data-product-id="{{ $productId }}"
data-product-name="{{ $product->name }}"
data-product-price="{{ (float) $product->base_price }}"
>
Add to Basket
</button>

<button
type="button"
class="add-to-wishlist-btn"
data-product-id="{{ $productId }}"
data-product-name="{{ $product->name }}"
data-product-price="{{ (float) $product->base_price }}"
data-product-image="{{ $imageFile ? 'products/rackets/' . rawurlencode($imageFile) : 'images/Vibora_UK_logo.png' }}"
data-product-slug="{{ $product->slug }}"
>
Add to Wishlist
</button>
</div>

@empty
<p>No rackets found.</p>
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
<script src="{{ asset('js/script1.js') }}?v=2"></script>
@endsection