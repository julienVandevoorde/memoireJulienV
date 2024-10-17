@extends('layouts.app')

@section('content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="dashboard-container">
    <h1 class="dashboard-title text-center mb-5">Admin Dashboard</h1>

    <div class="row justify-content-center">
        <!-- Total users -->
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h2>Users</h2>
                    <a href="{{ route('admin.users.index') }}" class="custom-button">View Users</a>
                </div>
            </div>
        </div>

        <!-- Total products -->
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="stat-info">
                    <h2>Products</h2>
                    <a href="{{ route('admin.products.index') }}" class="custom-button">View Products</a>
                </div>
            </div>
        </div>

        <!-- Order management -->
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-info">
                    <h2>Orders</h2>
                    <a href="{{ route('admin.orders.index') }}" class="custom-button">Manage Orders</a>
                </div>
            </div>
        </div>

        <!-- Report management -->
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-flag"></i>
                </div>
                <div class="stat-info">
                    <h2>Reports</h2>
                    <a href="{{ route('admin.reports.index') }}" class="custom-button">View Reports</a>
                </div>
            </div>
        </div>

        <!-- Tattoo management -->
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-flag"></i>
                </div>
                <div class="stat-info">
                    <h2>Tattoos</h2>
                    <a href="{{ route('admin.portfolios.index') }}" class="custom-button">View Tattoos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
