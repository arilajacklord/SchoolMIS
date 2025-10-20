<x-app-layout>
    <!-- Subject Details Modal -->
    <div class="modal fade" id="subjectDetailsModal" tabindex="-1" aria-labelledby="subjectDetailsModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="subjectDetailsModalLabel">Subject Details</h5>
            <a href="{{ route('subjects.index') }}" class="btn-close" aria-label="Close"></a>
          </div>
          <div class="modal-body">
            <dl class="row">
                <dt class="col-sm-3">Subject ID</dt>
                <dd class="col-sm-9">{{ $subject->subject_id }}</dd>

                <dt class="col-sm-3">Course Code</dt>
                <dd class="col-sm-9">{{ $subject->course_code }}</dd>

                <dt class="col-sm-3">Descriptive Title</dt>
                <dd class="col-sm-9">{{ $subject->descriptive_title }}</dd>

                <dt class="col-sm-3">Lecture Units</dt>
                <dd class="col-sm-9">{{ $subject->led_units }}</dd>

                <dt class="col-sm-3">Lab Units</dt>
                <dd class="col-sm-9">{{ $subject->lab_units }}</dd>

                <dt class="col-sm-3">Total Units</dt>
                <dd class="col-sm-9">{{ $subject->total_units }}</dd>

                <dt class="col-sm-3">Co-Requisite</dt>
                <dd class="col-sm-9">{{ $subject->co_requisite ?: 'None' }}</dd>

                <dt class="col-sm-3">Pre-Requisite</dt>
                <dd class="col-sm-9">{{ $subject->pre_requisite ?: 'None' }}</dd>
            </dl>
          </div>
          <div class="modal-footer">
            <a href="{{ route('subjects.index') }}" class="btn btn-primary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
          var modal = new bootstrap.Modal(document.getElementById('subjectDetailsModal'));
          modal.show();
      });
    </script>
</x-app-layout>
