<x-app-layout>

  <!-- Include jQuery and DataTables CSS/JS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

  <div class="container-xxl flex-grow-1 container-p-y mt-4">
    <div class="row">
      <div class="col-lg-12">

        @if(session('success'))
          <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <div class="card">
          <h5 class="card-header text-bg-primary d-flex justify-content-between align-items-center">
            School Year List
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#schoolyearModal" id="addSchoolyearBtn">
              <i class="lni lni-add-files"></i> Add School Year
            </button>
          </h5>

          <div class="card-body">
            <table id="schoolyearsTable" class="table table-striped display" style="width:100%">
              <thead>
                <tr>
                  <th>School Year</th>
                  <th>Semester</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($schoolyears as $schoolyear)
                <tr>
                  <td>{{ $schoolyear->schoolyear ?? 'N/A' }}</td>
                  <td>{{ $schoolyear->semester ?? 'N/A' }}</td>
                  <td>
                    <button class="btn btn-info btn-sm viewSchoolyearBtn" data-id="{{ $schoolyear->schoolyear_id }}" title="View">
                      <i class="lni lni-eye"></i>
                    </button>
                    <button class="btn btn-warning btn-sm editSchoolyearBtn" data-id="{{ $schoolyear->schoolyear_id }}" title="Edit">
                      <i class="lni lni-pencil"></i>
                    </button>
                    <button class="btn btn-danger btn-sm deleteSchoolyearBtn" data-id="{{ $schoolyear->schoolyear_id }}" title="Delete">
                      <i class="lni lni-trash-can"></i>
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Add/Edit Modal -->
  <div class="modal fade" id="schoolyearModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
      <form id="schoolyearForm" method="POST" action="{{ route('schoolyears.store') }}">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="schoolyearModalLabel">Add New School Year</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="schoolyear_id" id="schoolyear_id" />

            <div class="mb-3">
              <label for="schoolyear" class="form-label"><b>School Year</b></label>
              <input type="text" class="form-control" id="schoolyear" name="schoolyear" placeholder="e.g. 2025-2026" required>
            </div>

            <div class="mb-3">
              <label for="semester" class="form-label"><b>Semester</b></label>
              <select id="semester" name="semester" class="form-select" required>
                <option value="" disabled selected>Select Semester</option>
                <option value="1st Semester">1st Semester</option>
                <option value="2nd Semester">2nd Semester</option>
                <option value="Summer">Summer</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="schoolyearModalSaveBtn">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteSchoolyearModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <form id="deleteSchoolyearForm" method="POST" action="">
        @csrf
        @method('DELETE')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete School Year</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this school year?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- View School Year Modal -->
  <div class="modal fade" id="viewSchoolyearModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">School Year Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered mb-0">
            <tbody>
              <tr>
                <th>School Year</th>
                <td id="view_schoolyear"></td>
              </tr>
              <tr>
                <th>Semester</th>
                <td id="view_semester"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script>
  $(document).ready(function() {
    // Initialize DataTable
    $('#schoolyearsTable').DataTable();

    // Reset modal for adding new school year
    $('#addSchoolyearBtn').click(function() {
      $('#schoolyearForm')[0].reset();
      $('#schoolyearForm').attr('action', "{{ route('schoolyears.store') }}");
      $('#schoolyearForm').find('input[name="_method"]').remove();
      $('#schoolyearModalLabel').text('Add New School Year');
      $('#schoolyearModalSaveBtn').text('Save');
      $('#schoolyear_id').val('');
      $('#semester').val('').change();
    });

    // Edit school year
    $('.editSchoolyearBtn').click(function() {
      const id = $(this).data('id');
      $.get(`/schoolyears/${id}/api-edit`, function(data) {
        $('#schoolyear_id').val(data.schoolyear_id);
        $('#schoolyear').val(data.schoolyear);
        $('#semester').val(data.semester);

        $('#schoolyearForm').attr('action', `/schoolyears/${id}`);
        if ($('#schoolyearForm').find('input[name="_method"]').length === 0) {
          $('#schoolyearForm').append('<input type="hidden" name="_method" value="PUT" />');
        }

        $('#schoolyearModalLabel').text('Edit School Year');
        $('#schoolyearModalSaveBtn').text('Update');

        var schoolyearModal = new bootstrap.Modal(document.getElementById('schoolyearModal'));
        schoolyearModal.show();
      }).fail(function() {
        alert('Failed to fetch school year data.');
      });
    });

    // Delete school year
    $('.deleteSchoolyearBtn').click(function() {
      const id = $(this).data('id');
      $('#deleteSchoolyearForm').attr('action', `/schoolyears/${id}`);
      var deleteModal = new bootstrap.Modal(document.getElementById('deleteSchoolyearModal'));
      deleteModal.show();
    });

    // View school year details
    $('.viewSchoolyearBtn').click(function() {
      const id = $(this).data('id');
      $.get(`/schoolyears/${id}/api-show`, function(data) {
        $('#view_schoolyear').text(data.schoolyear);
        $('#view_semester').text(data.semester);

        var viewModal = new bootstrap.Modal(document.getElementById('viewSchoolyearModal'));
        viewModal.show();
      }).fail(function() {
        alert('Failed to fetch school year details.');
      });
    });
  });
  </script>

</x-app-layout>
