@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Register</h1>
    <form method="POST" action="{{ route('register') }}" id="registration-form">
        @csrf
        <!-- First Name -->
        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Hidden Name Field -->
        <input type="hidden" name="name" id="name">

        <!-- Login -->
        <div class="mt-4">
            <x-input-label for="login" :value="__('Login')" />
            <x-text-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" required />
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role Selection -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role" class="block mt-1 w-full" required>
                <option value="">{{ __('Select Role') }}</option>
                <option value="client">{{ __('Client') }}</option>
                <option value="tattoo artist">{{ __('Tattoo Artist') }}</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Gender')" />
            <select id="gender" name="gender" class="block mt-1 w-full">
                <option value="">{{ __('Select Gender') }}</option>
                <option value="male">{{ __('Male') }}</option>
                <option value="female">{{ __('Female') }}</option>
                <option value="non_binary">{{ __('Non-binary') }}</option>
                <option value="other">{{ __('Other') }}</option>
            </select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- Location (Tattoo Artist Only) -->
        <div id="location-fields" class="mt-4" style="display: none;">
            <x-input-label for="location" :value="__('Location')" />
            <select id="location" name="location" class="block mt-1 w-full">
                <option value="">{{ __('Select Location') }}</option>
                <!-- Les options seront ajoutées ici via AJAX -->
            </select>
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
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
