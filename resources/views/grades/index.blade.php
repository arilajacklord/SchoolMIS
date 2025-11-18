<!-- jQuery + DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.min.css" />
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.min.js"></script>

<x-app-layout>
<div class="container mt-4">

    {{-- 🔷 STEP 1: SCHOOL YEAR FILTER --}}
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-header bg-gradient-success text-white rounded-top-4 py-3">
            <h5 class="mb-0"><i class="fa fa-filter"></i> Filter by School Year & Semester</h5>
        </div>

        <div class="card-body">
            <form method="GET" action="{{ route('grades.index') }}">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Select School Year & Semester</label>
                        <select name="schoolyear_id" class="form-select shadow-sm" required>
                            <option value="" disabled selected>-- Choose School Year --</option>
                            @foreach ($schoolyears as $sy)
                                <option value="{{ $sy->schoolyear_id }}"
                                    {{ request('schoolyear_id') == $sy->schoolyear_id ? 'selected' : '' }}>
                                    {{ $sy->schoolyear }} - {{ ucfirst($sy->semester) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100 shadow-sm">
                            <i class="fa fa-search"></i> Apply Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- 🔷 STEP 2: SUBJECT LIST --}}
    @if($selectedSchoolyear)
    <div class="card shadow-sm border-0 rounded-4">
        
        <div class="card-header bg-gradient-success text-white rounded-top-4 py-3">
            <h5 class="mb-0">
                <i class="fa fa-book"></i> Subjects for 
                <span class="fw-bold">
                    {{ $selectedSchoolyear->schoolyear }} - {{ ucfirst($selectedSchoolyear->semester) }}
                </span>
            </h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="subjectsTable" class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Course Code</th>
                            <th>Descriptive Title</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subjects as $index => $subject)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $subject->course_code }}</td>
                                <td>{{ $subject->descriptive_title }}</td>
                                <td>
                                    <a href="{{ route('grades.showSubject', [
                                        'schoolyear_id' => $selectedSchoolyear->schoolyear_id,
                                        'subject_id' => $subject->subject_id
                                    ]) }}" 
                                       class="btn btn-primary btn-sm shadow-sm">
                                        <i class="fa fa-users"></i> View Students
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted py-3">No subjects found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

</div>

{{-- DATATABLE SCRIPT --}}
@push('scripts')
<script>
$(document).ready(function(){
    $('#subjectsTable').DataTable({
        pageLength: 10,
        order: [[1, 'asc']],
        className: 'table table-striped'
    });
});
</script>
@endpush
</x-app-layout>
