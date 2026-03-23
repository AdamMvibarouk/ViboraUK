@extends('layouts.app')

@section('title', 'Edit Product')

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
            <li><a href="{{ route('admin.dashboard') }}">DASHBOARD</a></li>
            <li><a href="{{ route('admin.inventory') }}" class="active">INVENTORY</a></li>
        </ul>
    </nav>

    <div class="login">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="login-btn">Logout</button>
        </form>
    </div>
</header>

<div class="admin-page">
    <div class="admin-section">
        <h1>Edit Product</h1>

        <form method="POST" action="{{ route('admin.products.update', $product->product_id ?? $product->id) }}" class="admin-form-grid">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $product->name }}" required>
            <input type="text" name="slug" value="{{ $product->slug }}" required>
            <textarea name="description" rows="4">{{ $product->description }}</textarea>
            <input type="text" name="image_url" value="{{ $product->image_url }}">
            <input type="number" step="0.01" name="base_price" value="{{ $product->base_price }}" required>
            <input type="text" name="category_id" value="{{ $product->category_id }}" required>

            <button type="submit" class="admin-action-btn">Save Changes</button>
        </form>
    </div>
</div>
@endsection