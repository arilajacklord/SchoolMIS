<x-app-layout>
<div class="card mt-5">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Subjects</h2>
        <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
            <i class="lni lni-plus"></i> Add Subject
        </a>
    </div>

    <div class="card-body">
        {{-- ✅ Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- ✅ Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

          {{-- ✅ Search Input --}}
        <div class="mb-3 d-flex justify-content-end">
            <input type="text" id="searchInput" class="form-control w-25" placeholder="Search School Year...">
        </div>

      {{-- ✅ Table --}}
            <table class="table table-bordered table-striped align-middle text-center" id="subjectsTable">
                <thead style="background-color: #084298; color: white;">
                    <tr>
                        <th>ID</th>
                        <th>Course Code</th>
                        <th>Descriptive Title</th>
                        <th>Total Units</th>
                        <th>Co-Requisite</th>
                        <th>Pre-Requisite</th>                    
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                    <tr>
                        <td>{{ $subject->subject_id }}</td>
                        <td>{{ $subject->course_code }}</td>
                        <td>{{ $subject->descriptive_title }}</td>
                        <td>{{ $subject->total_units }}</td>
                        <td>{{ $subject->co_requisite ?? 'None' }}</td>
                        <td>{{ $subject->pre_requisite ?? 'None' }}</td>
                        <td>
                            <button class="btn btn-info btn-sm viewBtn" data-id="{{ $subject->subject_id }}">
                                <i class="lni lni-eye"></i>
                            </button>
                            <button class="btn btn-warning btn-sm editBtn" data-id="{{ $subject->subject_id }}">
                                <i class="lni lni-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm deleteBtn" data-id="{{ $subject->subject_id }}">
                                <i class="lni lni-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        <div class="mt-3">
            {{ $subjects->links() }}
        </div>
    </div>
</div>

{{-- ============================
    ADD SUBJECT MODAL
============================= --}}
<div class="modal fade" id="addSubjectModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Add New Subject</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('subjects.store') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">Course Code</label>
            <input type="text" name="course_code" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Descriptive Title</label>
            <input type="text" name="descriptive_title" class="form-control" required>
          </div>
          <div class="row">
            <div class="col-md-4 mb-3">
              <label class="form-label">Lecture Units</label>
              <input type="number" name="lec_units" id="a_lec_units" class="form-control" value="0" min="0">
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Lab Units</label>
              <input type="number" name="lab_units" id="a_lab_units" class="form-control" value="0" min="0">
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Total Units</label>
              <input type="number" name="total_units" id="a_total_units" class="form-control" readonly>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Co-Requisite</label>
            <input type="text" name="co_requisite" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Pre-Requisite</label>
            <input type="text" name="pre_requisite" class="form-control">
          </div>
          <button type="submit" class="btn btn-success float-end">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- ============================
    VIEW SUBJECT MODAL
============================= --}}
<div class="modal fade" id="viewSubjectModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title"><i class="lni lni-eye me-2"></i> Subject Details</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body bg-light">
        <table class="table table-borderless">
          <tbody>
            <tr><th>ID</th><td id="v_subject_id"></td></tr>
            <tr><th>Course Code</th><td id="v_course_code"></td></tr>
            <tr><th>Descriptive Title</th><td id="v_descriptive_title"></td></tr>
            <tr><th>Lecture Units</th><td id="v_lec_units"></td></tr>
            <tr><th>Lab Units</th><td id="v_lab_units"></td></tr>
            <tr><th>Total Units</th><td id="v_total_units" class="text-success fw-bold"></td></tr>
            <tr><th>Co-Requisite</th><td id="v_co_requisite"></td></tr>
            <tr><th>Pre-Requisite</th><td id="v_pre_requisite"></td></tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

{{-- ============================
    EDIT SUBJECT MODAL
============================= --}}
<div class="modal fade" id="editSubjectModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title">Edit Subject</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editForm" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label class="form-label">Course Code</label>
            <input type="text" class="form-control" name="course_code" id="e_course_code">
          </div>
          <div class="mb-3">
            <label class="form-label">Descriptive Title</label>
            <input type="text" class="form-control" name="descriptive_title" id="e_descriptive_title">
          </div>
          <div class="row">
            <div class="col-md-4 mb-3">
              <label class="form-label">Lecture Units</label>
              <input type="number" class="form-control" name="lec_units" id="e_lec_units">
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Lab Units</label>
              <input type="number" class="form-control" name="lab_units" id="e_lab_units">
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Total Units</label>
              <input type="number" class="form-control" name="total_units" id="e_total_units" readonly>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Co-Requisite</label>
            <input type="text" class="form-control" name="co_requisite" id="e_co_requisite">
          </div>
          <div class="mb-3">
            <label class="form-label">Pre-Requisite</label>
            <input type="text" class="form-control" name="pre_requisite" id="e_pre_requisite">
          </div>
          <button type="submit" class="btn btn-success float-end">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- ============================
    DELETE CONFIRM MODAL
============================= --}}
<div class="modal fade" id="deleteSubjectModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirm Delete</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <p>Are you sure you want to delete this subject?</p>
        <form id="deleteForm" method="POST" data-route="{{ route('subjects.destroy', ':id') }}">
          @csrf
          @method('DELETE')
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- ============================
    JAVASCRIPT SECTION
============================= --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Compute total units in Add modal
    ['a_lec_units','a_lab_units'].forEach(id => {
        document.getElementById(id).addEventListener('input', () => {
            const lec = parseInt(document.getElementById('a_lec_units').value || 0);
            const lab = parseInt(document.getElementById('a_lab_units').value || 0);
            document.getElementById('a_total_units').value = lec + lab;
        });
    });

    // View Subject
    document.querySelectorAll('.viewBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch(`/subjects/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('v_subject_id').textContent = data.subject_id;
                    document.getElementById('v_course_code').textContent = data.course_code;
                    document.getElementById('v_descriptive_title').textContent = data.descriptive_title;
                    document.getElementById('v_lec_units').textContent = data.lec_units;
                    document.getElementById('v_lab_units').textContent = data.lab_units;
                    document.getElementById('v_total_units').textContent = data.total_units;
                    document.getElementById('v_co_requisite').textContent = data.co_requisite ?? 'None';
                    document.getElementById('v_pre_requisite').textContent = data.pre_requisite ?? 'None';
                    new bootstrap.Modal(document.getElementById('viewSubjectModal')).show();
                });
        });
    });

   const searchInput = document.getElementById('searchInput');
searchInput.addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#subjectsTable tbody tr');
    rows.forEach(row => {
        const courseCode = row.cells[1].textContent.toLowerCase();
        const title = row.cells[2].textContent.toLowerCase();
        row.style.display = (courseCode.includes(filter) || title.includes(filter)) ? '' : 'none';
    });
});


    // Edit Subject
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch(`/subjects/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('e_course_code').value = data.course_code;
                    document.getElementById('e_descriptive_title').value = data.descriptive_title;
                    document.getElementById('e_lec_units').value = data.lec_units;
                    document.getElementById('e_lab_units').value = data.lab_units;
                    document.getElementById('e_total_units').value = data.total_units;
                    document.getElementById('e_co_requisite').value = data.co_requisite ?? '';
                    document.getElementById('e_pre_requisite').value = data.pre_requisite ?? '';
                    document.getElementById('editForm').action = `/subjects/${id}`;
                    new bootstrap.Modal(document.getElementById('editSubjectModal')).show();
                });
        });
    });

    // Auto update total units in Edit modal
    ['e_lec_units','e_lab_units'].forEach(id => {
        document.getElementById(id).addEventListener('input', () => {
            const lec = parseInt(document.getElementById('e_lec_units').value || 0);
            const lab = parseInt(document.getElementById('e_lab_units').value || 0);
            document.getElementById('e_total_units').value = lec + lab;
        });
    });

    // Delete Subject
    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            let form = document.getElementById('deleteForm');
            let route = form.dataset.route.replace(':id', id);
            form.action = route;
            new bootstrap.Modal(document.getElementById('deleteSubjectModal')).show();
        });
    });
});
 </script>
</x-app-layout>
