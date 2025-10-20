<x-app-layout>
<div class="card mt-5">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Course List</h2>
        <a href="{{ route('subjects.create') }}" class="btn btn-success btn-sm">
            <i class="fa fa-plus"></i> Add Subject
        </a>
    </div>

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

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Subject ID</th>
                        <th>Subject Code</th>
                        <th>Title</th>
                        <th>Lecture Units</th>
                        <th>Lab Units</th>
                        <th>Total Units</th>
                        <th>Co-Requisite</th>
                        <th>Pre-Requisite</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subjects as $index => $subject)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $subject->subject_id }}</td>
                            <td>{{ $subject->course_code }}</td>
                            <td>{{ $subject->descriptive_title }}</td>
                            <td>{{ $subject->led_units }}</td>
                            <td>{{ $subject->lab_units }}</td>
                            <td>{{ $subject->total_units }}</td>
                            <td>{{ $subject->co_requisite }}</td>
                            <td>{{ $subject->pre_requisite }}</td>
                            <td>

                                {{-- View (modal trigger) --}}
                                <button 
                                    class="btn btn-info btn-sm view-btn" 
                                    data-subject='@json($subject)'
                                    data-bs-toggle="modal"
                                    data-bs-target="#subjectModal"
                                    title="View">
                                    <i class="lni lni-eye"></i>
                                </button>

                                {{-- Edit --}}
                                 <button 
                                    class="btn btn-primary btn-sm edit-btn" 
                                    data-subject='@json($subject)'
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editSubjectModal" 
                                    title="Edit">
                                    <i class="lni lni-library"></i>
                                </button>

                                {{-- Delete --}}
                                 <form action="{{ route('subjects.destroy', $subject->subject_id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="lni lni-trash-can"></i>
                                        </button>
                                    </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No subjects found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Add/Edit Modal -->
  <div class="modal fade" id="subjectModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
      <form id="subjectForm" method="POST" action="{{ route('subjects.store') }}">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="subjectModalLabel">Add New Subject</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="subject_id" id="subject_id" />
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="course_code" class="form-label"><b>Subject Code</b></label>
                <input type="text" class="form-control" id="course_code" name="course_code" placeholder="Enter Subject Code" required />
              </div>
              <div class="col-md-6">
                <label for="descriptive_title" class="form-label"><b>Descriptive Title</b></label>
                <input type="text" class="form-control" id="descriptive_title" name="descriptive_title" placeholder="Enter Descriptive Title" required />
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-4">
                <label for="led_units" class="form-label"><b>Lecture Units</b></label>
                <input type="number" class="form-control" id="led_units" name="led_units" placeholder="Enter Lecture Units" required min="0" />
              </div>
              <div class="col-md-4">
                <label for="lab_units" class="form-label"><b>Lab Units</b></label>
                <input type="number" class="form-control" id="lab_units" name="lab_units" placeholder="Enter Lab Units" required min="0" />
              </div>
              <div class="col-md-4">
                <label for="total_units" class="form-label"><b>Total Units</b></label>
                <input type="number" class="form-control" id="total_units" name="total_units" placeholder="Enter Total Units" required min="0" readonly />
              </div>
            </div>

            <div class="mb-3">
              <label for="pre_requisite" class="form-label"><b>Pre-requisite</b></label>
              <input type="text" id="pre_requisite" name="pre_requisite" class="form-control" placeholder="Enter pre-requisite(s)" />
            </div>

            <div class="mb-3">
              <label for="co_requisite" class="form-label"><b>Co-requisite</b></label>
              <input type="text" id="co_requisite" name="co_requisite" class="form-control" placeholder="Enter co-requisite(s)" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="subjectModalSaveBtn">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteSubjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <form id="deleteSubjectForm" method="POST" action="">
        @csrf
        @method('DELETE')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Subject</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this subject?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- View Subject Modal -->
  <div class="modal fade" id="viewSubjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Subject Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tbody>
              <tr><th>Subject Code</th><td id="view_course_code"></td></tr>
              <tr><th>Descriptive Title</th><td id="view_descriptive_title"></td></tr>
              <tr><th>Lecture Units</th><td id="view_led_units"></td></tr>
              <tr><th>Lab Units</th><td id="view_lab_units"></td></tr>
              <tr><th>Total Units</th><td id="view_total_units"></td></tr>
              <tr><th>Co-Requisite</th><td id="view_co_requisite"></td></tr>
              <tr><th>Pre-Requisite</th><td id="view_pre_requisite"></td></tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
  $(document).ready(function() {
    // Initialize DataTable
    $('#subjectsTable').DataTable();

    // Auto-calculate total units
    $('#led_units, #lab_units').on('input', function () {
      const lecture = parseInt($('#led_units').val()) || 0;
      const lab = parseInt($('#lab_units').val()) || 0;
      $('#total_units').val(lecture + lab);
    });

    // Reset modal on Add New Subject button click
    $('#addSubjectBtn').click(function() {
      $('#subjectForm')[0].reset();
      $('#subjectForm').attr('action', "{{ route('subjects.store') }}");
      $('#subjectForm').find('input[name="_method"]').remove();
      $('#subjectModalLabel').text('Add New Subject');
      $('#subjectModalSaveBtn').text('Save');
      $('#subject_id').val('');
    });

    // Edit subject - fetch existing data and show modal
    $('.editSubjectBtn').click(function() {
      const id = $(this).data('id');
      $.get(`/subjects/${id}/api-edit`, function(data) {
        $('#subject_id').val(data.subject_id);
        $('#course_code').val(data.course_code);
        $('#descriptive_title').val(data.descriptive_title);
        $('#led_units').val(data.led_units);
        $('#lab_units').val(data.lab_units);
        $('#total_units').val(data.total_units);
        $('#co_requisite').val(data.co_requisite || '');
        $('#pre_requisite').val(data.pre_requisite || '');
        $('#subjectForm').attr('action', `/subjects/${id}`);
        if (!$('#subjectForm').find('input[name="_method"]').length) {
          $('#subjectForm').append('<input type="hidden" name="_method" value="PUT" />');
        }
        $('#subjectModalLabel').text('Edit Subject');
        $('#subjectModalSaveBtn').text('Update');
        new bootstrap.Modal(document.getElementById('subjectModal')).show();
      }).fail(() => alert('Failed to fetch subject data.'));
    });

    // Delete subject
    $('.deleteSubjectBtn').click(function() {
      const id = $(this).data('id');
      $('#deleteSubjectForm').attr('action', `/subjects/${id}`);
      new bootstrap.Modal(document.getElementById('deleteSubjectModal')).show();
    });

    // View subject
    $('.viewSubjectBtn').click(function() {
      const id = $(this).data('id');
      $.get(`/subjects/${id}/api-show`, function(data) {
        $('#view_course_code').text(data.course_code);
        $('#view_descriptive_title').text(data.descriptive_title);
        $('#view_led_units').text(data.led_units);
        $('#view_lab_units').text(data.lab_units);
        $('#view_total_units').text(data.total_units);
        $('#view_co_requisite').text(data.co_requisite);
        $('#view_pre_requisite').text(data.pre_requisite);
        new bootstrap.Modal(document.getElementById('viewSubjectModal')).show();
      }).fail(() => alert('Failed to fetch subject details.'));
    });
  });
  </script>

{{-- Subject Detail Modal --}}
<div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="subjectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="subjectModalLabel">Subject Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
            <tr><th>Subject ID</th><td id="modal-subject-id"></td></tr>
            <tr><th>Subject Code</th><td id="modal-course-code"></td></tr>
            <tr><th>Title</th><td id="modal-title"></td></tr>
            <tr><th>Lecture Units</th><td id="modal-led-units"></td></tr>
            <tr><th>Lab Units</th><td id="modal-lab-units"></td></tr>
            <tr><th>Total Units</th><td id="modal-total-units"></td></tr>
            <tr><th>Co-Requisite</th><td id="modal-co-requisite"></td></tr>
            <tr><th>Pre-Requisite</th><td id="modal-pre-requisite"></td></tr>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- JavaScript to populate modal --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const viewButtons = document.querySelectorAll('.view-btn');

        viewButtons.forEach(button => {
            button.addEventListener('click', () => {
                const subject = JSON.parse(button.getAttribute('data-subject'));

                document.getElementById('modal-subject-id').textContent = subject.subject_id ?? 'N/A';
                document.getElementById('modal-course-code').textContent = subject.course_code ?? 'N/A';
                document.getElementById('modal-title').textContent = subject.descriptive_title ?? 'N/A';
                document.getElementById('modal-led-units').textContent = subject.led_units ?? '0';
                document.getElementById('modal-lab-units').textContent = subject.lab_units ?? '0';
                document.getElementById('modal-total-units').textContent = subject.total_units ?? '0';
                document.getElementById('modal-co-requisite').textContent = subject.co_requisite ?? 'None';
                document.getElementById('modal-pre-requisite').textContent = subject.pre_requisite ?? 'None';
            });
        });
    });
</script>
@endpush

</x-app-layout>
