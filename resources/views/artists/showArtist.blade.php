@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<!-- Main container for the profile -->
<div class="profile-wrapper">
    <div class="profile-container">
        <!-- Left Column: Profile Photo and Navigation -->
        <div class="profile-left">
            <!-- Profile Photo -->
            <div class="profile-pic">
                <!-- Profile image without edit button -->
                <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/defaultProfile.jpg') }}" id="output" width="165" />
            </div>

            <!-- Profile Navigation -->
            <div class="profile-navigation">
                <a href="{{ url('/chatify/' . $user->id) }}">Send a message</a>
                <a href="{{ route('report.user.form', $user->id) }}">Report</a> <!-- Link to report the user -->
            </div>
        </div>

        <!-- Right Column: Profile Information -->
        <div class="profile-info">
            <div>
                <h1>STATUS: {{ $user->role }}</h1>
            </div>
            <div>
                <h3>Login: @<span class="field-value">{{ $user->login }}</span></h3>
            </div>
            <div>
                <h3>Name: <span class="field-value">{{ $user->name }}</span></h3>
            </div>
            <div>
                <h3>Instagram Link: <span class="field-value">{{ $user->instagram_link }}</span></h3>
            </div>
            <div>
                <h3>Location: <span class="field-value">{{ $user->location }}</span></h3>
            </div>

            <!-- Tattoo Styles -->
            <div>
                <h3>Tattoo Styles: <span class="field-value">{{ implode(', ', $user->styles->pluck('name')->toArray()) }}</span></h3>
            </div>
            
            <!-- Bio Section -->
            <div class="profile-description">
                <h3>Bio</h3>
                <p class="field-value">{{ $user->bio ?? 'No bio provided.' }}</p>
            </div>
        </div>
    </div>

    <!-- Portfolio Section -->
    <div class="portfolio-section">
        <h3>@<span class="field-value">{{ $user->login }}'s portfolio</h3>

        <!-- Display portfolio images without delete options -->
        <div class="portfolio-gallery">
            @foreach($user->portfolios as $portfolio)
                <div class="portfolio-item">
                    <img src="{{ asset('storage/' . $portfolio->image_path) }}" alt="{{ $portfolio->title }}">
                    <p>{{ $portfolio->title }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
