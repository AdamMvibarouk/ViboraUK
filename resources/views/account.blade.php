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
    <h1>MY ACCOUNT</h1>
</div>

<div class="account-content" style="max-width: 1000px; margin: 30px auto; padding: 20px;">
    @if(session('success'))
        <div style="margin-bottom: 20px; padding: 12px; background: #dff0d8; border: 1px solid #b2d8b2;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: #f5f5f5; border-radius: 20px; padding: 30px; text-align: center;">
        <div style="margin-bottom: 20px;">
            <img
                src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('images/Vibora_UK_logo.png') }}"
                alt="Profile Picture"
                style="width: 140px; height: 140px; object-fit: cover; border-radius: 50%; border: 4px solid #a6c400;"
            >
        </div>

        <form action="{{ url('/account/upload-profile-picture') }}" method="POST" enctype="multipart/form-data" style="margin-bottom: 25px;">
            @csrf
            <input type="file" name="profile_picture" required>
            <button type="submit">Upload Picture</button>
        </form>

        <h2>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
        <p>Vibora UK Customer</p>

        <div style="margin-top: 25px; text-align: left;">
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Phone:</strong> {{ Auth::user()->phone ?? 'Not added' }}</p>
        </div>

        <div style="margin-top: 30px; text-align: left;">
            <h3>Past Orders</h3>

            @if(isset($orders) && count($orders))
                @foreach($orders as $order)
                    <div style="border: 1px solid #ccc; border-radius: 10px; padding: 15px; margin-bottom: 15px; background: white;">
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

        <div style="margin-top: 30px;">
            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</div>

@else

<div class="page-title">
    <h1>LOGIN</h1>
</div>

<div style="max-width: 500px; margin: 40px auto; background: #f5f5f5; padding: 30px; border-radius: 20px;">
    @if(session('success'))
        <div style="margin-bottom: 20px; padding: 12px; background: #dff0d8; border: 1px solid #b2d8b2;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="margin-bottom: 20px; padding: 12px; background: #f2dede; border: 1px solid #e0b4b4;">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ url('/login') }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label>Email</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 10px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Password</label><br>
            <input type="password" name="password" required style="width: 100%; padding: 10px;">
        </div>

        <button type="submit" style="width: 100%;">Login</button>
    </form>

    <div style="margin-top: 20px; text-align: center;">
        <p>Don’t have an account?</p>
        <a href="{{ url('/signup') }}">Create one here</a>
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

@section('scripts')
<style>
.nav-profile-pic {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #000;
}
</style>
@endsection