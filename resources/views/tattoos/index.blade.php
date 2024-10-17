@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/tattoos.css') }}">

<div class="tattoos-container">
    <h1>Discover Tattoos</h1>

    <div class="search-bar">
        <!-- If the user is logged in, show "My Likes" on the left -->
        @if(auth()->check())
            <a href="{{ route('tattoos.index', ['liked' => 'true']) }}" class="btn-likes">
                {{ request('liked') === 'true' ? 'All Tattoos' : 'My Likes' }}
            </a>
        @endif

        <form action="{{ route('tattoos.index') }}" method="GET">
            <input type="text" name="search" placeholder="Search by keywords..." value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="tattoo-feed">
        @foreach ($tattooImages as $tattoo)
            <div class="tattoo-item">
                <img src="{{ asset('storage/' . $tattoo->image_path) }}" alt="Tattoo by {{ $tattoo->user->name }}" class="tattoo-image">
                <div class="tattoo-info">
                    <p><strong>{{ $tattoo->title }}</strong></p>
                    <p><a href="{{ route('profile.showProfile', $tattoo->user->login) }}" class="tattoo-artist-link">&#64;{{ $tattoo->user->login }}</a></p>

                    <!-- Show features only if the user is logged in -->
                    @if(auth()->check())
                        <!-- Like/Unlike button -->
                        <label class="like">
                            <input type="checkbox" class="like-checkbox" data-tattoo-id="{{ $tattoo->id }}" {{ $tattoo->isLikedBy(auth()->user()) ? 'checked' : '' }}>
                            <div class="checkmark">
                                <svg viewBox="0 0 256 256">
                                    <rect fill="none" height="256" width="256"></rect>
                                    <path d="M224.6,51.9a59.5,59.5,0,0,0-43-19.9,60.5,60.5,0,0,0-44,17.6L128,59.1l-7.5-7.4C97.2,28.3,59.2,26.3,35.9,47.4a59.9,59.9,0,0,0-2.3,87l83.1,83.1a15.9,15.9,0,0,0,22.6,0l81-81C243.7,113.2,245.6,75.2,224.6,51.9Z" stroke-width="20px" stroke="#FFF" fill="none"></path>
                                </svg>
                            </div>
                        </label>

                        <!-- Report button as a PNG image -->
                        <a href="{{ route('tattoo.report', $tattoo->id) }}" class="report-icon">
                            <img src="{{ asset('images/signe-dalerte.png') }}" alt="Report Icon" width="20" height="20"> <!-- Custom PNG icon -->
                            <span class="tooltip-text">Report</span>
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div id="imageModal" class="modal">
    <img class="modal-content" id="modalImage">
    <div id="caption"></div>
</div>

<script>
    // Handle click on images to enlarge
    document.querySelectorAll('.tattoo-image').forEach(image => {
        image.addEventListener('click', function() {
            const modal = document.getElementById("imageModal");
            const modalImg = document.getElementById("modalImage");
            const captionText = document.getElementById("caption");

            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        });
    });

    // Close modal when clicking outside the image
    const modal = document.getElementById("imageModal");

    modal.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Handle likes with authentication check
    document.querySelectorAll('.like-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const tattooId = this.dataset.tattooId;
            const method = this.checked ? 'POST' : 'DELETE';
            const url = this.checked ? `/tattoos/${tattooId}/like` : `/tattoos/${tattooId}/unlike`;

            fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // You can add logic to update the UI here if needed
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>

@endsection
