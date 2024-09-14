@extends('layouts.app')

@section('content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="dashboard-container">

    <!-- Conteneur pour les formulaires d'ajout et de recherche de produits -->
    <div class="form-row">
        <!-- Formulaire d'ajout de produit -->
        <div class="small-form">
            <h3>Ajouter un produit</h3>
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="productName">Nom du produit</label>
                    <input type="text" id="productName" name="name" required>
                </div>
                <div class="form-group">
                    <label for="productDescription">Description</label>
                    <textarea id="productDescription" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="productPrice">Prix</label>
                    <input type="number" step="0.01" id="productPrice" name="price" required>
                </div>
                <div class="form-group">
                    <label for="productStock">Quantité en stock</label>
                    <input type="number" id="productStock" name="stock_quantity" required>
                </div>
                <div class="form-group">
                    <label for="productCategory">Catégorie</label>
                    <input type="text" id="productCategory" name="category">
                </div>
                <div class="form-group">
                    <label for="productImage">Image du produit</label>
                    <input type="file" id="productImage" name="image_path">
                </div>
                <div class="form-group">
                    <button type="submit" class="small-button">Enregistrer</button>
                </div>
            </form>
        </div>

        <!-- Formulaire de recherche de produit -->
        <div class="search-form">
            <h3>Recherche de produits</h3>
            <form action="{{ route('admin.products.index') }}" method="GET">
                <div class="form-group">
                    <label for="searchName">Nom du produit</label>
                    <input type="text" id="searchName" name="name">
                </div>
                <div class="form-group">
                    <label for="searchCategory">Catégorie</label>
                    <input type="text" id="searchCategory" name="category">
                </div>
                <div class="form-group">
                    <label for="minPrice">Prix minimum</label>
                    <input type="number" step="0.01" id="minPrice" name="min_price">
                </div>
                <div class="form-group">
                    <label for="maxPrice">Prix maximum</label>
                    <input type="number" step="0.01" id="maxPrice" name="max_price">
                </div>
                <div class="form-group">
                    <button type="submit" class="small-button">Rechercher</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Gestion des produits -->
    <div class="table-container">
        <h3>Gestion des produits</h3>
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Quantité en stock</th>
                    <th>Catégorie</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock_quantity }}</td>
                        <td>{{ $product->category }}</td>
                        <td>
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" width="50">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product) }}" class="custom-button">Modifier</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="custom-button" type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection
