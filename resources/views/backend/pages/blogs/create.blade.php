@extends('backend.master')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Create New Blog</h1>
    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Blog Title -->
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <!-- Blog Content -->
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" id="editor" class="form-control" required>{{ old('content') }}</textarea>
        </div>

        <!-- Blog Thumbnail -->
        <div class="form-group">
            <label for="thumbnail">Thumbnail:</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
        </div>

        <!-- Blog Status -->
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="1" selected>Published</option>
                <option value="0">Draft</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Create Blog</button>
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
