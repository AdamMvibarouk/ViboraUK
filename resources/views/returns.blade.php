@extends('layouts.app')

@section('title', 'Returns')

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
    <h4>Returns</h4>

    <p>
        At Vibora UK, we want every customer to feel confident and satisfied with their purchase.
        If for any reason you are not completely happy with your order, we offer a straightforward
        returns process designed to make resolving issues simple and fair. We encourage customers
        to contact us as soon as they notice a problem or decide that they would like to return an
        item, as timely communication allows us to address matters efficiently.
    </p>

    <br>

    <p>
        Customers may return unwanted items within a reasonable timeframe, provided the products are
        in their original condition. This generally means that the item must be unused, undamaged,
        and in its original packaging, including any accessories, labels, or protective materials
        that came with it. We reserve the right to refuse a return if the product shows signs of use,
        wear, or damage that make it unsuitable for resale. Once we receive and inspect a returned
        item, we will determine whether it qualifies for a refund or exchange based on its condition
        and compliance with the terms of this policy.
    </p>

    <br>

    <p>
        To initiate a return, customers should contact us with their order details and a brief
        explanation of why they wish to return the item. Our team will provide instructions on how
        and where to send the product. It is the customer’s responsibility to ensure that returned
        items are packaged securely, as we cannot accept responsibility for goods that are lost or
        damaged in transit back to us. We recommend choosing a tracked or insured shipping method
        for peace of mind. Unless the return is due to an error on our part or a faulty product,
        the cost of returning the item is the customer’s responsibility.
    </p>

    <br>

    <p>
        If an item is found to be faulty, damaged, or incorrect upon arrival, we ask that customers
        inform us as soon as possible. In these situations, we may request photographs or additional
        details to help us assess the issue before arranging a replacement, repair, or refund.
        Faulty or incorrect items will typically be eligible for a full refund or an exchange at no
        additional cost to the customer. We aim to resolve these cases promptly and fairly in
        accordance with applicable consumer protection laws.
    </p>

    <br>

    <p>
        Refunds are processed once the returned item has been received and inspected. If approved,
        the refund will be issued to the original payment method. Processing times may vary depending
        on payment providers, but we will issue the refund from our end as quickly as possible.
        Delivery fees are generally non-refundable unless the return is the result of an error or
        defect. Exchanges will be dispatched as soon as the original product has been returned and
        approved for replacement.
    </p>

    <br>

    <p>
        Some items may not be eligible for return due to hygiene reasons, customisation, or special
        conditions related to the nature of the product. Any such exceptions will be clearly stated
        on the product page at the time of purchase. We encourage customers to read product
        descriptions carefully and contact us if they have any questions before completing their
        order.
    </p>

    <br>

    <p>
        Our aim is always to ensure that our returns process is fair, transparent, and easy to
        navigate. If you have any concerns or require support at any stage of the returns procedure,
        our team is here to assist you and provide guidance.
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