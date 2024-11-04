@extends('backend.master')

@section('content')
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2 class="display-4">About Me</h2>
            <p class="lead text-muted">Update your information below</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data" class="form-container">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea class="form-control" id="bio" name="bio" rows="4" placeholder="Tell us about yourself...">{{ old('bio', optional($about)->bio) }}</textarea>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Your address"
                    value="{{ old('address', optional($about)->address) }}">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Your phone number"
                    value="{{ old('phone', optional($about)->phone) }}">
            </div>

            <div class="form-group">
                <label for="image">Profile Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
                @if (optional($about)->image)
                    <small class="form-text text-muted">Current image: <img src="{{ asset($about->image) }}"
                            alt="Profile Image" class="img-thumbnail mt-2" width="100"></small>
                @endif
            </div>

            <button type="submit" class="btn btn-primary btn-lg btn-block">Update Information</button>
        </form>
    </div>
@endsection

<style>
    body {
        background-color: #f8f9fa;
        /* Body background color */
        color: #343a40;
        /* Default text color */
    }

    .form-container {
        background-color: #eb6868;
        /* Form background color */
        border-radius: 0.5rem;
        /* Rounded corners for the form */
        padding: 2rem;
        /* Padding for the form */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* Shadow for the form */
    }

    h2 {
        font-weight: bold;
        color: #343a40;
        /* Color for headings */
    }

    label {
        color: #ffffff;
        /* Label color */
        font-weight: bold;
        /* Bold for labels */
    }

    .form-control {
        border-radius: 0.5rem;
        /* Rounded corners for input fields */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* Subtle shadow */
    }

    .form-control-file {
        border-radius: 0.5rem;
        /* Rounded corners for file input */
    }
    .form-group{
        padding-bottom: 1rem;
    }
    .btn-primary {
        background-color: #007bff;
        /* Primary button color */
        border-color: #007bff;
        /* Border color */
    }

    .btn-primary:hover {
        background-color: #0056b3;
        /* Darker color on hover */
        border-color: #0056b3;
        /* Border color on hover */
    }

    .alert {
        border-radius: 0.5rem;
        /* Rounded corners for alerts */
    }

    .shadow {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Shadow effect */
    }
</style>

@push('scripts')
    <script>
        $(document).ready(function() {
            // Placeholder for future scripts if needed
        });
    </script>
@endpush
