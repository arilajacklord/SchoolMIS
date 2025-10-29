<!-- ✅ jQuery + DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

<x-app-layout>
<div class="container mt-4">

    {{-- ✅ Step 1: Select School Year --}}
    <div class="card mb-4 shadow-sm border-0 rounded-3">
        <div class="card-body">
            <form method="GET" action="{{ route('grades.index') }}">
                <div class="row align-items-end">
                    <div class="col-md-5">
                        <label class="form-label fw-bold">Select School Year & Semester</label>
                        <select name="schoolyear_id" class="form-control" required>
                            <option value="" disabled selected>-- Choose School Year & Semester --</option>
                            @foreach ($schoolyears as $sy)
                                <option value="{{ $sy->schoolyear_id }}"
                                    {{ request('schoolyear_id') == $sy->schoolyear_id ? 'selected' : '' }}>
                                    {{ $sy->schoolyear }} - {{ ucfirst($sy->semester) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100 mt-3">
                            <i class="fa fa-filter"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ✅ Step 2: List Subjects --}}
    @if($selectedSchoolyear)
    <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Subjects for {{ $selectedSchoolyear->schoolyear }} - {{ ucfirst($selectedSchoolyear->semester) }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="subjectsTable" class="table table-striped text-center align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Course Code</th>
                            <th>Descriptive Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subjects as $index => $subject)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $subject->course_code }}</td>
                                <td>{{ $subject->descriptive_title }}</td>
                                <td>
                                    <a href="{{ route('grades.showSubject', [
                                            'schoolyear_id' => $selectedSchoolyear->schoolyear_id,
                                            'subject_id' => $subject->subject_id
                                        ]) }}" 
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i> View Students
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted">No subjects found for this school year and semester.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

</div>

@push('scripts')
<script>
$(document).ready(function(){
    $('#subjectsTable').DataTable({
        pageLength: 10,
        order: [[1, 'asc']],
    });
});
</script>
@endpush
</x-app-layout>
