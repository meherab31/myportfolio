@extends('backend.master')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4 text-success text-center">Manage Education</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Add Education Button -->
        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addEducationModal" onclick="resetAddModal()">Add New Education</button>
        </div>

        <!-- Education Table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Degree</th>
                        <th>Institution</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($educations as $education)
                    <tr>
                        <td>{{ $education->degree }}</td>
                        <td>{{ $education->institution }}</td>
                        <td>{{ $education->start_date->format('Y-m-d') }}</td>
                        <td>{{ $education->end_date ? $education->end_date->format('Y-m-d') : 'Ongoing' }}</td>
                        <td>{{ Str::limit($education->description, 50) }}</td>
                        <td class="d-flex">
                            <button type="button" class="btn btn-sm btn-outline-warning me-2" data-bs-toggle="modal" data-bs-target="#editEducationModal" onclick="editEducation({{ json_encode($education) }})">Edit</button>
                            <form action="{{ route('educations.destroy', $education->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this education?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Education Modal -->
<div class="modal fade" id="addEducationModal" tabindex="-1" aria-labelledby="addEducationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="addEducationForm" action="{{ route('educations.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="addEducationModalLabel">Add Education</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="degree" class="form-label">Degree</label>
                        <input type="text" class="form-control" id="degree" name="degree" required>
                    </div>
                    <div class="mb-3">
                        <label for="institution" class="form-label">Institution</label>
                        <input type="text" class="form-control" id="institution" name="institution" required>
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Education</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Education Modal -->
<div class="modal fade" id="editEducationModal" tabindex="-1" aria-labelledby="editEducationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="editEducationForm" action="#" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="editEducationModalLabel">Edit Education</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editEducationId" name="education_id">
                    <div class="mb-3">
                        <label for="edit_degree" class="form-label">Degree</label>
                        <input type="text" class="form-control" id="edit_degree" name="degree" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_institution" class="form-label">Institution</label>
                        <input type="text" class="form-control" id="edit_institution" name="institution" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="edit_start_date" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="edit_end_date" name="end_date">
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update Education</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function resetAddModal() {
        $('#addEducationForm')[0].reset();
        $('#addEducationModalLabel').text('Add Education');
    }

    function editEducation(education) {
        // Update the action URL to use the specific education ID
        $('#editEducationForm').attr('action', '/admin/educations/update/' + education.id);
        $('#editEducationId').val(education.id);
        $('#editEducationModalLabel').text('Edit Education');
        $('#edit_degree').val(education.degree);
        $('#edit_institution').val(education.institution);
        $('#edit_start_date').val(education.start_date.split('T')[0]);
        $('#edit_end_date').val(education.end_date ? education.end_date.split('T')[0] : '');
        $('#edit_description').val(education.description);
    }

</script>
@endpush
