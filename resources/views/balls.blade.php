@extends('layouts.app')

@section('title', 'Balls')

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
<li><a href="{{ url('/balls') }}" class="active">Balls</a></li>
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
<h1>Balls</h1>
</div>

<div class="searchbar">
<input type="text" id="searchInput" placeholder="Search Products">
<button id="searchBtn">OK</button>
</div>



<div class="filter">
<label for="price">Price:</label>
<select id="price" name="price">
<option value="all">All</option>
<option value="under50">Under £50</option>
<option value="50to75">£50-75</option>
<option value="75to100">£75-100</option>
<option value="100to150">£100-150</option>
<option value="over150">£150+</option>
</select>
</div>



</div>

<div class="products-container" id="productsContainer">
@forelse($products as $product)
@php
$productId = $product->product_id ?? $product->id ?? $product->slug;
$imagePath = !empty($product->image_url)
? 'products/balls/' . rawurlencode($product->image_url)
: 'images/Vibora_UK_logo.png';
@endphp

<div
class="product-card"
data-name="{{ strtolower($product->name) }}"
data-slug="{{ strtolower($product->slug) }}"
data-description="{{ strtolower($product->description ?? '') }}"
data-price="{{ (float) $product->base_price }}"
>
<img
src="{{ asset($imagePath) }}"
alt="{{ $product->name }}"
onerror="this.onerror=null; this.src='{{ asset('images/Vibora_UK_logo.png') }}';"
>

<h3>{{ $product->name }}</h3>
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
data-product-image="{{ $imagePath }}"
data-product-slug="{{ $product->slug }}"
>
Add to Wishlist
</button>
</div>
@empty
<p>No balls found.</p>
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
<script src="{{ asset('js/script1.js') }}?v=102"></script>
@endsection