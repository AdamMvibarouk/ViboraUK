@extends('layouts.app')

@section('title', 'Contact Us')

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
                </ul>
            </li>
            <li><a href="{{ url('/about') }}">About Us</a></li>
            <li><a href="{{ url('/contact') }}" class="active">Contact</a></li>
        </ul>
    </nav>

    <div class="login">
        <a href="{{ url('/basket') }}" class="basket-link">
            <img src="{{ asset('images/shopping-basket-icon-png-3309830814.png') }}" class="basket-icon" alt="Basket">
        </a>
        <a href="{{ url('/account') }}" class="login-btn">Login</a>
    </div>
</header>

<section id="contact">
    <h1>Contact Us</h1>
    <p>
        If you have any questions about Vibora UK, our products, your order or anything else,
        send us a message below with your order number if you have one.
    </p>

    <form id="contact-form">
        <input type="text" name="name" id="name" placeholder="Full Name" />
        <input type="email" name="email" id="email" placeholder="Email Address" required />
        <textarea name="message" id="message" rows="6" placeholder="Your Message" required></textarea>
        <button type="submit" id="contact-submit">Submit</button>
    </form>
</section>

<footer>
    <h4>@ ViboraUK Ltd</h4>
    <div class="credentials">
        <h5><a href="{{ url('/terms') }}">Terms and Conditions</a></h5>
        <h5><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></h5>
        <h5><a href="{{ url('/cookies') }}">Cookies</a></h5>
        <h5><a href="{{ url('/delivery-information') }}">Delivery Information</a></h5>
        <h5><a href="{{ url('/returns') }}">Returns</a></h5>
        <h5><a href="{{ url('/contact') }}">Contact</a></h5>
    </div>
    <p>&copy; 2025 ViboraUK. All rights reserved.</p>
</footer>

@endsection

@section('scripts')
<script src="{{ asset('js/contact.js') }}"></script>
@endsection