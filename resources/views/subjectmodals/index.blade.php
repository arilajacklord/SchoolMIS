<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y mt-4">
        <div class="row">
            <div class="col-lg-12">
                {{-- Alerts --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Subject Header --}}
                <div class="card mb-4">
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
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="text-success fw-bold">Enrolled Students</h5>
                    </div>
                    <div class="card-body">
                        <table id="studentsTable" class="table table-striped display" style="width:100%">
                            <thead class="table-success">
                                <tr>
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($enrollments as $index => $enroll)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        {{ $enroll->registration->student_Fname }}
                                        {{ $enroll->registration->student_Mname }}
                                        {{ $enroll->registration->student_Lname }}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-sm grade-btn"
                                            data-enroll="{{ $enroll->enroll_id }}"
                                            data-student="{{ $enroll->registration->student_fname }} {{ $enroll->registration->student_mname }} {{ $enroll->registration->student_lname }}"
                                            data-bs-toggle="modal" data-bs-target="#gradeModal">
                                            Add/Edit Grade
                                        </button>
                                        <a href="{{ route('grades.print', $enroll->enroll_id) }}" target="_blank" class="btn btn-success btn-sm">
                                            Print
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-muted">No students enrolled.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grade Modal --}}
        <div class="modal fade" id="gradeModal" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <form class="modal-content" method="POST" action="{{ route('grades.store') }}">
                    @csrf
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Add/Edit Grade</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="enroll_id" id="modal_enroll_id">
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
    </div>

    {{-- Local Scripts & DataTables --}}
    <link rel="stylesheet" href="{{ asset('assets/DataTables/datatables.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/DataTables/datatables.min.css') }}" />
    <script src="{{ asset('assets/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/DataTables/datatables.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#studentsTable').DataTable({
                pageLength: 10,
                order: [[1, 'asc']]
            });

            // Open Grade Modal
            $('.grade-btn').click(function() {
                let enroll_id = $(this).data('enroll');
                let student_name = $(this).data('student');

                $('#modal_enroll_id').val(enroll_id);
                $('#modal_student_name').text(student_name);

                $('#prelim,#midterm,#semifinal,#final').val('');

                if (enroll_id) {
                    $.get("/grades/get/" + enroll_id, function(data) {
                        if (data) {
                            $('#prelim').val(data.prelim ?? '');
                            $('#midterm').val(data.midterm ?? '');
                            $('#semifinal').val(data.semifinal ?? '');
                            $('#final').val(data.final ?? '');
                        }
                    });
                }
            });

            // Submit form with page reload
            $('form').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                $.post(form.attr('action'), form.serialize(), function(response) {
                    location.reload(); // Reload to update grades
                });
            });
        });
    </script>
</x-app-layout>
