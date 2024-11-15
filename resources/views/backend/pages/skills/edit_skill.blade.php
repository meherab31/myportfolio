@extends('backend.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="text-center text-success">Edit Skill</h2>

        <form action="{{ route('skills.skill.update', $skill->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Skill Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $skill->name }}" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $skill->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="percentage" class="form-label">Proficiency (%)</label>
                <input type="number" class="form-control" id="percentage" name="percentage" value="{{ $skill->percentage }}" required min="0" max="100">
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('skills.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-success">Update Skill</button>
            </div>
        </form>
    </div>
</div>
@endsection
