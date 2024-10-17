@extends('layouts.app')

@section('content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<div class="dashboard-container">
<h1 class="text-center mb-5">User Management</h1>

    <!-- Container for user addition and search forms -->
    <div class="form-row">
        <!-- User addition form -->
        <div class="form-container small-form">
            <h3>Add a User</h3>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" id="login" name="login" required>
                    @if($errors->has('login'))
                        <span class="text-danger">{{ $errors->first('login') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <!-- Password confirmation field -->
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                    @if($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="client">Client</option>
                        <option value="tattoo artist">Tattoo Artist</option>
                        <option value="admin">Admin</option>
                    </select>
                    @if($errors->has('role'))
                        <span class="text-danger">{{ $errors->first('role') }}</span>
                    @endif
                </div>
                <!-- Gender selection field -->
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="non-binary">Non-binary</option>
                        <option value="other">Other</option>
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="small-button">Add</button>
                </div>
            </form>
        </div>

        <!-- User search and filter form -->
        <div class="form-container search-form">
            <h3>Search Users</h3>
            <form action="{{ route('admin.users.index') }}" method="GET">
                <div class="form-group">
                    <label for="searchName">Name</label>
                    <input type="text" id="searchName" name="name" value="{{ request('name') }}">
                </div>
                <div class="form-group">
                    <label for="searchLogin">Login</label>
                    <input type="text" id="searchLogin" name="login" value="{{ request('login') }}">
                </div>
                <div class="form-group">
                    <label for="searchEmail">Email</label>
                    <input type="text" id="searchEmail" name="email" value="{{ request('email') }}">
                </div>
                <div class="form-group">
                    <label for="searchRole">Role</label>
                    <select id="searchRole" name="role">
                        <option value="">All roles</option>
                        <option value="client" {{ request('role') == 'client' ? 'selected' : '' }}>Client</option>
                        <option value="tattoo artist" {{ request('role') == 'tattoo artist' ? 'selected' : '' }}>Tattoo Artist</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <!-- Gender selection field for search -->
                <div class="form-group">
                    <label for="searchGender">Gender</label>
                    <select id="searchGender" name="gender">
                        <option value="">All genders</option>
                        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="non-binary" {{ request('gender') == 'non-binary' ? 'selected' : '' }}>Non-binary</option>
                        <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="small-button">Search</button>
                </div>
            </form>
        </div>
    </div>

    <!-- User management -->
    <div class="table-container">
        <h3>User Management</h3>
        <table class="custom-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}" class="custom-button">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="custom-button" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
