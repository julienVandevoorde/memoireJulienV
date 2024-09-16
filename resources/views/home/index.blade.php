{{-- resources/views/home/index.blade.php --}}

@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<div class="hero-section">
    <div class="hero-content">
        <div class="text-center">
            <h1 class="main-title">NeedleInkNow</h1>
            <h2 class="subtitle">a platform made by tattoo lovers, for tattoo lovers</h2>
            <a class="btn btn-primary" href="{{ route('artists.index') }}">find my tattoo artist</a>
        </div>
    </div>
</div>

@endsection
