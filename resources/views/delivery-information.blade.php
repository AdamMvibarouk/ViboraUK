@extends('layouts.app')

@section('title', 'Delivery Information')

@section('content')

<header id="main-header">
    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/icon.png') }}" alt="icon" />
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
            <img src="{{ asset('images/basket.png') }}" alt="Basket" class="basket-icon">
        </a>
        @auth
    <a href="{{ url('/account') }}" class="login-btn">My Account</a>
@else
    <a href="{{ url('/account') }}" class="login-btn">Login</a>
@endauth
    </div>
</header>

<section class="policy-page">
    <h4>Delivery Information</h4>

    <p>
        At Vibora UK, we aim to ensure that your padel equipment arrives quickly, safely,
        and in excellent condition. All orders are processed as soon as possible, and we work hard
        to dispatch items promptly so that you can enjoy your purchase without unnecessary delays.
        The exact delivery time may vary depending on the products ordered, your location, and the
        time at which the order is placed, but we always strive to provide a smooth and efficient
        delivery experience.
    </p>

    <br>

    <p>
        Once your order has been placed, it enters our processing system. Orders placed on weekends
        or public holidays may be processed on the next working day. After processing, your items
        will be handed to our delivery partners who handle the final transport of your goods. You
        will receive confirmation once your order has been dispatched, and tracking information may
        be provided where applicable so that you can follow the progress of your delivery.
    </p>

    <br>

    <p>
        Delivery charges are calculated based on the shipping destination, total weight or size of
        the items, and the selected delivery method. All costs will be clearly displayed at checkout
        before you complete your purchase. Any promotions, free shipping offers, or delivery upgrades
        will be presented on the website when available. It is important that you provide accurate
        delivery information, as we cannot be held responsible for delays or issues arising from
        incorrect addresses or missing details.
    </p>

    <br>

    <p>
        Estimated delivery times are provided to give you a general idea of when to expect your order,
        but they are not guaranteed. Factors such as courier delays, weather conditions, seasonal
        volume, or other unforeseen circumstances may affect the actual delivery timeframe. We do not
        accept responsibility for delays that occur after your parcel has been handed to the courier,
        although we will always assist you in tracking or resolving issues where possible.
    </p>

    <br>

    <p>
        In the unlikely event that your order arrives damaged, incomplete, or with signs of tampering,
        please contact us as soon as possible. We recommend notifying us promptly so that we can
        investigate the matter and work with our delivery partners to reach a suitable resolution.
        Photographic evidence may be required to help support any claims.
    </p>

    <br>

    <p>
        At Vibora UK, our goal is to deliver your products reliably and efficiently every time.
        If you have questions about your delivery, tracking, or expected arrival date, our customer
        support team is here to help.
    </p>
</section>

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
@endsection