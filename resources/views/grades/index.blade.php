<!-- jQuery + DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">🎓 Grade List</h4>
            <button type="button" class="btn btn-light btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#gradeModal">
                <i class="bi bi-plus-circle"></i> Add Grade
            </button>
        </div>

        <div class="card-body">
            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Grades Table --}}
            <div class="table-responsive">
                <table id="gradeTable" class="table table-striped align-middle text-center">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Subject</th>
                            <th>School Year / Semester</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($grades as $index => $grade)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="{{ route('grades.show', $grade->grade_id) }}" class="text-decoration-none">
                                        {{ $grade->enrollment->registration->student_name ?? 'N/A' }}
                                    </a>
                                </td>
                                <td>{{ $grade->enrollment->subject->descriptive_title ?? 'N/A' }}</td>
                                <td>
                                    {{ $grade->enrollment->schoolyear->schoolyear ?? 'N/A' }}
                                    {{ $grade->enrollment->schoolyear->semester ? ' - ' . $grade->enrollment->schoolyear->semester : '' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted">No grades found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ADD GRADE MODAL -->
<div class="modal fade" id="gradeModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" method="POST" action="{{ route('grades.store') }}">
            @csrf
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="gradeModalTitle">Add New Grade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label"><b>Enrollment</b></label>
                        <select name="enroll_id" id="enroll_id" class="form-control" required>
                            <option value="" disabled selected>Select Enrollment</option>
                            @foreach ($enrollments as $enroll)
                                <option value="{{ $enroll->enroll_id }}">
                                    {{ $enroll->registration->student_name ?? 'N/A' }} - 
                                    {{ $enroll->subject->descriptive_title ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    @foreach (['prelim', 'midterm', 'semifinal', 'final'] as $term)
                        <div class="col-md-3 mb-3">
                            <label class="form-label"><b>{{ ucfirst($term) }}</b></label>
                            <input type="number" step="0.01" class="form-control" name="{{ $term }}" id="{{ $term }}" placeholder="Enter {{ ucfirst($term) }}">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnSave">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#gradeTable').DataTable();

    // Reset modal on close
    $('#gradeModal').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $(this).find('.modal-title').text('Add New Grade');
        $(this).find('input[name="_method"]').remove();
        $('#gradeModal form').attr('action', '{{ route('grades.store') }}');
    });
});
</script>
@endpush
