@extends('layouts.app')

@section('title', 'Admin Dashboard')

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
            <li><a href="{{ route('admin.dashboard') }}" class="active">DASHBOARD</a></li>
            <li><a href="{{ route('admin.inventory') }}">INVENTORY</a></li>
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
        <h1>Admin Dashboard</h1>
        <a href="{{ route('admin.inventory') }}" class="admin-action-btn">Go to Inventory</a>
    </div>

    <div class="admin-stats">
        <div class="admin-stat-card">
            <h3>Total Orders</h3>
            <p>{{ count($orders) }}</p>
        </div>

        <div class="admin-stat-card">
            <h3>Total Customers</h3>
            <p>{{ count($users) }}</p>
        </div>
    </div>

    <div class="admin-section">
        <h2>Recent Orders</h2>

        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->order_id ?? 'N/A' }}</td>
                            <td>{{ $order->user_id ?? 'N/A' }}</td>
                            <td>{{ $order->status ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="admin-section">
        <h2>Customer Management</h2>

        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->first_name ?? 'N/A' }}</td>
                            <td>{{ $user->last_name ?? 'N/A' }}</td>
                            <td>{{ $user->email ?? 'N/A' }}</td>
                            <td>{{ $user->phone ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection