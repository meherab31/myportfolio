@extends('backend.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="text-center text-success">Add Category</h2>

        <form action="{{ route('skills.category.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('skills.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-success">Add Category</button>
            </div>
        </form>
    </div>
</div>
@endsection
