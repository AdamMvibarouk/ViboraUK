@extends('layouts.app')

@section('title', 'Terms and Conditions')

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
    <h2>Terms and Conditions</h2>

    <br>

    <h4>Use of the Website</h4>

    <br>

    <p>You agree to use our website for lawful purposes only.</p>
    <p>You must not:</p>
    <ul>
        <li>Engage in any activity that disrupts or interferes with the website’s functionality.</li>
        <li>Attempt to access unauthorised areas of the website.</li>
        <li>Use the website to transmit harmful, illegal, or malicious content.</li>
    </ul>

    <br>

    <h4>Product Information</h4>
    <p>
        We aim to ensure that all product descriptions, images, and specifications for padel equipment are accurate. However:
    </p>
    <ul>
        <li>Product colours, materials, or features may vary depending on your device or manufacturer updates.</li>
        <li>We reserve the right to update or correct product information at any time without notice.</li>
        <li>Product availability cannot always be guaranteed.</li>
    </ul>

    <br>

    <h4>Orders</h4>
    <p>By placing an order with Vibora UK, you confirm that:</p>
    <ul>
        <li>All information provided is accurate and complete.</li>
        <li>You are authorised to use the payment method submitted.</li>
        <li>You understand that order acceptance is subject to our review and approval.</li>
        <li>We reserve the right to cancel or refuse any order for reasons including suspected fraud, incorrect pricing, or stock issues.</li>
    </ul>

    <br>

    <h4>Pricing</h4>
    <p>
        All prices shown on our website are listed in GBP (£).
        We reserve the right to modify prices at any time without notice.
        If a pricing error occurs, we may cancel any associated orders prior to dispatch.
    </p>

    <br>

    <h4>Intellectual Property</h4>
    <p>
        All content on the Vibora UK website — including logos, branding, product imagery, text, and design elements —
        is the property of Vibora UK or its licensors. You may not copy, reproduce, distribute, or modify any content
        without our written permission.
    </p>

    <br>

    <h4>User Accounts</h4>
    <p>If you create an account on our website, you agree to:</p>
    <ul>
        <li>Provide accurate information.</li>
        <li>Keep your login details secure.</li>
        <li>Take responsibility for all actions performed under your account.</li>
    </ul>
    <p>We may suspend or terminate accounts that violate these Terms.</p>

    <br>

    <h4>Limitation of Liability</h4>
    <p>To the fullest extent permitted by law, Vibora UK is not liable for:</p>
    <ul>
        <li>Any indirect, incidental, or consequential damages arising from the use of our website or products.</li>
        <li>Losses caused by events outside our reasonable control.</li>
        <li>Any inaccurate information displayed on the website (unless due to our negligence).</li>
    </ul>

    <br>

    <h4>Prohibited Activities</h4>
    <p>You agree not to:</p>
    <ul>
        <li>Use our site to commit fraud or submit false information.</li>
        <li>Interfere with the security, integrity, or performance of the website.</li>
        <li>Use automated tools (bots, scrapers, crawlers) without our permission.</li>
    </ul>

    <br>

    <h4>Third-Party Links</h4>
    <p>
        Our website may contain links to third-party websites. These are provided for convenience only.
        Vibora UK is not responsible for the content, services, or policies of external sites.
    </p>

    <br>

    <h4>Changes to These Terms</h4>
    <p>
        We may update or revise these Terms occasionally.
        By continuing to use the site after changes are posted, you accept the updated Terms.
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