@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<header id="main-header">
    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/Vibora_UK_logo.png') }}" alt="icon" />
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
                </ul>
            </li>
            <li><a href="{{ url('/about') }}">ABOUT US</a></li>
            <li><a href="{{ url('/contact') }}">CONTACT</a></li>
            <li><a href="{{ route('admin.login') }}" class="active">ADMIN</a></li>
        </ul>
    </nav>

    <div class="login">
        <a href="{{ url('/account') }}" class="login-btn">Customer Mode</a>
    </div>
</header>

<div style="max-width: 500px; margin: 50px auto; padding: 30px; background: #f5f5f5; border-radius: 16px;">
    <h2 style="margin-bottom: 20px;">Admin Login</h2>

    @if(session('success'))
        <div style="background:#dff0d8; padding:10px; border-radius:8px; margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background:#f2dede; padding:10px; border-radius:8px; margin-bottom:15px;">
            <ul style="margin:0; padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}" id="login-form">
        @csrf

        <input type="email" name="email" placeholder="Email" required style="width:100%; padding:12px; margin-bottom:15px;">
        <input type="password" name="password" placeholder="Password" required style="width:100%; padding:12px; margin-bottom:15px;">

        <button type="submit" class="Submission-button">Submit</button>
    </form>

    <br>

    <a href="{{ url('/') }}" class="login-btn">Switch to Customer Mode</a>
</div>
@endsection