@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">

<div class="about-container">
<!-- Hero Section Simple -->
<section class="hero-section">
    <h1>About Us</h1>
</section>
<br>
<br>



    <!-- Our Story Section with two columns -->
    <section class="story-section">
        <div class="story-content">
            <div class="story-text">
                <h2>Our Story</h2>
                <p>Founded with passion and dedication, we have been providing quality services in the tattoo industry for years. Our vision is to connect talented tattoo artists with clients seeking unique and meaningful tattoos. Each tattoo tells a story, and we are here to bring those stories to life through exceptional craftsmanship.</p>
            </div>
            <div class="story-image">
                <img src="{{ asset('images/tattoo-zeph.jpg') }}" alt="Tattoo Story Image">
            </div>
        </div>
    </section>

    <!-- Our Mission Section -->
    <section class="mission-section">
        <div class="mission-content">
            <div class="mission-image">
                <img src="{{ asset('images/tattooShark.jpg') }}" alt="Tattoo Ink">
            </div>
            <div class="mission-text">
                <h2>Our Mission</h2>
                <p>Our mission is simple: to provide the best platform for both artists and clients. Whether you're looking for your next tattoo or seeking a space to showcase your art, we offer a seamless experience from start to finish. We believe in creativity, authenticity, and the power of self-expression through tattoos.</p>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="contact-section">
        <h2>Contact Us</h2>
        <p>Have questions? Want to learn more about what we offer? <br>Feel free to get in touch with us.</p>

        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea name="message" id="message" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-submit">Send Message</button>
            </div>
        </form>
    </section>
</div>

@endsection
