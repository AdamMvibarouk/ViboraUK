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

<div class="page-title">
    <h1>Rackets</h1>
</div>

<div class="searchbar">
    <input type="text" id="searchInput" placeholder="Search Products">
    <button id="searchBtn">OK</button>
</div>

<div class="filter-container">
    <div class="filter">
        <label for="racketbrands">Brand:</label>
        <select name="racketbrands" id="racketbrands">
            <option value="all">All</option>
            <option value="bullpadel">Bullpadel</option>
            <option value="y1">Y1</option>
            <option value="nox">NOX</option>
            <option value="head">Head</option>
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
        <label for="level">Level:</label>
        <select name="level" id="level">
            <option value="all">All</option>
            <option value="beginner">Beginner</option>
            <option value="intermediate">Intermediate</option>
            <option value="advanced">Advanced</option>
        </select>
    </div>

    <div class="filter">
        <label for="material">Material:</label>
        <select name="material" id="material">
            <option value="all">All</option>
            <option value="a">A</option>
            <option value="b">B</option>
            <option value="c">C</option>
            <option value="d">D</option>
        </select>
    </div>
</div>

<div class="products-container" id="productsContainer">
    @forelse($products as $product)
        @php
            $productId = $product->id ?? $product->product_id ?? $product->slug;

            $slug = $product->slug ?? '';

            $slugImageMap = [
                'babolat-x-lamborghini-bl002-scandal-green' => 'BABOLAT X LAMBORGHINT BL002 SCANDAL GREEN.jpg',
                'mirage-25-padel-racket' => 'Mirage-Front-2655789586.jpg',
                'panna-25-padel-racket' => 'Panna TF Padel Racket.jpg',
                'pro-x-25-padel-racket' => 'pro-x-25-padel-racket.jpeg',
                'arlo-25-padel-racket' => 'Arlo Padel Racket.jpg',
                'bullpadel-vertex-04-25' => 'RACKET BULLPADEL VERTEX 04 25.jpg',
                'head-evo-extreme-2025' => 'HEAD EVO EXTREME 2025.jpg',
                'head-speed-motion-2025' => 'head-speed-motion-2025.jpeg',
                'nox-at10-genius-18k-alum-2026' => 'nox-at10-genius-18k-alum-2026.jpeg',
                'nox-x-one-casual-series-23' => 'nox-x-one-casual-series-23.jpeg',
                'bullpadel-vertex-jr-25' => 'bullpadel-vertex-jr-25.jpeg',
            ];

            $imageFile = $slugImageMap[$slug] ?? null;
        @endphp

        <div class="product-card">
            @if($imageFile)
                <img
                    src="{{ asset('products/rackets/' . rawurlencode($imageFile)) }}"
                    alt="{{ $product->name }}"
                    onerror="this.onerror=null;this.src='{{ asset('images/Vibora_UK_logo.png') }}';"
                >
            @else
                <img
                    src="{{ asset('images/Vibora_UK_logo.png') }}"
                    alt="{{ $product->name }}"
                >
            @endif

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
<script src="{{ asset('js/script1.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".add-to-basket-btn");

    buttons.forEach((button) => {
        button.addEventListener("click", async () => {
            const productId = button.getAttribute("data-product-id");
            const productName = button.getAttribute("data-product-name");
            const productPrice = button.getAttribute("data-product-price");

            if (!productId || !productName || !productPrice) {
                alert("Product info missing on page.");
                console.log({ productId, productName, productPrice });
                return;
            }

            try {
                const res = await fetch("/api/cart/add", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    credentials: "include",
                    body: JSON.stringify({
                        product_id: productId,
                        name: productName,
                        price: Number(productPrice),
                        quantity: 1
                    })
                });

                const data = await res.json();

                if (!res.ok) {
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
});
</script>
@endsection