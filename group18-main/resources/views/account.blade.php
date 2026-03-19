@extends('layouts.app')

@section('title', 'My Account')

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
            <img src="{{ asset('images/shopping-basket-icon-png-3309830814.png') }}" alt="Basket" class="basket-icon">
        </a>
        <a href="{{ url('/account') }}" class="login-btn">Login</a>
    </div>
</header>

<div class="account-header">
    <h2 class="account-title">MY ACCOUNT</h2>
</div>

<div class="account-intro-bar">
    <h3 class="account-intro-text">
        Welcome to your account page – manage your personal information and view your orders.
    </h3>
</div>

<div class="account-layout">

    <div class="account-left">
        <h2>Login</h2>

        <form id="login-form">
            <input type="email" id="email" name="email" placeholder="Email" required />
            <input type="password" id="password" name="password" placeholder="Password" required />
            <button type="submit" class="Submission-button">Submit</button>
            <div id="login-message"></div>
        </form>

        <p>Signup below:</p>

        <button id="signup_button" type="button" class="Submission-button"
            onclick="window.location.href='{{ url('/signup') }}'">
            Signup
        </button>
    </div>

    <div class="account-right">
        <h2>Account Details</h2>

        <table cellspacing="15" cellpadding="10" id="accountTable">
            <tr>
                <th>Name:</th>
                <td id="acct-name">Customer Name</td>
            </tr>
            <tr>
                <th>Email Address:</th>
                <td id="acct-email">Customer Email</td>
            </tr>
            <tr>
                <th>Contact Number:</th>
                <td id="acct-phone">Customer Phone</td>
            </tr>
        </table>
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
<script src="{{ asset('js/api.js') }}"></script>
<script src="{{ asset('js/login.js') }}"></script>
@endsection