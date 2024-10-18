@extends('layouts.app')

@section('content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="dashboard-container">
<h1 class="text-center mb-5">Product Management</h1>

    <!-- Container for adding and searching products -->
    <div class="form-row">
        <!-- Add product form -->
        <div class="small-form">
            <h3>Add Product</h3>
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" id="productName" name="name" required>
                </div>
                <div class="form-group">
                    <label for="productDescription">Description</label>
                    <textarea id="productDescription" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="productPrice">Price</label>
                    <input type="number" step="0.01" id="productPrice" name="price" required>
                </div>
                <div class="form-group">
                    <label for="productStock">Stock Quantity</label>
                    <input type="number" id="productStock" name="stock_quantity" required>
                </div>
                <div class="form-group">
                    <label for="productCategory">Category</label>
                    <input type="text" id="productCategory" name="category">
                </div>
                <div class="form-group">
                    <label for="productImage">Product Image</label>
                    <input type="file" id="productImage" name="image_path">
                </div>
                <div class="form-group">
                    <button type="submit" class="small-button">Save</button>
                </div>
            </form>
        </div>

        <!-- Search product form -->
        <div class="search-form">
            <h3>Search Products</h3>
            <form action="{{ route('admin.products.index') }}" method="GET">
                <div class="form-group">
                    <label for="searchName">Product Name</label>
                    <input type="text" id="searchName" name="name">
                </div>
                <div class="form-group">
                    <label for="searchCategory">Category</label>
                    <input type="text" id="searchCategory" name="category">
                </div>
                <div class="form-group">
                    <label for="minPrice">Minimum Price</label>
                    <input type="number" step="0.01" id="minPrice" name="min_price">
                </div>
                <div class="form-group">
                    <label for="maxPrice">Maximum Price</label>
                    <input type="number" step="0.01" id="maxPrice" name="max_price">
                </div>
                <div class="form-group">
                    <button type="submit" class="small-button">Search</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Product management table -->
    <div class="table-container">
        <h3>Manage Products</h3>
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
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
                        <td>{{ $product->category }}</td>
                        <td>
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" width="50">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product) }}" class="custom-button">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="custom-button" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection
