@extends('layouts.app')

@section('title', 'Cookies')

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
        <a href="{{ url('/account') }}" class="login-btn">Login</a>
    </div>
</header>

<section class="policy-page">
    <h4>Cookie Policy</h4>

    <p>
        Cookies are small text files that are stored on your device when you visit a website.
        They help us recognise your device, remember your preferences, understand how visitors navigate our site,
        and improve overall functionality and performance. Some cookies are essential for our website to operate properly,
        while others allow us to analyse user behaviour, personalise content, or provide a more efficient shopping experience.
    </p>

    <br>

    <p>
        When you visit our website, we may use cookies that are necessary for functions such as enabling the shopping cart,
        ensuring secure checkout, and maintaining your session as you move between pages. We may also use performance and analytics
        cookies that help us understand how visitors use the site, which pages are most popular, how users interact with features,
        and how we can improve usability. In addition, we may use cookies that allow us to offer personalised recommendations and
        marketing content based on your browsing activity. These may include cookies set by trusted third parties such as analytics
        providers, advertising platforms, and social media networks.
    </p>

    <br>

    <p>
        Some cookies remain on your device only while your browser is open, and these are known as session cookies. Others stay
        for a longer period or until you manually delete them, and these persistent cookies allow us to recognise you when you
        return to our site. Third-party cookies may also be placed on your device when you interact with embedded content or when
        our partners provide services such as analytics or advertising on our behalf.
    </p>

    <br>

    <p>
        If you prefer not to be tracked for advertising purposes, you may be able to opt out through tools offered by advertising
        networks or through your browser’s privacy settings. While these options can limit personalised ads, they may not eliminate
        all tracking technologies.
    </p>

    <br>

    <p>
        We may update this Cookie Policy from time to time to reflect changes in the cookies we use or updates to legal requirements.
        The “Last Updated” date at the top of this page will indicate when the Policy was most recently revised. Continuing to use
        our website after changes are published means you accept the updated Policy.
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