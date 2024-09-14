@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tableau de bord de l'admin</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Utilisateurs</h5>
                    <p class="card-text">{{ $totalUsers }}</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Voir les utilisateurs</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Produits</h5>
                    <p class="card-text">{{ $totalProducts }}</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Voir les produits</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
