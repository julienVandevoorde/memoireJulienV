@extends('layouts.app')

@section('content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="dashboard-container">
<h1 class="text-center mb-5">Gestion des tatouages</h1>

    <!-- Formulaire de recherche de tatouages -->
    <div class="search-form">
        <h3>Recherche de tatouages</h3>
        <form action="{{ route('admin.portfolios.index') }}" method="GET">
            <div class="form-group">
                <label for="searchTitle">Nom du tatouage</label>
                <input type="text" id="searchTitle" name="title" value="{{ request('title') }}">
            </div>
            <div class="form-group">
                <button type="submit" class="small-button">Rechercher</button>
            </div>
        </form>
    </div>

    <!-- Gestion des tatouages -->
    <div class="table-container">
        <h3>Gestion des tatouages</h3>
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Artiste</th>
                    <th>Date de création</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($portfolios as $portfolio)
                    <tr>
                        <td>{{ $portfolio->title }}</td>
                        <td>{{ $portfolio->user->name }}</td> <!-- Lien avec l'utilisateur -->
                        <td>{{ $portfolio->created_at->format('d/m/Y') }}</td>
                        <td>
                            @if($portfolio->image_path)
                                <img src="{{ asset('storage/' . $portfolio->image_path) }}" alt="{{ $portfolio->title }}" width="50">
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="custom-button" type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            {{ $portfolios->links() }}
        </div>
    </div>

</div>

@endsection
