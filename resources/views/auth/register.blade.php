@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Register</h1>
    <form method="POST" action="{{ route('register') }}" id="registration-form">
        @csrf
        <!-- First Name -->
        <div>
            <label for="first_name">{{ __('First Name') }}</label>
            <input id="first_name" class="block mt-1 w-full" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus />
            @error('first_name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <label for="last_name">{{ __('Last Name') }}</label>
            <input id="last_name" class="block mt-1 w-full" type="text" name="last_name" value="{{ old('last_name') }}" required />
            @error('last_name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Hidden Name Field -->
        <input type="hidden" name="name" id="name">

        <!-- Login -->
        <div class="mt-4">
            <label for="login">{{ __('Login') }}</label>
            <input id="login" class="block mt-1 w-full" type="text" name="login" value="{{ old('login') }}" required />
            @error('login')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div class="mt-4">
            <label for="email">{{ __('Email') }}</label>
            <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required />
            @error('email')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            @error('password')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            @error('password_confirmation')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Role Selection -->
        <div class="mt-4">
            <label for="role">{{ __('Role') }}</label>
            <select id="role" name="role" class="block mt-1 w-full" required>
                <option value="">{{ __('Select Role') }}</option>
                <option value="client">{{ __('Client') }}</option>
                <option value="tattoo artist">{{ __('Tattoo Artist') }}</option>
            </select>
            @error('role')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <label for="gender">{{ __('Gender') }}</label>
            <select id="gender" name="gender" class="block mt-1 w-full">
                <option value="">{{ __('Select Gender') }}</option>
                <option value="male">{{ __('Male') }}</option>
                <option value="female">{{ __('Female') }}</option>
                <option value="non_binary">{{ __('Non-binary') }}</option>
                <option value="other">{{ __('Other') }}</option>
            </select>
            @error('gender')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Location (Tattoo Artist Only) -->
        <div id="location-fields" class="mt-4" style="display: none;">
            <label for="location">{{ __('Location') }}</label>
            <select id="location" name="location" class="block mt-1 w-full">
                <option value="">{{ __('Select Location') }}</option>
                <!-- Les options seront ajoutées ici via AJAX -->
            </select>
            @error('location')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="ml-4 btn btn-primary">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('role').addEventListener('change', function () {
        const locationFields = document.getElementById('location-fields');
        if (this.value === 'tattoo artist') {
            locationFields.style.display = 'block';

            // Charger les communes de Bruxelles
            fetch('/data/communes.json')
                .then(response => response.json())
                .then(data => {
                    const locationSelect = document.getElementById('location');
                    locationSelect.innerHTML = '<option value="">{{ __("Select Location") }}</option>'; // Clear options

                    data.forEach(commune => {
                        const option = document.createElement('option');
                        option.value = commune;
                        option.textContent = commune;
                        locationSelect.appendChild(option);
                    });
                });
        } else {
            locationFields.style.display = 'none';
        }
    });

    // Combine first name and last name into a full name before form submission
    document.getElementById('registration-form').addEventListener('submit', function(event) {
        const firstName = document.getElementById('first_name').value;
        const lastName = document.getElementById('last_name').value;
        document.getElementById('name').value = firstName + ' ' + lastName;
    });
</script>
@endsection
