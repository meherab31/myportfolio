@extends('backend.master')

@section('content')
<div class="container">
    <h1>Blog List</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3">Create New Blog</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Thumbnail</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($blogs as $blog)
                <tr>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->status ? 'Published' : 'Draft' }}</td>
                    <td>
                        @if ($blog->thumbnail)
                            <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" width="80">
                        @else
                            <span>No Thumbnail</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        {{-- <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-info btn-sm">View</a> --}}
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No blogs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $blogs->links() }}
</div>
@endsection
