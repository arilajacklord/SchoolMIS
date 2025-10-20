<x-app-layout>
    <!-- Edit Subject Modal -->
    <div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="editSubjectModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editSubjectModalLabel">Edit Subject</h5>
            <a href="{{ route('subjects.index') }}" class="btn-close" aria-label="Close"></a>
          </div>
          <div class="modal-body">
            <form action="{{ route('subjects.update', $subject) }}" method="POST" id="editSubjectForm">
                @csrf
                @method('PUT')

                {{-- Subject ID (readonly) --}}
                <div class="mb-3">
                    <label for="subject_id" class="form-label"><strong>Subject ID:</strong></label>
                    <input type="text" name="subject_id" id="subject_id" class="form-control" 
                           value="{{ old('subject_id', $subject->subject_id) }}" readonly>
                </div>

                {{-- Course Code --}}
                <div class="mb-3">
                    <label for="course_code" class="form-label"><strong>Course Code:</strong></label>
                    <input type="text" name="course_code" id="course_code" 
                           class="form-control @error('course_code') is-invalid @enderror"
                           value="{{ old('course_code', $subject->course_code) }}" placeholder="Enter Course Code">
                    @error('course_code')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Descriptive Title --}}
                <div class="mb-3">
                    <label for="descriptive_title" class="form-label"><strong>Descriptive Title:</strong></label>
                    <input type="text" name="descriptive_title" id="descriptive_title" 
                           class="form-control @error('descriptive_title') is-invalid @enderror"
                           value="{{ old('descriptive_title', $subject->descriptive_title) }}" placeholder="Enter Descriptive Title">
                    @error('descriptive_title')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Lecture Units --}}
                <div class="mb-3">
                    <label for="led_units" class="form-label"><strong>Lecture Units:</strong></label>
                    <input type="number" step="1" name="led_units" id="led_units" 
                           class="form-control @error('led_units') is-invalid @enderror"
                           value="{{ old('led_units', $subject->led_units) }}" placeholder="Enter Lecture Units">
                    @error('led_units')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Lab Units --}}
                <div class="mb-3">
                    <label for="lab_units" class="form-label"><strong>Lab Units:</strong></label>
                    <input type="number" step="1" name="lab_units" id="lab_units" 
                           class="form-control @error('lab_units') is-invalid @enderror"
                           value="{{ old('lab_units', $subject->lab_units) }}" placeholder="Enter Lab Units">
                    @error('lab_units')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Total Units --}}
                <div class="mb-3">
                    <label for="total_units" class="form-label"><strong>Total Units:</strong></label>
                    <input type="number" step="1" name="total_units" id="total_units" 
                           class="form-control @error('total_units') is-invalid @enderror"
                           value="{{ old('total_units', $subject->total_units) }}" placeholder="Enter Total Units">
                    @error('total_units')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Co-Requisite --}}
                <div class="mb-3">
                    <label for="co_requisite" class="form-label"><strong>Co-Requisite:</strong></label>
                    <input type="text" name="co_requisite" id="co_requisite" 
                           class="form-control @error('co_requisite') is-invalid @enderror"
                           value="{{ old('co_requisite', $subject->co_requisite) }}" placeholder="Enter Co-Requisite Subject ID">
                    @error('co_requisite')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Pre-Requisite --}}
                <div class="mb-3">
                    <label for="pre_requisite" class="form-label"><strong>Pre-Requisite:</strong></label>
                    <input type="text" name="pre_requisite" id="pre_requisite" 
                           class="form-control @error('pre_requisite') is-invalid @enderror"
                           value="{{ old('pre_requisite', $subject->pre_requisite) }}" placeholder="Enter Pre-Requisite Subject ID">
                    @error('pre_requisite')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Update
                    </button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
          var modal = new bootstrap.Modal(document.getElementById('editSubjectModal'));
          modal.show();
      });
    </script>
</x-app-layout>
