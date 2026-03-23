@extends('layouts.app')

@section('title', 'Reviews')

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
                    <li><a href="{{ url('/reviews') }}" class="active">Reviews</a></li>
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

<section id="reviews" style="max-width: 900px; margin: 40px auto; padding: 20px;">
    <h1>REVIEWS</h1>
    <p>Share your experience with Vibora UK and read what other customers have said.</p>

    @if(session('success'))
        <div style="background:#dff0d8; color:#3c763d; padding:12px; border-radius:8px; margin:15px 0;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background:#f2dede; color:#a94442; padding:12px; border-radius:8px; margin:15px 0;">
            <ul style="margin:0; padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reviews.store') }}" method="POST" style="display:flex; flex-direction:column; gap:15px; margin:25px 0;">
        @csrf

        <input type="text" name="title" placeholder="Review title" required>

        <select name="rating" required>
            <option value="">Select Rating</option>
            <option value="5">5 - Excellent</option>
            <option value="4">4 - Very Good</option>
            <option value="3">3 - Good</option>
            <option value="2">2 - Fair</option>
            <option value="1">1 - Poor</option>
        </select>

        <textarea name="body" rows="6" placeholder="Write your review here..." required></textarea>

        <button type="submit" id="review-submit">Submit Review</button>
    </form>

  <div id="reviews-list">
    @forelse($reviews as $review)
        <div class="review-card">
            <h3>{{ $review->title }}</h3>
            <p class="review-rating">Rating: {{ $review->rating }}/5</p>
            <p class="review-body">{{ $review->body }}</p>
            <p class="review-date">{{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}</p>
        </div>
    @empty
        <p>No reviews yet.</p>
    @endforelse
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