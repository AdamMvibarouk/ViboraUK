@extends('layouts.app')

@section('title', 'Services')

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
                    <li><a href="{{ url('/services') }}" class="active">Services</a></li>
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
<a href="{{ url('/account') }}" class="login-btn">My Account</a>
@else
<a href="{{ url('/account') }}" class="login-btn">Login</a>
@endauth
</div>

</header>

<section class="services-hero">
    <div class="services-hero-overlay">
        <p class="services-eyebrow">Vibora UK Services</p>
        <h1>Professional support for every part of your game</h1>
        <p class="services-hero-text">
            Book premium coaching, delivery upgrades, and equipment support directly through Vibora UK.
        </p>
    </div>
</section>

<section class="services-shop">
    <div class="services-intro-box">
        <h2>Bookable Services</h2>
        <p>
            Add services to your basket just like products. Whether you want coaching, expert guidance,
            or priority fulfilment, we’ve got you covered.
        </p>
    </div>

    <div class="services-grid-shop">
        <div class="service-product-card featured-service">
            <div class="service-badge">Popular</div>
            <div class="service-product-icon"></div>
            <h3>Beginner Coaching Session</h3>
            <p>One-to-one introductory coaching session designed to build confidence and core padel skills.</p>
            <div class="service-meta">45 mins · 1 player</div>
            <div class="service-price">£35.00</div>
            <button
                type="button"
                class="add-to-basket-btn service-btn"
                data-product-id="service-beginner-coaching"
                data-product-name="Beginner Coaching Session"
                data-product-price="35.00"
            >
                Add to Basket
            </button>
        </div>

        <div class="service-product-card">
            <div class="service-product-icon"></div>
            <h3>Advanced Coaching Session</h3>
            <p>High-level coaching focused on tactical awareness, technique refinement, and competitive play.</p>
            <div class="service-meta">60 mins · 1 player</div>
            <div class="service-price">£55.00</div>
            <button
                type="button"
                class="add-to-basket-btn service-btn"
                data-product-id="service-advanced-coaching"
                data-product-name="Advanced Coaching Session"
                data-product-price="55.00"
            >
                Add to Basket
            </button>
        </div>

        <div class="service-product-card">
            <div class="service-product-icon">🔧</div>
            <h3>Racket Maintenance Check</h3>
            <p>Keep your racket match-ready with a professional condition check and basic maintenance review.</p>
            <div class="service-meta">Quick assessment</div>
            <div class="service-price">£20.00</div>
            <button
                type="button"
                class="add-to-basket-btn service-btn"
                data-product-id="service-racket-maintenance"
                data-product-name="Racket Maintenance Check"
                data-product-price="20.00"
            >
                Add to Basket
            </button>
        </div>

        <div class="service-product-card">
            <div class="service-product-icon"></div>
            <h3>Priority Delivery Upgrade</h3>
            <p>Upgrade your order to fast-track dispatch and receive your items quicker.</p>
            <div class="service-meta">Per order</div>
            <div class="service-price">£9.99</div>
            <button
                type="button"
                class="add-to-basket-btn service-btn"
                data-product-id="service-priority-delivery"
                data-product-name="Priority Delivery Upgrade"
                data-product-price="9.99"
            >
                Add to Basket
            </button>
        </div>

        <div class="service-product-card">
            <div class="service-product-icon"></div>
            <h3>Equipment Consultation</h3>
            <p>Get tailored advice on choosing the right racket, shoes, accessories, and setup for your level.</p>
            <div class="service-meta">Expert guidance</div>
            <div class="service-price">£15.00</div>
            <button
                type="button"
                class="add-to-basket-btn service-btn"
                data-product-id="service-equipment-consultation"
                data-product-name="Equipment Consultation"
                data-product-price="15.00"
            >
                Add to Basket
            </button>
        </div>

        <div class="service-product-card">
            <div class="service-product-icon"></div>
            <h3>Group Coaching Session</h3>
            <p>Ideal for small groups wanting to improve together through structured drills and match guidance.</p>
            <div class="service-meta">60 mins · group session</div>
            <div class="service-price">£80.00</div>
            <button
                type="button"
                class="add-to-basket-btn service-btn"
                data-product-id="service-group-coaching"
                data-product-name="Group Coaching Session"
                data-product-price="80.00"
            >
                Add to Basket
            </button>
        </div>
    </div>

    <div class="services-bottom-banner">
        <div>
            <h2>Need help choosing a service?</h2>
            <p>Contact our team and we’ll point you toward the best option for your needs.</p>
        </div>
        <a href="{{ url('/contact') }}" class="services-contact-btn">Contact Us</a>
    </div>
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
<script>
document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".add-to-basket-btn");

    buttons.forEach((button) => {
        button.addEventListener("click", async () => {
            const productId = button.getAttribute("data-product-id");
            const productName = button.getAttribute("data-product-name");
            const productPrice = button.getAttribute("data-product-price");

            try {
                const res = await fetch("/cart/add", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    credentials: "include",
                    body: JSON.stringify({
                        product_id: productId,
                        name: productName,
                        price: Number(productPrice),
                        quantity: 1
                    })
                });

                const data = await res.json();

                if (!res.ok) {
                    alert(data.message || "Failed to add service to basket.");
                    return;
                }

                alert(productName + " added to basket.");
            } catch (err) {
                console.error("Add service to basket error:", err);
                alert("There was a problem adding this service to the basket.");
            }
        });
    });
});
</script>
@endsection