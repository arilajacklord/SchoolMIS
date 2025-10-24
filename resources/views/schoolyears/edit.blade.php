<x-app-layout>
    <!-- Edit School Year Modal -->
    <div class="modal fade" id="editSchoolYearModal" tabindex="-1" aria-labelledby="editSchoolYearModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editSchoolYearModalLabel">Edit School Year</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('schoolyears.update', $schoolyear->schoolyear_id) }}" method="POST" id="editSchoolYearForm">
                @csrf
                @method('PUT')

                {{-- School Year ID (readonly) --}}
                <div class="mb-3">
                    <label for="schoolyear_id" class="form-label"><strong>School Year ID:</strong></label>
                    <input
                        type="text"
                        name="schoolyear_id"
                        id="schoolyear_id"
                        class="form-control"
                        value="{{ $schoolyear->schoolyear_id }}"
                        readonly>
                </div>

                {{-- School Year Dropdown --}}
                <div class="mb-3">
                    <label for="schoolyear" class="form-label"><strong>School Year:</strong></label>
                    <select
                        name="schoolyear"
                        id="schoolyear"
                        class="form-select @error('schoolyear') is-invalid @enderror">
                        <option value="">-- Select School Year --</option>
                        @foreach(['2023-2024', '2024-2025', '2025-2026'] as $year)
                            <option value="{{ $year }}" {{ old('schoolyear', $schoolyear->schoolyear) == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                    @error('schoolyear')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Semester Dropdown --}}
                <div class="mb-3">
                    <label for="semester" class="form-label"><strong>Semester:</strong></label>
                    <select
                        name="semester"
                        id="semester"
                        class="form-select @error('semester') is-invalid @enderror">
                        <option value="">-- Select Semester --</option>
                        @foreach(['1st Semester', '2nd Semester', 'Summer'] as $sem)
                            <option value="{{ $sem }}" {{ old('semester', $schoolyear->semester) == $sem ? 'selected' : '' }}>
                                {{ $sem }}
                            </option>
                        @endforeach
                    </select>
                    @error('semester')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('schoolyears.index') }}" class="btn btn-secondary" data-bs-dismiss="modal">
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

    {{-- Script to show the modal on page load --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modal = new bootstrap.Modal(document.getElementById('editSchoolYearModal'));
            modal.show();
        });
    </script>
</x-app-layout>
