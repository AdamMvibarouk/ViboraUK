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

<div class="signup-content">
    <h1>Signup</h1>

    <section id="Signup">
        <h2>Enter the specified details below</h2>

        @if ($errors->any())
            <div id="signup-message" style="color: red; margin-bottom: 10px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('signup.post') }}">
            @csrf

            <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required />
            <input type="text" name="last_name" placeholder="Surname" value="{{ old('last_name') }}" required />

            <br><br>

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
            <input type="email" name="email_confirmation" placeholder="Email Confirmation" value="{{ old('email_confirmation') }}" required />

            <br><br>

            <input type="password" name="password" placeholder="Password" required />
            <input type="password" name="password_confirmation" placeholder="Password Confirmation" required />

            <br><br>

            <input type="tel" name="phone" placeholder="Phone Number (optional)" value="{{ old('phone') }}" />

            <br><br>

            <button class="Submission-button" type="submit">Submit</button>
        </form>
    </section>
</div>

@endsection