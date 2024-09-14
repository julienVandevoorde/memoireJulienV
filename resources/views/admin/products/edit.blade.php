@extends('layouts.app')

@section('content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="dashboard-container">
    <!-- Formulaire de modification du produit -->
    <div class="small-form">
        <h3>Modifier le produit</h3>
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="productName">Nom du produit</label>
                <input type="text" id="productName" name="name" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label for="productDescription">Description</label>
                <textarea id="productDescription" name="description" required>{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="productPrice">Prix</label>
                <input type="number" step="0.01" id="productPrice" name="price" value="{{ $product->price }}" required>
            </div>
            <div class="form-group">
                <label for="productStock">Quantité en stock</label>
                <input type="number" id="productStock" name="stock_quantity" value="{{ $product->stock_quantity }}" required>
            </div>
            <div class="form-group">
                <label for="productCategory">Catégorie</label>
                <input type="text" id="productCategory" name="category" value="{{ $product->category }}">
            </div>
            <div class="form-group">
                <label for="productImage">Image du produit</label>
                <input type="file" id="productImage" name="image_path">
            </div>
            <div class="form-group">
                <button type="submit" class="small-button">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection
