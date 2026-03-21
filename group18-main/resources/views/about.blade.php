@extends('layouts.app')

@section('title', 'About Us')

@section('content')

<header id="main-header">
    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/Vibora UK.png') }}" alt="Vibora UK logo">
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
            <li><a href="{{ url('/about') }}" class="active">About Us</a></li>
            <li><a href="{{ url('/contact') }}">Contact</a></li>
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

<main>
    <section class="hero">
        <h1>ABOUT OUR BRAND</h1>
        <p>PASSION. PERFORMANCE. PADEL.</p>
    </section>

    <section class="content-wrapper">
        <div class="about-content">
            <h2>WHO WE ARE</h2>
            <p>
                Welcome to PADEL UK. We aren't just another online store;
                <strong>we are a group of professional, UK-based padel players</strong>
                who live and breathe the sport. We've experienced the scramble for gear firsthand and
                wanted to change the game.
            </p>
            <p>
                Our mission is simple: <strong>to help local players get easy accessibility
                to top-quality equipment</strong> without the hassle. We're dedicated
                to giving you the very best, with a focus on quality, performance, and
                the cutting-edge style that brands like Vibora are known for.
            </p>

            <div class="about-section">
                <div class="about-image-placeholder">
                    <img src="{{ asset('images/Ppitch.png') }}" alt="A local UK padel court or your team playing">
                </div>
                <div class="about-text">
                    <h3>OUR STORY</h3>
                    <p>
                        <strong>Talk about your journey here.</strong> How did your group of pro players
                        come together? What problems did you see in the UK padel market?
                        This is a great place to build a personal connection.
                    </p>
                    <p>
                        For example: <i>"After years of competing and seeing friends
                        struggle to find elite rackets... We decided to leverage our
                        professional connections to source the best gear directly..."</i>
                    </p>
                </div>
            </div>

            <div class="about-section reverse">
                <div class="about-image-placeholder">
                    <img src="{{ asset('images/closeUP.png') }}" alt="Closeup of high-quality padel rackets or gear">
                </div>
                <div class="about-text">
                    <h3>WHY CHOOSE US?</h3>
                    <p>
                        <strong>Expand on your unique selling points.</strong> What does "pro-player
                        approved" really mean for the customer?
                    </p>
                    <ul>
                        <li>
                            <strong>Pro-Player Curated:</strong> Every item on this site
                            is tested and approved by us. We don't sell anything we
                            wouldn't use in a tournament.
                        </li>
                        <li>
                            <strong>UK Stock & Support:</strong> No more waiting for
                            international shipping. All stock is right here in the UK,
                            and our team can give you genuine, expert advice.
                        </li>
                        <li>
                            <strong>Community Focused:</strong> We're building more than a
                            store. We're building a community. Look out for our upcoming
                            clinics, events, and player spotlights.
                        </li>
                    </ul>
                </div>
            </div>

            <h3 class="team-heading">MEET THE TEAM</h3>

            <div class="team-grid">
                <div class="team-member">
                    <img src="{{ asset('images/T1.png') }}" alt="Team Member 1 Headshot">
                    <h4>ANESH NAYYAR</h4>
                    <p>Apparel & Footwear Expert</p>
                </div>

                <div class="team-member">
                    <img src="{{ asset('images/T2.png') }}" alt="Team Member 2 Headshot">
                    <h4>JOSEBA BILBAO</h4>
                    <p>Head Coach</p>
                </div>

                <div class="team-member">
                    <img src="{{ asset('images/T3.png') }}" alt="Team Member 3 Headshot">
                    <h4>AJAY SANGHA</h4>
                    <p>Community Manager</p>
                </div>

                <div class="team-member">
                    <img src="{{ asset('images/T4.png') }}" alt="Team Member 4 Headshot">
                    <h4>AHMED AHMED</h4>
                    <p>E-commerce Manager</p>
                </div>

                <div class="team-member">
                    <img src="{{ asset('images/T5.png') }}" alt="Team Member 5 Headshot">
                    <h4>ADAM JAMA</h4>
                    <p>Content Creator</p>
                </div>

                <div class="team-member">
                    <img src="{{ asset('images/T6.png') }}" alt="Team Member 6 Headshot">
                    <h4>SOYED TANIM</h4>
                    <p>Community Manager</p>
                </div>

                <div class="team-member">
                    <img src="{{ asset('images/T7.png') }}" alt="Team Member 7 Headshot">
                    <h4>MACDONALD EMESHIEOBI</h4>
                    <p>Lead Product Curator</p>
                </div>

                <div class="team-member">
                    <img src="{{ asset('images/T8.png') }}" alt="Team Member 8 Headshot">
                    <h4>ADAM MAHMOOD</h4>
                    <p>Racket Specialist</p>
                </div>
            </div>
        </div>
    </section>
</main>

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

    <p>&copy; 2025 VIBORA UK. All rights reserved.</p>
</footer>

@endsection

@section('scripts')
<script src="{{ asset('js/scriptARM.js') }}"></script>
@endsection