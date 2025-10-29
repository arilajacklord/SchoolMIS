<x-app-layout>
<div class="container mt-4">

    {{-- Subject Header --}}
    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white">
            <h5>{{ $subject->descriptive_title }}</h5>
        </div>
        <div class="card-body">
            <p><b>Course Code:</b> {{ $subject->course_code }}</p>
            <p><b>School Year:</b> {{ $schoolyear->schoolyear }}</p>
            <p><b>Semester:</b> {{ ucfirst($schoolyear->semester) }}</p>
        </div>
    </div>

    {{-- Enrolled Students --}}
    <div class="card shadow mb-4">
        <div class="card-header bg-light">
            <h5 class="text-success fw-bold">Enrolled Students</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="table-responsive">
                <table id="studentsTable" class="table table-striped text-center align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enrollments as $index => $enroll)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $enroll->registration->student_name ?? 'N/A' }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#gradeModal"
                                    data-enroll="{{ $enroll->enroll_id }}"
                                    data-student="{{ $enroll->registration->student_name }}">
                                    Add/Edit Grade
                                </button>
                                <a href="{{ route('grades.print', $enroll->enroll_id) }}" target="_blank" class="btn btn-success btn-sm">Print</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3">No students enrolled.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Grade Modal --}}
<div class="modal fade" id="gradeModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" method="POST" action="{{ route('grades.store') }}">
            @csrf
            <input type="hidden" name="enroll_id" id="modal_enroll_id">

            <div class="modal-header bg-success text-white">
                <h5>Add/Edit Grade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>Student: <span id="modal_student_name" class="text-primary fw-semibold"></span></p>
                <div class="row">
                    @foreach(['prelim','midterm','semifinal','final'] as $term)
                    <div class="col-md-3 mb-3">
                        <label>{{ ucfirst($term) }}</label>
                        <input type="number" step="0.01" name="{{ $term }}" id="{{ $term }}" class="form-control">
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Grade</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

<script>
$(document).ready(function(){
    $('#studentsTable').DataTable({ pageLength:10, order:[[0,'asc']] });

    $('#gradeModal').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
        var enroll_id = button.data('enroll');
        var student_name = button.data('student');

        $('#modal_enroll_id').val(enroll_id);
        $('#modal_student_name').text(student_name);

        $('#prelim,#midterm,#semifinal,#final').val('');

        if(enroll_id){
            $.get("/grades/get/" + enroll_id, function(data){
                if(data){
                    $('#prelim').val(data.prelim ?? '');
                    $('#midterm').val(data.midterm ?? '');
                    $('#semifinal').val(data.semifinal ?? '');
                    $('#final').val(data.final ?? '');
                }
            });
        }
    });
});
</script>
@endpush
</x-app-layout>
