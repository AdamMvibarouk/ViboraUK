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

        <form id="signup-form">

            <input type="text" name="first_name" id="first_name" placeholder="First Name" required />
            <input type="text" name="last_name" id="last_name" placeholder="Surname" required />

            <label for="birthday">Date of Birth:</label>
            <input type="date" id="birthday" name="birthday" required />

            <br>

            <input type="email" id="email" name="email" placeholder="Email" required />
            <input type="email" id="emailconfirm" name="emailconfirm" placeholder="Email Confirmation" required />

            <br>

            <input type="password" id="password" name="password" placeholder="Password" required />
            <input type="password" id="passwordconfirm" name="passwordconfirm" placeholder="Password Confirmation" required />

            <br>

            <input type="tel" id="phone" name="PhoneNumber" placeholder="Phone Number (optional)" pattern="[0-9]{11}" />

            <br>

            How do you prefer to be contacted by?

            <label>
                <input type="checkbox" id="emailA" value="Email Address"> Email
            </label>

            <label>
                <input type="checkbox" name="PhoneN" value="Phone Number"> Mobile
            </label>

            <br>

            <button class="Submission-button" type="submit">Submit</button>

            <br>

            <div id="signup-message"></div>

        </form>
    </section>
</div>

@endsection


@section('scripts')

<script src="{{ asset('js/api.js') }}"></script>
<script src="{{ asset('js/Signup.js') }}"></script>

@endsection