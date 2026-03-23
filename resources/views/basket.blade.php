@extends('layouts.app')

@section('title', 'My Basket')

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

<div class="basket-page">
<h1 class="basket-title">My Basket</h1>

<div class="basket-layout">
<div class="basket-items-card">
<div id="basket-items-wrapper">
<table cellspacing="0" cellpadding="0" id="table" style="width: 100%;">
<thead>
<tr>
<th><h2>Products</h2></th>
<th><h2>Quantity</h2></th>
<th><h2>Price (INCL VAT)</h2></th>
<th><h2>Remove</h2></th>
</tr>
</thead>
<tbody id="basket-items"></tbody>
</table>
</div>
</div>

<div class="basket-summary-card">
<h2>Order Summary</h2>

<div class="basket-summary-row">
<span>Subtotal</span>
<span id="basket-subtotal">£00.00</span>
</div>

<div class="basket-summary-row">
<span>Discount</span>
<span id="basket-discount">-£0.00</span>
</div>

<div class="basket-summary-row">
<span>Delivery</span>
<span id="basket-delivery">£0.00</span>
</div>

<div style="margin-top: 16px;">
<label for="promo-code"><strong>Promo Code</strong></label>
<div style="display:flex; gap:10px; margin-top:8px;">
<input
type="text"
id="promo-code"
placeholder="VIBORA10"
style="flex:1; padding:10px; border-radius:8px; border:1px solid #ccc;"
>
<button type="button" id="apply-promo-btn" class="auth-btn">Apply</button>
</div>
<p id="promo-message" style="margin-top:8px; font-size:14px;"></p>
</div>

<div class="basket-summary-total">
<span>Total</span>
<span id="basket-total">£00.00</span>
</div>

<a href="{{ url('/rackets') }}" class="basket-continue-btn">Continue Shopping</a>
</div>
</div>

<div class="basket-summary-card" style="margin-top: 24px;">
<form id="basket-form" class="auth-form">
<h2>Card Details</h2>

<div>
<label for="nameOnCard">Name On Card</label>
<input type="text" id="nameOnCard" name="nameOnCard" placeholder="Name On Card" required>
</div>

<div>
<label for="numberOnCard">Card Number</label>
<input type="text" id="numberOnCard" name="numberOnCard" placeholder="Card Number" required>
</div>

<div class="auth-row">
<div>
<label for="expiry">Expiry Date</label>
<input type="text" id="expiry" name="expiry" placeholder="MM/YY" required>
</div>

<div>
<label for="cvv">CVV</label>
<input type="text" id="cvv" name="cvv" placeholder="***" required>
</div>
</div>

<button class="auth-btn" type="submit">Pay Now</button>
</form>
</div>
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
<script src="{{ asset('js/basket.js') }}?v=400"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
const basketForm = document.getElementById('basket-form');

if (!basketForm) return;

basketForm.addEventListener('submit', async function (e) {
e.preventDefault();

const payload = {
nameOnCard: document.getElementById('nameOnCard')?.value || '',
numberOnCard: document.getElementById('numberOnCard')?.value || '',
expiry: document.getElementById('expiry')?.value || '',
cvv: document.getElementById('cvv')?.value || '',
promo_code: document.getElementById('promo-code')?.value || ''
};

try {
const res = await fetch('/checkout', {
method: 'POST',
headers: {
'Content-Type': 'application/json',
'Accept': 'application/json',
'X-CSRF-TOKEN': document
.querySelector('meta[name="csrf-token"]')
?.getAttribute('content')
},
credentials: 'same-origin',
body: JSON.stringify(payload)
});

const data = await res.json();

if (!res.ok || !data.success) {
alert(data.message || 'Checkout failed.');
return;
}

alert('Order placed successfully.');
window.location.href = '/basket';
} catch (err) {
console.error('Checkout error:', err);
alert('There was a problem processing the checkout.');
}
});
});
</script>
@endsection