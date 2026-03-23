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
                    <li><a href="{{ url('/reviews') }}">Reviews</a></li>
                    <li><a href="{{ route('admin.login') }}">ADMIN</a></li>
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
            <a href="{{ url('/account') }}" class="profile-link">
                <img
                    src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('images/Vibora_UK_logo.png') }}"
                    alt="Profile"
                    class="nav-profile-pic"
                >
            </a>
        @else
            <a href="{{ url('/account') }}" class="login-btn">Login</a>
        @endauth
    </div>
</header>

@auth

<div class="page-title">
    <h1>My Account</h1>
</div>

<div class="account-content" style="max-width: 1100px; margin: 30px auto; padding: 20px;">
    @if(session('success'))
        <div class="auth-success" style="margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="account-profile-card">
        <div class="profile-avatar">
            <img
                src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('images/Vibora_UK_logo.png') }}"
                alt="Profile Picture"
            >
        </div>

        <h2 style="text-align:center;">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
        <p class="profile-subtitle">Vibora UK Customer</p>

        <form action="{{ route('profile.picture.upload') }}" method="POST" enctype="multipart/form-data" class="auth-form" style="max-width: 420px; margin: 0 auto 24px;">
            @csrf
            <div>
                <label for="profile_picture">Update Profile Picture</label>
                <input type="file" id="profile_picture" name="profile_picture" required>
            </div>
            <button type="submit" class="auth-btn">Upload Picture</button>
        </form>

        <div class="profile-info">
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Phone:</strong> {{ Auth::user()->phone ?? 'Not added' }}</p>
        </div>

        <div style="margin-top: 24px;">
            <form action="{{ url('/logout') }}" method="POST" style="max-width: 280px; margin: 0 auto;">
                @csrf
                <button type="submit" class="auth-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="account-orders-card">
        <h3>Past Orders</h3>

        @if(isset($orders) && count($orders))
            @foreach($orders as $order)
                <div class="order-card">
                    <p><strong>Order ID:</strong> {{ $order->order_id }}</p>
                    <p><strong>Date:</strong> {{ $order->created_at ?? 'N/A' }}</p>
                    <p><strong>Status:</strong> {{ $order->status ?? 'Processing' }}</p>
                    <p><strong>Total:</strong> £{{ number_format((float)($order->total_amount ?? 0), 2) }}</p>
                </div>
            @endforeach
        @else
            <p>You have no past orders yet.</p>
        @endif
    </div>
</div>

@else

<div class="auth-page">
    <div class="auth-card">
        <h1>Login</h1>
        <p class="auth-subtitle">Access your Vibora UK account</p>

        @if(session('success'))
            <div class="auth-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="auth-errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST" class="auth-form">
            @csrf

            <div>
                <label for="login_email">Email</label>
                <input type="email" id="login_email" name="email" value="{{ old('email') }}" required>
            </div>

            <div>
                <label for="login_password">Password</label>
                <input type="password" id="login_password" name="password" required>
            </div>

            <button type="submit" class="auth-btn">Login</button>
        </form>

        <div class="auth-link-row">
            Don’t have an account?
            <a href="{{ url('/signup') }}">Create one here</a>
        </div>
    </div>
</div>

@endauth

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