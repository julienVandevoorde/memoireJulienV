@extends('layouts.app')

@section('content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="dashboard-container">
    <h1 class="dashboard-title text-center mb-5">Tableau de bord de l'admin</h1>

    <div class="row justify-content-center">
        <!-- Total utilisateurs -->
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h2>Utilisateurs</h2>
                    <a href="{{ route('admin.users.index') }}" class="custom-button">Voir les utilisateurs</a>
                </div>
            </div>
        </div>

        <!-- Total produits -->
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="stat-info">
                    <h2>Produits</h2>
                    <a href="{{ route('admin.products.index') }}" class="custom-button">Voir les produits</a>
                </div>
            </div>
        </div>

        <!-- Gestion des commandes -->
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-info">
                    <h2>Commandes</h2>
                    <a href="{{ route('admin.orders.index') }}" class="custom-button">Gérer les commandes</a>
                </div>
            </div>
        </div>

        <!-- Gestion des signalements -->
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-flag"></i>
                </div>
                <div class="stat-info">
                    <h2>Signalements</h2>
                    <a href="{{ route('admin.reports.index') }}" class="custom-button">Voir les signalements</a>
                </div>
            </div>
        </div>

                <!-- Gestion des tatouages -->
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-flag"></i>
                </div>
                <div class="stat-info">
                    <h2>Tatouages</h2>
                    <a href="{{ route('admin.portfolios.index') }}" class="custom-button">Voir les signalements</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
