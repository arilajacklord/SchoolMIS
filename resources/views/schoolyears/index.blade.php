<x-app-layout>
<div class="card mt-5">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>School Year List</h2>
        <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addSchoolYearModal">
            <i class="lni lni-plus"></i> Add School Year
        </a>
    </div>

    <div class="card-body">
        {{-- ✅ Success Message --}}
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

        {{-- ✅ Table --}}
        <table class="table table-bordered table-striped align-middle text-center" id="schoolYearTable">
          <thead style="background-color: #084298; color: white;">

                <tr>
                    <th>ID</th>
                    <th>School Year</th>
                    <th>Semester</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schoolyears as $schoolyear)
                    <tr>
                        <td>{{ $schoolyear->schoolyear_id }}</td>
                        <td>{{ $schoolyear->schoolyear }}</td>
                        <td>{{ $schoolyear->semester }}</td>
                        <td>
                            <button class="btn btn-info btn-sm viewBtn" data-id="{{ $schoolyear->schoolyear_id }}">
                                <i class="lni lni-eye"></i>
                            </button>
                            <button class="btn btn-warning btn-sm editBtn" data-id="{{ $schoolyear->schoolyear_id }}">
                                <i class="lni lni-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm deleteBtn" data-id="{{ $schoolyear->schoolyear_id }}">
                                <i class="lni lni-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-muted">No records found.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{-- ✅ Pagination --}}
        <div class="mt-3">{{ $schoolyears->links() }}</div>
    </div>
</div>

{{-- ============================
    ADD MODAL
============================= --}}
<div class="modal fade" id="addSchoolYearModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Add New School Year</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('schoolyears.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">School Year</label>
                        <input type="text" name="schoolyear" class="form-control" placeholder="e.g. 2025-2026" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Semester</label>
                        <select name="semester" class="form-select" required>
                            <option value="" disabled selected>-- Select Semester --</option>
                            <option>1st Semester</option>
                            <option>2nd Semester</option>
                            <option>Summer</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success float-end">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ============================
    VIEW MODAL
============================= --}}
<div class="modal fade" id="viewSchoolYearModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-info text-white py-2">
                <h5 class="modal-title"><i class="lni lni-eye me-2"></i> School Year Details</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body bg-light">
                <table class="table table-sm table-borderless mb-0">
                    <tr><th class="text-muted">ID</th><td id="v_schoolyear_id" class="fw-semibold"></td></tr>
                    <tr><th class="text-muted">School Year</th><td id="v_schoolyear" class="fw-semibold"></td></tr>
                    <tr><th class="text-muted">Semester</th><td id="v_semester" class="fw-semibold"></td></tr>
                </table>
            </div>
            <div class="modal-footer py-2 border-0 bg-white">
                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- ============================
    EDIT MODAL
============================= --}}
<div class="modal fade" id="editSchoolYearModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Edit School Year</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">School Year</label>
                        <input type="text" name="schoolyear" id="e_schoolyear" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Semester</label>
                        <select name="semester" id="e_semester" class="form-select" required>
                            <option>1st Semester</option>
                            <option>2nd Semester</option>
                            <option>Summer</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success float-end">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ============================
    DELETE MODAL
============================= --}}
<div class="modal fade" id="deleteSchoolYearModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white py-2">
                <h5 class="modal-title"><i class="lni lni-trash-can"></i> Confirm Delete</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p>Are you sure you want to delete this school year?</p>
                <form id="deleteForm" method="POST" data-route="{{ route('schoolyears.destroy', ':id') }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ============================
    JAVASCRIPT
============================= --}}
<script>
document.addEventListener('DOMContentLoaded', function() {

    // ✅ SEARCH FUNCTION
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#schoolYearTable tbody tr');
        rows.forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
        });
    });

    // ✅ VIEW BUTTON
    document.querySelectorAll('.viewBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch(`/schoolyears/${id}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.json())
            .then(data => {
                document.getElementById('v_schoolyear_id').textContent = data.schoolyear_id;
                document.getElementById('v_schoolyear').textContent = data.schoolyear;
                document.getElementById('v_semester').textContent = data.semester;
                new bootstrap.Modal(document.getElementById('viewSchoolYearModal')).show();
            });
        });
    });

    // ✅ EDIT BUTTON
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch(`/schoolyears/${id}/edit`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.json())
            .then(data => {
                document.getElementById('e_schoolyear').value = data.schoolyear;
                document.getElementById('e_semester').value = data.semester;
                const editForm = document.getElementById('editForm');
                editForm.action = `/schoolyears/${id}`;
                new bootstrap.Modal(document.getElementById('editSchoolYearModal')).show();
            });
        });
    });

    // ✅ DELETE BUTTON
    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const form = document.getElementById('deleteForm');
            const route = form.dataset.route.replace(':id', id);
            form.action = route;
            new bootstrap.Modal(document.getElementById('deleteSchoolYearModal')).show();
        });
    });

});
</script>
</x-app-layout>
