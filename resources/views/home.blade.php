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

<section id="delivery-banner">
<h5>FREE UK DELIVERY ON ORDERS OVER £50</h5>
</section>

<section id="trust-bar">
<div id="trust-bar-list">
<div class="trust-item">
<h5>FREE UK DELIVERY</h5>
</div>
<div class="trust-item">
<h5>SECURE CHECKOUT</h5>
</div>
<div class="trust-item">
<h5>EASY RETURNS</h5>
</div>
<div class="trust-item">
<h5>PREMIUM PADEL EQUIPMENT</h5>
</div>
</div>
</section>

<section id="banner">
<div class="banner-image">
<img src="{{ asset('images/homepagebaanerimage.png') }}" alt="Homepage Banner">
</div>

<div class="banner-txt">
<h1>VIBORA UK</h1>
<h2>PADEL LIKE NEVER BEFORE</h2>
<a href="{{ url('/rackets') }}" class="banner-btn">SHOP RACKETS</a>
</div>
</section>

<section id="store">
<h2>VIBORA STORE</h2>
<input type="text" id="search" placeholder="Search for products...">
</section>

<section id="shop-category">
<h2>SHOP BY CATEGORY</h2>

<div id="shop-category-list">
<a href="{{ url('/rackets') }}" class="shop-category-card">
<img src="{{ asset('images/padel.jpg') }}" alt="Rackets">
<h3>RACKETS</h3>
</a>

<a href="{{ url('/sportswear') }}" class="shop-category-card">
<img src="{{ asset('images/padelsportswear.jpg') }}" alt="Sportswear">
<h3>SPORTSWEAR</h3>
</a>

<a href="{{ url('/balls') }}" class="shop-category-card">
<img src="{{ asset('images/padelballs.jpg') }}" alt="Balls">
<h3>BALLS</h3>
</a>

<a href="{{ url('/bags') }}" class="shop-category-card">
<img src="{{ asset('images/padelbag.jpg') }}" alt="Bags">
<h3>BAGS</h3>
</a>
</div>
</section>

<section id="featured-rackets">
<h2>FEATURED RACKETS</h2>

<div class="products-container">
@forelse($featuredRackets as $product)
@php
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
$imageFile = $slugImageMap[$product->slug] ?? null;
@endphp

<div class="product-card homepage-racket-card">
<a href="{{ route('product.show', $product->slug) }}" class="homepage-product-link">
<img
src="{{ $imageFile ? asset('products/rackets/' . rawurlencode($imageFile)) : asset('images/Vibora_UK_logo.png') }}"
alt="{{ $product->name }}"
class="homepage-racket-image"
onerror="this.onerror=null; this.src='{{ asset('images/Vibora_UK_logo.png') }}';"
>
</a>

<h3>
<a href="{{ route('product.show', $product->slug) }}">
{{ $product->name }}
</a>
</h3>

<p>£{{ number_format((float) $product->base_price, 2) }}</p>
</div>
@empty
<p>No featured rackets found.</p>
@endforelse
</div>
</section>

<section id="featured-balls">
<h2>FEATURED BALLS</h2>

<div class="products-container">
@forelse($featuredBalls as $product)
<div class="product-card">
<a href="{{ route('product.show', $product->slug) }}">
<img
src="{{ !empty($product->image_url) ? asset('products/balls/' . rawurlencode($product->image_url)) : asset('images/Vibora_UK_logo.png') }}"
alt="{{ $product->name }}"
onerror="this.onerror=null; this.src='{{ asset('images/Vibora_UK_logo.png') }}';"
>
</a>

<h3>
<a href="{{ route('product.show', $product->slug) }}">
{{ $product->name }}
</a>
</h3>

<p>£{{ number_format((float) $product->base_price, 2) }}</p>
</div>
@empty
<p>No featured balls found.</p>
@endforelse
</div>
</section>

<section id="featured-sportswear">
<h2>FEATURED SPORTSWEAR</h2>

<div class="products-container">
@forelse($featuredSportswear as $product)
<div class="product-card">
<a href="{{ route('product.show', $product->slug) }}">
<img
src="{{ !empty($product->image_url) ? asset('products/tshirts/' . rawurlencode($product->image_url)) : asset('images/Vibora_UK_logo.png') }}"
alt="{{ $product->name }}"
onerror="this.onerror=null; this.src='{{ asset('images/Vibora_UK_logo.png') }}';"
>
</a>

<h3>
<a href="{{ route('product.show', $product->slug) }}">
{{ $product->name }}
</a>
</h3>

<p>£{{ number_format((float) $product->base_price, 2) }}</p>
</div>
@empty
<p>No featured sportswear found.</p>
@endforelse
</div>
</section>

<section id="homepage-reviews">
<h2>CUSTOMER REVIEWS</h2>

<div id="homepage-reviews-list">
@if(isset($homepageReviews) && count($homepageReviews))
@foreach($homepageReviews as $review)
<div class="review-card">
<div class="review-stars">
{{ str_repeat('★', (int) $review->rating) }}{{ str_repeat('☆', 5 - (int) $review->rating) }}
</div>
<h4>{{ $review->title }}</h4>
<p>{{ $review->body }}</p>
</div>
@endforeach
@endif
</div>

<div id="homepage-reviews-button">
<a href="{{ url('/reviews') }}">View All Reviews</a>
</div>
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

<section id="faq-preview">
<h2>FREQUENTLY ASKED QUESTIONS</h2>

<details class="faq-item">
<summary class="faq-question">HOW LONG DOES DELIVERY TAKE?</summary>
<div class="faq-answer">
<h5>Delivery usually takes between 2-5 working days across the UK depending on your location.</h5>
</div>
</details>

<details class="faq-item">
<summary class="faq-question">CAN I RETURN MY ORDER?</summary>
<div class="faq-answer">
<h5>Yes, we offer a simple returns process. Please visit our returns page for full details.</h5>
</div>
</details>

<details class="faq-item">
<summary class="faq-question">HOW CAN I TRACK MY ORDER?</summary>
<div class="faq-answer">
<h5>Once your order has been dispatched, you will receive tracking information via email.</h5>
</div>
</details>

<details class="faq-item">
<summary class="faq-question">WHAT PAYMENT METHODS DO YOU ACCEPT?</summary>
<div class="faq-answer">
<h5>We accept secure payments through providers such as PayPal and Klarna.</h5>
</div>
</details>

<a href="{{ url('/delivery-information') }}">VIEW DELIVERY INFORMATION</a>
</section>

<section id="newsletter-popup">
<div id="newsletter-overlay"></div>

<div id="newsletter-box">
<button id="newsletter-close" type="button">×</button>

<h2>GET 10% OFF</h2>
<h4>Join our newsletter and receive a discount code.</h4>

<form id="newsletter-form">
<input type="email" id="newsletter-email" placeholder="Email Address" required>
<button type="submit" id="newsletter-submit">Get Discount</button>
</form>

<div id="newsletter-success" style="display:none;">
<h4>Your discount code:</h4>
<h2>VIBORA10</h2>
</div>
</div>
</section>

<section id="cookie-popup">
<div id="cookie-box">
<h4>COOKIES</h4>
<h5>We use cookies to improve your experience and analyse traffic. You can accept or reject optional cookies.</h5>
<a href="{{ url('/cookies') }}">Find out about our cookie policy here</a>
<div id="cookie-buttons">
<button id="cookie-reject" type="button">Reject</button>
<button id="cookie-accept" type="button">Accept</button>
</div>
</div>
</section>

<div id="chatbot-container">
<button id="chat-toggle" type="button">Chat</button>

<div id="chat-window" class="hidden">
<div id="chat-header">
<span>Vibora Assistant</span>
<button id="chat-close" type="button">&times;</button>
</div>

<div id="chat-messages"></div>

<div id="chat-input-area">
<input type="text" id="chat-input" placeholder="Type your message..." />
<button id="chat-send" type="button">Send</button>
</div>
</div>
</div>

<footer>
<h4>@ ViboraUK</h4>
<div class="credentials">
<h5><a href="{{ url('/terms') }}">Terms and Conditions</a></h5>
<h5><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></h5>
<h5><a href="{{ url('/cookies') }}">Cookies</a></h5>
<h5><a href="{{ url('/delivery-information') }}">Delivery Information</a></h5>
<h5><a href="{{ url('/returns') }}">Returns</a></h5>
<h5><a href="{{ url('/contact') }}">Contact</a></h5>
</div>
<p>&copy; 2025 VIBORA UK. All rights reserved.</p>
<div id="chatbot-container">
<button id="chat-toggle" type="button">Chat</button>

<div id="chat-window" class="hidden">
<div id="chat-header">
<span>Vibora Assistant</span>
<button id="chat-close" type="button">&times;</button>
</div>

<div id="chat-messages"></div>

<div id="chat-input-area">
<input type="text" id="chat-input" placeholder="Type your message...">
<button id="chat-send" type="button">Send</button>
</div>
</div>
</div>

</footer>

@endsection

@section('scripts')
<script src="{{ asset('js/tanimscript.js') }}?v=20"></script>
<script src="{{ asset('js/chatbot.js') }}?v=20"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
const newsletterPopup = document.getElementById('newsletter-popup');
const newsletterClose = document.getElementById('newsletter-close');
const newsletterForm = document.getElementById('newsletter-form');
const newsletterSuccess = document.getElementById('newsletter-success');
const newsletterEmail = document.getElementById('newsletter-email');

const cookiePopup = document.getElementById('cookie-popup');
const cookieAccept = document.getElementById('cookie-accept');
const cookieReject = document.getElementById('cookie-reject');

const chatToggle = document.getElementById('chat-toggle');
const chatWindow = document.getElementById('chat-window');
const chatClose = document.getElementById('chat-close');

if (!localStorage.getItem('newsletterSubscribed')) {
setTimeout(() => {
newsletterPopup?.classList.add('active');
}, 1200);
}

newsletterClose?.addEventListener('click', () => {
newsletterPopup?.classList.remove('active');
});

newsletterForm?.addEventListener('submit', (e) => {
e.preventDefault();

const email = newsletterEmail?.value.trim().toLowerCase();
if (!email) return;

if (localStorage.getItem('newsletterSubscribed') === 'true') {
alert('This browser has already claimed the newsletter code.');
return;
}

localStorage.setItem('newsletterSubscribed', 'true');
localStorage.setItem('newsletterEmail', email);
localStorage.setItem('newsletterCode', 'VIBORA10');

newsletterForm.style.display = 'none';
newsletterSuccess.style.display = 'block';
});

if (!localStorage.getItem('cookieChoice')) {
setTimeout(() => {
cookiePopup?.classList.add('active');
}, 800);
}

cookieAccept?.addEventListener('click', () => {
localStorage.setItem('cookieChoice', 'accepted');
cookiePopup?.classList.remove('active');
});

cookieReject?.addEventListener('click', () => {
localStorage.setItem('cookieChoice', 'rejected');
cookiePopup?.classList.remove('active');
});

chatToggle?.addEventListener('click', () => {
chatWindow?.classList.toggle('hidden');
});

chatClose?.addEventListener('click', () => {
chatWindow?.classList.add('hidden');
});
});
</script>
@endsection