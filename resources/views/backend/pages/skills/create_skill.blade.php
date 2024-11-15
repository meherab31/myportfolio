@extends('backend.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="text-center text-success">Add Skill</h2>

        <form action="{{ route('skills.skill.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Skill Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="percentage" class="form-label">Proficiency (%)</label>
                <input type="number" class="form-control" id="percentage" name="percentage" required min="0" max="100">
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('skills.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-success">Add Skill</button>
            </div>
        </form>
    </div>
</div>
@endsection
