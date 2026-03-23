@extends('layouts.app')

@section('title', 'Wishlist')

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
</ul>
</li>
<li><a href="{{ url('/about') }}">About Us</a></li>
<li><a href="{{ url('/contact') }}">Contact</a></li>
</ul>
</nav>

<div class="login">
<a href="{{ route('wishlist.index') }}" class="wishlist-link" aria-label="Wishlist">
<span class="wishlist-heart">❤</span>
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

<div class="wishlist-page">
<h1 class="wishlist-title">My Wishlist</h1>

@if(empty($wishlist))
<div class="wishlist-empty">
<h2>Your wishlist is empty</h2>
<p>Save your favourite products here for later.</p>
</div>
@else
<div class="wishlist-grid">
@foreach($wishlist as $item)
<div class="wishlist-card">
<img
src="{{ !empty($item['image']) ? asset($item['image']) : asset('images/Vibora_UK_logo.png') }}"
alt="{{ $item['name'] }}"
>

<h3>{{ $item['name'] }}</h3>
<p>£{{ number_format((float) $item['price'], 2) }}</p>

<div class="wishlist-actions">
@if(!empty($item['slug']))
<a href="{{ route('product.show', $item['slug']) }}" class="wishlist-btn">View Product</a>
@endif

<button
type="button"
class="remove-wishlist-btn"
data-product-id="{{ $item['product_id'] }}"
>
Remove
</button>
</div>
</div>
@endforeach
</div>
@endif
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
document.addEventListener('DOMContentLoaded', () => {
document.querySelectorAll('.remove-wishlist-btn').forEach(button => {
button.addEventListener('click', async () => {
const productId = button.getAttribute('data-product-id');

const res = await fetch("{{ route('wishlist.remove') }}", {
method: 'POST',
headers: {
'Content-Type': 'application/json',
'X-CSRF-TOKEN': '{{ csrf_token() }}'
},
body: JSON.stringify({ product_id: productId })
});

if (res.ok) {
location.reload();
}
});
});
});
</script>
@endsection