@extends('layouts.app')

@section('title', 'Vibora UK')

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
            <li><a href="{{ url('/') }}" class="active">Home</a></li>
            <li><a href="{{ url('/rackets') }}">Rackets</a></li>
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
        <a href="{{ url('/account') }}" class="login-btn">Login</a>
    </div>
</header>

<section id="banner">
    <div class="banner-image">
        <img src="{{ asset('images/homepagebaanerimage.png') }}" alt="Padel Banner">
    </div>
    <div class="banner-txt">
        <h1>VIBORA UK</h1>
        <h2>PADEL LIKE NEVER BEFORE</h2>
    </div>
</section>

<section id="store">
    <h2>VIBORA STORE</h2>
    <input type="text" id="search" placeholder="Search for products...">
</section>

<section id="featured-rackets">
    <h2>FEATURED RACKETS</h2>
    <div class="products-container" id="featured-rackets-list"></div>
</section>

<section id="featured-balls">
    <h2>FEATURED BALLS</h2>
    <div class="products-container" id="featured-balls-list"></div>
</section>

<section id="featured-sportswear">
    <h2>FEATURED SPORTSWEAR</h2>
    <div class="products-container" id="featured-sportswear-list"></div>
</section>

<section id="payment-banner">
    <div id="payment-banner-img">
        <img src="{{ asset('images/rsg-4253484635.jpeg') }}" alt="Payment Banner">
    </div>

    <div id="payment-banner-txt">
        <h2>PAY AT YOUR PACE</h2>

        <div id="payment-methods-row">
            <section id="paypal-method">
                <img src="{{ asset('images/PayPal.jpg') }}" alt="PayPal">
                <h4>BUY NOW & PAY IN 3</h4>
                <h5>Pay in 3 interest-free payments</h5>
                <a href="https://www.paypal.com/uk/digital-wallet/ways-to-pay/buy-now-pay-later" target="_blank">Learn More</a>
            </section>

            <section id="klarna-method">
                <img src="{{ asset('images/Screenshot 2025-11-24 at 21.17.26.png') }}" alt="Klarna">
                <h4>BUY NOW PAY LATER</h4>
                <h5>Buy now pay in 30 days</h5>
                <a href="https://www.klarna.com/uk/payments/pay-in-30-days/" target="_blank">Learn More</a>
            </section>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/tanimscript.js') }}"></script>
@endsection