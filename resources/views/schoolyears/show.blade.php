<x-app-layout>
    <!-- School Year Details Modal -->
    <div class="modal fade" id="schoolYearDetailsModal" tabindex="-1" aria-labelledby="schoolYearDetailsModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="schoolYearDetailsModalLabel">School Year Details</h5>
            <a href="{{ route('schoolyears.index') }}" class="btn-close" aria-label="Close"></a>
          </div>
          <div class="modal-body">
            <div class="mb-3">
                <label class="form-label"><strong>School Year ID:</strong></label>
                <div class="form-control-plaintext">{{ $schoolyear->schoolyear_id }}</div>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>School Year:</strong></label>
                <div class="form-control-plaintext">{{ $schoolyear->schoolyear }}</div>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Semester:</strong></label>
                <div class="form-control-plaintext">{{ $schoolyear->semester }}</div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="{{ route('schoolyears.index') }}" class="btn btn-secondary">
              <i class="fa fa-arrow-left"></i> Back
            </a>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
          var modal = new bootstrap.Modal(document.getElementById('schoolYearDetailsModal'));
          modal.show();
      });
    </script>
</x-app-layout>
