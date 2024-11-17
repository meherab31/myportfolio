@extends('backend.master')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4 text-primary text-center">Manage Projects</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Add Project Button -->
        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addProjectModal" onclick="resetAddModal()">Add New Project</button>
        </div>

        <!-- Projects Table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Thumbnail</th>
                        <th>Project Title</th>
                        <th>Category</th>
                        <th>Technologies</th>
                        <th>Github Link</th>
                        <th>Live Demo Link</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td> <img src="{{ asset('storage/' . $project->image) }}" alt="Image of {{ $project->title }}" width="20" height="auto"> </td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->skillCategory->name }}</td>
                        <td>{{ implode(', ', json_decode($project->technologies)) }}</td>
                        <td>{{ $project->github_link }}</td>
                        <td>{{ $project->live_demo_link }}</td>
                        <td class="d-flex">
                            <button type="button" class="btn btn-sm btn-outline-warning me-2" data-bs-toggle="modal" data-bs-target="#editProjectModal" onclick="editProject({{ json_encode($project) }})">Edit</button>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this project?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Project Modal -->
<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="addProjectForm" action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="addProjectModalLabel">Add Project</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Project Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="skill_category_id" class="form-label">Category</label>
                        <select class="form-select" id="skill_category_id" name="skill_category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="technologies" class="form-label">Technologies</label>
                        <input type="text" class="form-control" id="technologies" name="technologies" placeholder="Comma separated values" required>
                    </div>
                    <div class="mb-3">
                        <label for="github_link" class="form-label">Github Link</label>
                        <input type="url" class="form-control" id="github_link" name="github_link">
                    </div>
                    <div class="mb-3">
                        <label for="live_demo_link" class="form-label">Live Demo Link</label>
                        <input type="url" class="form-control" id="live_demo_link" name="live_demo_link">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Project Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Project</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Project Modal -->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="editProjectForm" action="{{ route('projects.update', '') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="editProjectModalLabel">Edit Project</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editProjectId" name="project_id">

                    <!-- Project Title -->
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Project Title</label>
                        <input type="text" class="form-control" id="edit_title" name="title" value="{{ old('title', optional($project)->title) }}" required>
                    </div>

                    <!-- Project Category -->
                    <div class="mb-3">
                        <label for="edit_skill_category_id" class="form-label">Category</label>
                        <select class="form-select" id="edit_skill_category_id" name="skill_category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('skill_category_id', optional($project)->skill_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Technologies -->
                    <div class="mb-3">
                        <label for="edit_technologies" class="form-label">Technologies</label>
                        <input type="text" class="form-control" id="edit_technologies" name="technologies" value="{{ old('technologies', implode(', ', json_decode(optional($project)->technologies ?? ''))) }}" placeholder="Comma separated values">
                    </div>

                    <!-- Github Link -->
                    <div class="mb-3">
                        <label for="edit_github_link" class="form-label">Github Link</label>
                        <input type="url" class="form-control" id="edit_github_link" name="github_link" value="{{ old('github_link', optional($project)->github_link) }}">
                    </div>

                    <!-- Live Demo Link -->
                    <div class="mb-3">
                        <label for="edit_live_demo_link" class="form-label">Live Demo Link</label>
                        <input type="url" class="form-control" id="edit_live_demo_link" name="live_demo_link" value="{{ old('live_demo_link', optional($project)->live_demo_link) }}">
                    </div>

                    <!-- Project Image (New Image Upload) -->
                    <div class="mb-3">
                        <label for="edit_image" class="form-label">Project Image</label>
                        <input type="file" class="form-control" id="edit_image" name="image">
                    </div>
                                        <!-- Display the current image -->
                                        <div class="mb-3" id="current-image-container">
                                            <div id="current_image">
                                                <!-- Display existing image if it exists -->
                                                @if (optional($project)->image)
                                                    <small class="form-text text-muted">Current image:
                                                        <img src="{{ asset('storage/' . $project->image) }}" alt="Current Project Image" class="img-thumbnail mt-2" width="100">
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Project</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function resetAddModal() {
        $('#addProjectForm')[0].reset();
        $('#addProjectModalLabel').text('Add Project');
    }

    function editProject(project) {
        $('#editProjectForm').attr('action', '/admin/projects/' + project.id);
        $('#editProjectId').val(project.id);
        $('#editProjectModalLabel').text('Edit Project');
        $('#edit_title').val(project.title);
        $('#edit_skill_category_id').val(project.skill_category_id);
        $('#edit_technologies').val(project.technologies.join(', '));
        $('#edit_github_link').val(project.github_link);
        $('#edit_live_demo_link').val(project.live_demo_link);
    }
</script>
@endpush
