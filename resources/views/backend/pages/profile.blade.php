@extends('backend.master')

@section('content')
<div class="container profile-container">
    <h2>Edit Profile</h2>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="profile_picture">Profile Image:</label>
            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
            <img id="preview" src="{{ asset($user->profile_picture) }}" alt="Profile Picture Preview"  class="img-preview">
        </div>

        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection

<style>
    .profile-container {
        padding: 5rem
        max-width: 500px;
        margin: auto;
        padding: 20px;
        background-color: #1e1e1e;
        color: #eaeaea;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.3);
        text-align: left;
    }

    h2 {
        margin-bottom: 20px;
        font-family: Arial, sans-serif;
        text-align: center;
        color: #ffffff;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        color: #f8f9fa;
        margin-bottom: 8px;
    }

    input[type="text"], input[type="email"], input[type="file"], input[type="password"], .btn {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: none;
        margin-top: 5px;
        background-color: #333;
        color: #f8f9fa;
    }

    .btn {
        background-color: #007bff;
        color: #ffffff;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .img-preview {
        display: block;
        max-width: auto;
        height: 20%;
        margin-top: 10px;
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
