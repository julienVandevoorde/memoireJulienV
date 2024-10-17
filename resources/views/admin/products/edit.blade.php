@extends('layouts.app')

@section('content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="dashboard-container">
    <!-- Product edit form -->
    <div class="small-form">
        <h3>Edit Product</h3>
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" id="productName" name="name" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label for="productDescription">Description</label>
                <textarea id="productDescription" name="description" required>{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="productPrice">Price</label>
                <input type="number" step="0.01" id="productPrice" name="price" value="{{ $product->price }}" required>
            </div>
            <div class="form-group">
                <label for="productStock">Stock Quantity</label>
                <input type="number" id="productStock" name="stock_quantity" value="{{ $product->stock_quantity }}" required>
            </div>
            <div class="form-group">
                <label for="productCategory">Category</label>
                <input type="text" id="productCategory" name="category" value="{{ $product->category }}">
            </div>
            <div class="form-group">
                <label for="productImage">Product Image</label>
                <input type="file" id="productImage" name="image_path">
            </div>
            <div class="form-group">
                <button type="submit" class="small-button">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
