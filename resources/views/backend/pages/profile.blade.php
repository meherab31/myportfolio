@extends('backend.master')

@section('content')
<div class="container profile-container">
    <div class="text-center mb-4">
        <h2 class="display-4">Edit Profile</h2>
        <p class="lead text-muted">Update your user information below</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="form-container">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="profile_picture">Profile Image</label>
            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
            @if (optional($user)->profile_picture)
            <small class="form-text text-muted">Current image: <img src="{{ asset($user->profile_picture) }}"
                    alt="Profile Image" class="img-thumbnail mt-2" width="100"></small>
        @endif
        </div>
        <input type="file" class="form-control-file" id="image" name="image">

        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank if you don't want to change">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Leave blank if you don't want to change">
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">Update Profile</button>
    </form>
</div>
@endsection

<style>
    body {
        background-color: #f8f9fa;
        /* Body background color */
        color: #343a40;
    }

    .profile-container {
        padding: 3rem;
        max-width: 500px;
        margin: auto;
        background-color: #27dae7e1;
        color: #ffffff;
        border-radius: 0.5rem;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h2 {
        font-weight: bold;
        color: #ffffff;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    label {
        color: #ffffff;
        font-weight: bold;
    }

    .form-control {
        border-radius: 0.5rem;
        /* Rounded corners for input fields */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .img-preview {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        border: 2px solid #444;
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const profilePictureInput = document.getElementById('profile_picture');
        const preview = document.getElementById('preview');

        profilePictureInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    preview.src = reader.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush
