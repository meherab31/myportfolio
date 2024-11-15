@extends('backend.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="text-center text-success">Manage Skills</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('skills.category.create') }}" class="btn btn-outline-success">Add New Category</a>
            <a href="{{ route('skills.skill.create') }}" class="btn btn-outline-success ms-2">Add New Skill</a>
        </div>

        @foreach($categories as $category)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h5 style="color: #198754;">{{ $category->name }}</h5>
                <div>
                    <a href="{{ route('skills.category.edit', $category->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                    <form action="{{ route('skills.category.delete', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($category->skills as $skill)
                    <li class="list-group-item d-flex justify-content-between">
                        {{ $skill->name }} - {{ $skill->percentage }}%
                        <div>
                            <a href="{{ route('skills.skill.edit', $skill->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form action="{{ route('skills.skill.delete', $skill->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
