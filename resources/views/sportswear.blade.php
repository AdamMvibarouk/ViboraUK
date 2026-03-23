@extends('layouts.app')

@section('title', 'Sportswear')

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
            <li><a href="{{ url('/sportswear') }}" class="active">Sportswear</a></li>

            <li class="dropdown">
                <a href="#">More</a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/bags') }}">Bags</a></li>
                    <li><a href="{{ url('/shoes') }}">Shoes</a></li>
                    <li><a href="{{ url('/balls') }}">Balls</a></li>
                    <li><a href="{{ url('/services') }}">Services</a></li>
                    <li><a href="{{ url('/reviews') }}">Reviews</a></li>
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
    <h1>Sportswear</h1>
</div>

<div class="searchbar">
    <input type="text" id="searchInput" placeholder="Search Products">
    <button id="searchBtn">OK</button>
</div>

<div class="filter-container">
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

    <div class="filter">
        <label for="sortBy">Sort by:</label>
        <select id="sortBy" name="sortBy">
            <option value="default">Default</option>
            <option value="name-asc">Name A-Z</option>
            <option value="name-desc">Name Z-A</option>
            <option value="price-asc">Price Low to High</option>
            <option value="price-desc">Price High to Low</option>
        </select>
    </div>
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
</div>

<div class="products-container" id="productsContainer">
    @forelse($products as $product)
        @php
            $productId = $product->product_id ?? $product->id ?? $product->slug;
            $slug = $product->slug ?? '';

            $slugImageMap = [
                'short-sleeve-training-top-mens-black' => 'Short Sleeve Training Top Mens Black.jpg',
                'short-sleeve-training-top-mens-navy' => 'Short Sleeve Training Top Mens Navy.jpg',
                'short-sleeve-training-top-mens-red' => 'Short Sleeve Training Top Mens Red.jpg',
                'short-sleeve-training-top-mens-white' => 'Short Sleeve Training Top Mens White.jpg',
                'short-sleeve-training-top-womens-navy' => 'Short Sleeve Training Top Womens Navy.jpg',
                'short-sleeve-training-top-womens-red' => 'Short Sleeve Training Top Womens Red.jpg',
                't-shirt-bullpadel-batea-woman' => 'T-SHIRT BULLPADEL BATEA WOMAN.jpg',
                't-shirt-bullpadel-paquito-25i-white' => 'T-SHIRT BULLPADEL PAQUITO 25I WHITE.jpg',
                't-shirt-lacoste-th5195' => 'T-SHIRT LACOSTE TH5195.jpg',
                't-shirt-nox-pro-2025' => 'T-SHIRT NOX PRO 2025.jpg',
            ];

            $imageFile = !empty($product->image_url)
                ? $product->image_url
                : ($slugImageMap[$slug] ?? null);
        @endphp

        <div
            class="product-card"
            data-name="{{ strtolower($product->name) }}"
            data-slug="{{ strtolower($product->slug) }}"
            data-description="{{ strtolower($product->description ?? '') }}"
            data-price="{{ (float) $product->base_price }}"
        >
<img
    src="{{ !empty($product->image_url) ? asset('products/tshirts/' . rawurlencode($product->image_url)) : asset('images/Vibora_UK_logo.png') }}"
    alt="{{ $product->name }}"
    onerror="this.onerror=null; this.src='{{ asset('images/Vibora_UK_logo.png') }}';"
>

<p style="font-size: 12px; color: #666; margin-top: 8px;">
    {{ $product->image_url }}
</p>
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
    data-product-image="{{ $imageFile ? 'products/rackets/' . rawurlencode($imageFile) : 'images/Vibora_UK_logo.png' }}"
    data-product-slug="{{ $product->slug }}"
>
    Add to Wishlist
</button>
        </div>
    @empty
        <p>No sportswear found.</p>
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
<script src="{{ asset('js/script1.js') }}"></script>
@endsection