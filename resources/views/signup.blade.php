@extends('layouts.app')

@section('title', 'Signup')

@section('content')

<header id="main-header">
    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/icon.png') }}" alt="icon">
            <span>VIBORA UK</span>
        </a>
    </div>

    <nav>
        <ul>
            <li><a href="{{ url('/') }}">HOME</a></li>
            <li><a href="{{ url('/rackets') }}">RACKETS</a></li>
            <li><a href="{{ url('/sportswear') }}">SPORTSWEAR</a></li>

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

            <li><a href="{{ url('/about') }}">ABOUT US</a></li>
            <li><a href="{{ url('/contact') }}">CONTACT</a></li>
        </ul>
    </nav>

    <div class="login">
        <a href="{{ url('/basket') }}" class="basket-link">
            <img src="{{ asset('images/shopping-basket-icon-png-3309830814.png') }}" class="basket-icon" alt="Basket">
        </a>

        <a href="{{ url('/account') }}" class="login-btn">Login</a>
    </div>
</header>

<div class="auth-page">
    <div class="auth-card" style="max-width: 700px;">
        <h1>Create Account</h1>
        <p class="auth-subtitle">Join Vibora UK today</p>

        @if ($errors->any())
            <div class="auth-errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('signup.post') }}" class="auth-form">
            @csrf

            <div class="auth-row">
                <div>
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                </div>

                <div>
                    <label for="last_name">Surname</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                </div>
            </div>

            <div class="auth-row">
                <div>
                    <label for="signup_email">Email</label>
                    <input type="email" id="signup_email" name="email" value="{{ old('email') }}" required>
                </div>

                <div>
                    <label for="signup_email_confirmation">Confirm Email</label>
                    <input type="email" id="signup_email_confirmation" name="email_confirmation" value="{{ old('email_confirmation') }}" required>
                </div>
            </div>

            <div>
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}">
            </div>

            <div class="auth-row">
                <div>
                    <label for="signup_password">Password</label>
                    <input type="password" id="signup_password" name="password" required>
                </div>

                <div>
                    <label for="signup_password_confirmation">Confirm Password</label>
                    <input type="password" id="signup_password_confirmation" name="password_confirmation" required>
                </div>
            </div>

            <button class="auth-btn" type="submit">Create Account</button>
        </form>

        <div class="auth-link-row">
            Already have an account?
            <a href="{{ url('/account') }}">Login here</a>
        </div>
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