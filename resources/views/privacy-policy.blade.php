@extends('layouts.app')

@section('title', 'Privacy Policy')

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
        <a href="{{ url('/account') }}" class="login-btn">Login</a>
    </div>
</header>

<section class="policy-page">
    <h4>Privacy Policy</h4>

    <p>
        We collect information that you provide directly to us when you create an account, place an order,
        contact our support team, subscribe to our newsletter, or participate in any promotional activity.
        This information may include your name, email address, phone number, billing and shipping details,
        and any information required to complete your purchase. Payment details are processed securely by our
        authorised payment partners and are not stored on our servers.
    </p>

    <br>

    <p>
        When you visit our website, certain information is gathered automatically to help us better understand
        how our visitors use the site. This may include your IP address, device details, browser type, pages viewed,
        time spent on the site, and general usage data. We may also receive information from third parties,
        including payment providers, delivery partners, and marketing platforms, when required for order processing
        or service improvements.
    </p>

    <br>

    <p>
        We use your personal information to process and deliver your orders, manage your account, communicate with you
        about purchases or enquiries, and enhance your shopping experience. Your information also helps us maintain
        the security and functionality of our website, personalise content, send marketing communications when you
        have provided consent, prevent fraud, and comply with legal obligations. Under UK GDPR, we rely on several
        legal bases for processing your information, such as fulfilling a contract, obtaining your consent,
        pursuing legitimate interests like website optimisation, and meeting legal responsibilities.
    </p>

    <br>

    <p>
        We do not sell your personal information. However, we may share your data with trusted service providers
        who help us operate our business. These may include payment processors, delivery companies, website hosting
        services, analytics providers, and professional advisers. These third parties are required to use your
        information only for the services they provide and must keep it secure.
    </p>

    <br>

    <p>
        Under UK GDPR, you have several rights regarding your personal data. These include the right to access
        the information we hold about you, request corrections to inaccurate data, request deletion of your information,
        restrict or object to certain types of processing, request a copy of your data in a transferable format,
        and withdraw your consent when processing is based on consent. If you wish to exercise any of these rights,
        you can contact us through our contact page.
    </p>

    <br>

    <p>
        This Privacy Policy may be updated from time to time to reflect changes in our practices or legal requirements.
        The date at the top of the page will indicate the most recent version. Continued use of our website following
        updates means you accept the revised Policy.
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