@extends('layouts.app')

@section('title', 'Admin Inventory')

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
    <div class="admin-topbar">
        <h1>Inventory Management</h1>
    </div>

    @if(session('success'))
        <div class="admin-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="admin-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="admin-section">
        <h2>Add New Product</h2>

        <form method="POST" action="{{ route('admin.products.store') }}" class="admin-form-grid">
            @csrf

            <input type="text" name="name" placeholder="Product name" required>
            <input type="text" name="slug" placeholder="Slug" required>
            <textarea name="description" placeholder="Description" rows="4"></textarea>
            <input type="text" name="image_url" placeholder="Image filename / URL">
            <input type="number" step="0.01" name="base_price" placeholder="Price" required>
            <input type="text" name="category_id" placeholder="Category ID" required>

            <button type="submit" class="admin-action-btn">Add Product</button>
        </form>
    </div>

    <div class="admin-section">
        <h2>All Products</h2>

        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Category ID</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->slug }}</td>
                            <td>£{{ number_format((float) $product->base_price, 2) }}</td>
                            <td>{{ $product->image_url }}</td>
                            <td>{{ $product->category_id }}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->product_id ?? $product->id) }}" class="admin-small-btn">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.products.delete', $product->product_id ?? $product->id) }}" onsubmit="return confirm('Delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-small-btn danger-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection