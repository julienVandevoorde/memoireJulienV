@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">

<div class="about-container">
    <!-- Section About Us -->
    <div class="about-content">
        <h1>About Us</h1>
        <p>Welcome to our platform where tattoo artists and clients connect. Our mission is to provide a seamless experience for everyone, whether you are looking to showcase your art or find the perfect tattoo. We believe in creativity, artistry, and the power of self-expression through tattoos.</p>

        <p>Founded by tattoo enthusiasts, our platform is designed to create a community where everyone can feel comfortable and inspired. Whether you're a tattoo artist or someone looking to get inked, we provide the tools and features to make this process as smooth as possible.</p>

        <p>Thank you for being a part of our journey!</p>
    </div>

    <!-- Section Contact Us -->
    <div class="contact-section">
        <h2>Contact Us</h2>
        <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
            @csrf
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn-submit">Send Message</button>
        </form>
    </div>
</div>

@endsection
