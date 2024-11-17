@extends('backend.master')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Blog</h1>
    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Blog Title -->
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $blog->title }}" required>
        </div>

        <!-- Blog Content -->
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" id="editor" class="form-control" required>{{ $blog->content }}</textarea>
        </div>

        <!-- Blog Thumbnail -->
        <div class="form-group">
            <label for="thumbnail">Thumbnail:</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
            @if ($blog->thumbnail)
                <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" width="120" class="mt-2">
            @endif
        </div>

        <!-- Blog Status -->
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{ $blog->status ? 'selected' : '' }}>Published</option>
                <option value="0" {{ !$blog->status ? 'selected' : '' }}>Draft</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Blog</button>
    </form>
</div>

<!-- CKEditor 5 with SimpleUploadAdapter -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            simpleUpload: {
                uploadUrl: '/blogs/upload', // Adjust this URL to your file upload handler
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            toolbar: [
                'heading', '|', 'bold', 'italic', '|', 'link', 'bulletedList', 'numberedList', '|', 'blockQuote', 'undo', 'redo', 'imageUpload'
            ]
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection
