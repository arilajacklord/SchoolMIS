<x-app-layout>
<div class="card mt-5">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Enrollment List</h2>
        <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addEnrollmentModal">
            <i class="lni lni-plus"></i> Add Enrollment
        </a>
    </div>


    <div class="card-body">
        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

          {{-- ✅ Search Input --}}
        <div class="mb-3 d-flex justify-content-end">
            <input type="text" id="searchInput" class="form-control w-25" placeholder="Search School Year...">
        </div>


        {{-- Table --}}
        <table class="table table-bordered table-striped align-middle text-center">
            <thead style="background-color: #084298; color: white;">
                <tr>
                    <th>User</th>
                    <th>Subject</th>
                    <th>School Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment->user->name ?? 'N/A' }}</td>
                        <td>{{ $enrollment->subject->descriptive_title ?? 'N/A' }}</td>
                        <td>{{ $enrollment->schoolyear->schoolyear ?? 'N/A' }} - {{ $enrollment->schoolyear->semester ?? '' }}</td>
                        <td>
                            <button class="btn btn-info btn-sm viewBtn" data-id="{{ $enrollment->enroll_id }}">
                                <i class="lni lni-eye"></i>
                            </button>
                            <button class="btn btn-warning btn-sm editBtn" data-id="{{ $enrollment->enroll_id }}">
                                <i class="lni lni-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm deleteBtn" data-id="{{ $enrollment->enroll_id }}">
                                <i class="lni lni-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-muted">No records found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ADD MODAL --}}
<div class="modal fade" id="addEnrollmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form method="POST" action="{{ route('enrollments.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Add Enrollment</h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">User</label>
                        <select name="user_id" class="form-select" required>
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <select name="subject_id" class="form-select" required>
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->subject_id }}">{{ $subject->descriptive_title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">School Year</label>
                        <select name="schoolyear_id" class="form-select" required>
                            <option value="">Select School Year</option>
                            @foreach($schoolyears as $sy)
                                <option value="{{ $sy->schoolyear_id }}">{{ $sy->schoolyear }} - {{ $sy->semester }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- VIEW MODAL --}}
<div class="modal fade" id="viewEnrollmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-info text-white py-2">
                <h5 class="modal-title"><i class="lni lni-eye me-2"></i> Enrollment Details</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body bg-light">
                <table class="table table-sm table-borderless mb-0">
                    <tr><th class="text-muted">User</th><td id="v_user" class="fw-semibold"></td></tr>
                    <tr><th class="text-muted">Subject</th><td id="v_subject" class="fw-semibold"></td></tr>
                    <tr><th class="text-muted">School Year</th><td id="v_schoolyear" class="fw-semibold"></td></tr>
                </table>
            </div>
            <div class="modal-footer py-2 border-0 bg-white">
                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- EDIT MODAL --}}
<div class="modal fade" id="editEnrollmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form id="editEnrollmentForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Edit Enrollment</h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">User</label>
                        <select id="e_user" name="user_id" class="form-select" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <select id="e_subject" name="subject_id" class="form-select" required>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->subject_id }}">{{ $subject->descriptive_title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">School Year</label>
                        <select id="e_schoolyear" name="schoolyear_id" class="form-select" required>
                            @foreach($schoolyears as $sy)
                                <option value="{{ $sy->schoolyear_id }}">{{ $sy->schoolyear }} - {{ $sy->semester }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- DELETE MODAL --}}
<div class="modal fade" id="deleteEnrollmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <form id="deleteEnrollmentForm" method="POST" data-route="{{ route('enrollments.destroy', ':id') }}">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white py-2">
                    <h5 class="modal-title"><i class="lni lni-trash-can"></i> Confirm Delete</h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Are you sure you want to delete this enrollment?</p>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

     document.querySelectorAll('.viewBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch(`/enrollments/${id}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.json())
            .then(data => {
                document.getElementById('v_user').textContent = data.user;
                document.getElementById('v_subject').textContent = data.subject;
                document.getElementById('v_schoolyear').textContent = `${data.schoolyear} - ${data.semester}`;
                new bootstrap.Modal(document.getElementById('viewEnrollmentModal')).show();
            });
        });
    });

    // EDIT
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch(`/enrollments/${id}/edit`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.json())
            .then(data => {
                document.getElementById('e_user').value = data.user_id;
                document.getElementById('e_subject').value = data.subject_id;
                document.getElementById('e_schoolyear').value = data.schoolyear_id;

                const editForm = document.getElementById('editEnrollmentForm');
                editForm.action = `/enrollments/${id}`;
                new bootstrap.Modal(document.getElementById('editEnrollmentModal')).show();
            });
        });
    });

    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('table tbody tr'); // target your table rows
        rows.forEach(row => {
            const user = row.cells[0].textContent.toLowerCase();
            const subject = row.cells[1].textContent.toLowerCase();
            const schoolyear = row.cells[2].textContent.toLowerCase();
            row.style.display = (user.includes(filter) || subject.includes(filter) || schoolyear.includes(filter)) ? '' : 'none';
        });
    });

    // DELETE
    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const form = document.getElementById('deleteEnrollmentForm');
            form.action = form.dataset.route.replace(':id', id);
            new bootstrap.Modal(document.getElementById('deleteEnrollmentModal')).show();
        });
    });

});

</script>
</x-app-layout>
