<x-app-layout>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        
                        <th>Subject</th>
                        <th>School Year</th>
                        <th>User</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                 @foreach($enrollments as $enrollment)
                        <tr>
                           
                            <td>{{ $enrollment->descriptive_title ?? 'N/A' }}</td>
                            <td>{{ $enrollment->schoolyear ?? 'N/A' }}</td>
                            <td>{{ $enrollment->name ?? 'N/A' }}</td>
                                   
                            <td>
                                
                                <a href="{{ route('enrollments.show', $enrollment->enroll_id) }}" class="btn btn-info btn-sm">
                                 <i class="lni lni-eye"></i>
                            </a>
                            <a href="{{ route('enrollments.edit', $enrollment->enroll_id) }}" class="btn btn-warning btn-sm">
                                <i class="lni lni-library"></i>
                            </a>
                            <form action="{{ route('enrollments.destroy', $enrollment->enroll_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this enrollment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="lni lni-trash-can"></i>
                                </button>
                            </form>


        {{-- Success & Error Messages --}}
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
            Enrollment List
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#enrollmentModal" id="addEnrollmentBtn">
              <i class="lni lni-add-files"></i> Add Enrollment
            </button>
          </h5>

          <div class="card-body">
            <table id="enrollmentsTable" class="table table-striped display" style="width:100%">
              <thead>
                <tr>
                  <th>Subject</th>
                  <th>School Year</th>
                  <th>User</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($enroll_list as $enrollment)
                <tr>
                  
                  <td>{{ $enrollment->descriptive_title ?? 'N/A' }}</td>
                  <td>{{ $enrollment->schoolyear ?? 'N/A' }}</td>
                  <td>{{ $enrollment->name ?? 'N/A' }}</td>
                  <td>
                    <button class="btn btn-info btn-sm viewEnrollmentBtn" data-id="{{ $enrollment->enroll_id }}">
                      <i class="lni lni-eye"></i> View
                    </button>
                    <button class="btn btn-warning btn-sm editEnrollmentBtn" data-id="{{ $enrollment->enroll_id }}">
                      <i class="lni lni-library"></i> Edit
                    </button>
                    <button class="btn btn-danger btn-sm deleteEnrollmentBtn" data-id="{{ $enrollment->enroll_id }}">
                      <i class="lni lni-trash-can"></i> Delete
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>

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

  <!-- Add/Edit Enrollment Modal -->
  <div class="modal fade" id="enrollmentModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-md">
      <form id="enrollmentForm" method="POST" action="{{ route('enrollments.store') }}">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="enrollmentModalLabel">Add Enrollment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="enroll_id" id="enroll_id" />

            <div class="mb-3">
              <label for="subject_id" class="form-label"><b>Subject</b></label>
              <select id="subject_id" name="subject_id" class="form-select" required>
                <option value="" disabled selected>Select Subject</option>
                @foreach($subjects as $subject)
                  <option value="{{ $subject->subject_id }}">
                    {{ $subject->subject_id }} - {{ $subject->descriptive_title }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="schoolyear_id" class="form-label"><b>School Year</b></label>
              <select id="schoolyear_id" name="schoolyear_id" class="form-select" required>
                <option value="" disabled selected>Select School Year</option>
                @foreach($schoolyears as $schoolyear)
                  <option value="{{ $schoolyear->schoolyear_id }}">
                    {{ $schoolyear->schoolyear }} - {{ $schoolyear->semester }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="user_id" class="form-label"><b>User</b></label>
              <select id="user_id" name="user_id" class="form-select" required>
                <option value="" disabled selected>Select User</option>
                @foreach($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="enrollmentModalSaveBtn">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteEnrollmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <form id="deleteEnrollmentForm" method="POST" action="">
        @csrf
        @method('DELETE')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Enrollment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this enrollment?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- View Enrollment Modal -->
  <div class="modal fade" id="viewEnrollmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Enrollment Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th>Subject</th>
                <td id="view_subject"></td>
              </tr>
              <tr>
                <th>School Year</th>
                <td id="view_schoolyear"></td>
              </tr>
              <tr>
                <th>User</th>
                <td id="view_user"></td>
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
      $('#enrollmentsTable').DataTable();

      // Reset modal on Add Enrollment button click
      $('#addEnrollmentBtn').click(function() {
        $('#enrollmentForm')[0].reset();
        $('#enrollmentForm').attr('action', "{{ route('enrollments.store') }}");
        $('#enrollmentForm').find('input[name="_method"]').remove();
        $('#enrollmentModalLabel').text('Add Enrollment');
        $('#enrollmentModalSaveBtn').text('Save');
        $('#enroll_id').val('');
        $('#subject_id').val('').change();
        $('#schoolyear_id').val('').change();
        $('#user_id').val('').change();
      });

      // Edit enrollment - fetch data and show modal
      $('.editEnrollmentBtn').click(function() {
        const id = $(this).data('id');
        $.get(`/enrollments/${id}/api-edit`, function(data) {
          $('#enroll_id').val(data.enroll_id);
          $('#subject_id').val(data.subject_id);
          $('#schoolyear_id').val(data.schoolyear_id);
          $('#user_id').val(data.user_id);

          $('#enrollmentForm').attr('action', `/enrollments/${id}`);
          if ($('#enrollmentForm').find('input[name="_method"]').length === 0) {
            $('#enrollmentForm').append('<input type="hidden" name="_method" value="PUT" />');
          }

          $('#enrollmentModalLabel').text('Edit Enrollment');
          $('#enrollmentModalSaveBtn').text('Update');

          var enrollmentModal = new bootstrap.Modal(document.getElementById('enrollmentModal'));
          enrollmentModal.show();
        }).fail(function() {
          alert('Failed to fetch enrollment data.');
        });
      });

      // Delete enrollment - set action and show modal
      $('.deleteEnrollmentBtn').click(function() {
        const id = $(this).data('id');
        $('#deleteEnrollmentForm').attr('action', `/enrollments/${id}`);
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteEnrollmentModal'));
        deleteModal.show();
      });

      // View enrollment details - fetch and show modal
      $('.viewEnrollmentBtn').click(function() {
        const id = $(this).data('id');
        $.get(`/enrollments/${id}/api-show`, function(data) {
          $('#view_subject').text(data.subject);
          $('#view_schoolyear').text(`${data.schoolyear} - ${data.semester}`);
          $('#view_user').text(data.user);

          var viewModal = new bootstrap.Modal(document.getElementById('viewEnrollmentModal'));
          viewModal.show();
        }).fail(function() {
          alert('Failed to fetch enrollment details.');
        });
      });
    });
  </script>

</x-app-layout>
