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
                <!-- Display profile image without the ability to change it -->
                <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/defaultProfile.jpg') }}" id="output" width="165" />
            </div>

            <!-- Profile Navigation -->
            <div class="profile-navigation">
                <!-- Link to send a message to the client via Chatify -->
                <a href="{{ url('/chatify', $user->id) }}">Send a message</a>
                <!-- Link to report the user -->
                <a href="{{ route('report.user.form', $user->id) }}">Report</a>
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

            <!-- Bio Section -->
            <div class="profile-description">
                <h3>Bio</h3>
                <p class="field-value">{{ $user->bio ?? 'No bio provided.' }}</p>
            </div>
        </div>
    </div>
</div>

@endsection
