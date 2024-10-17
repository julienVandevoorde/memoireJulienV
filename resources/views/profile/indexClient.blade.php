@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<!-- Main container for the profile layout -->
<div class="profile-wrapper">
    <div class="profile-container">
        <!-- Left Column: Profile Picture and Navigation -->
        <div class="profile-left">
            <!-- Profile Picture -->
            <div class="profile-pic">
                <form id="upload-photo-form" action="{{ route('profile.uploadPhoto') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input id="file" type="file" name="profile_photo" onchange="submitForm()" />
                    <label class="-label" for="file">
                        <span class="glyphicon glyphicon-camera"></span>
                        <span>Change picture</span>
                    </label>
                    <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/defaultProfile.jpg') }}" id="output" width="165" />
                </form>
            </div>

            <!-- Profile Navigation -->
            <div class="profile-navigation">
                <a href="{{ url('/chatify') }}">My messages</a>
                <a href="{{ route('orders') }}">My orders</a>
                <a href="{{ route('profile.edit') }}">Reset password</a>
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
            <div class="editable-field" data-field="name">
                <h3>Name: <span class="field-value">{{ $user->name }}</span></h3>
                <input type="text" class="field-input" value="{{ $user->name }}" style="display: none;" />
                <button class="edit-button">Edit</button>
                <button class="save-button" style="display: none;">Save</button>
            </div>
            
            <!-- Bio Section -->
            <div class="profile-description editable-field" data-field="bio">
                <h3>Bio</h3>
                <p class="field-value">{{ $user->bio ?? 'The bio is empty.' }}</p>
                <textarea class="field-input" style="display: none;">{{ $user->bio }}</textarea>
                <button class="edit-button">Edit</button>
                <button class="save-button" style="display: none;">Save</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/profile.js') }}"></script> <!-- Include the JS file -->
@endsection
