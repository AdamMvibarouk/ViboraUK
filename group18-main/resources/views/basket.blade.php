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

<div class="basket-content">
    <h2>My Basket</h2>
</div>

<table cellspacing="15" cellpadding="10" id="table">
    <thead>
        <tr>
            <th><h2>Products</h2></th>
            <th><h2>Quantity</h2></th>
            <th><h2>Price (INCL VAT)</h2></th>
            <th><h2>Remove</h2></th>
        </tr>
    </thead>

    <tbody id="basket-items"></tbody>

    <tfoot>
        <tr class="basketTotal">
            <th><h2>Total:</h2></th>
            <td colspan="3">
                <div class="price">
                    <h2 id="basket-total">£00.00</h2>
                </div>
            </td>
        </tr>
    </tfoot>
</table>

<form id="basket-form">
    <h2>Card Details</h2>

    <input type="text" name="nameOnCard" placeholder="Name On Card" required><br>
    <input type="text" name="numberOnCard" placeholder="Card Number" required><br><br>

    <input type="text" name="expiry" placeholder="Expiry Date (MM/YY)" required>
    <input type="text" name="cvv" placeholder="CVV (***)" required><br><br>

    <button class="Submission-button" type="submit">Pay Now</button>
</form>

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
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/basket.js') }}"></script>
@endsection