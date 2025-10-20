<x-app-layout>
    <!-- Modal -->
    <div class="modal fade" id="addSchoolYearModal" tabindex="-1" aria-labelledby="addSchoolYearModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addSchoolYearModalLabel">Add New School Year</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('schoolyears.store') }}" method="POST" id="addSchoolYearForm">
                @csrf


                <div class="mb-3">
                    <label for="schoolyear" class="form-label"><strong>School Year:</strong></label>
                    <select
                        name="schoolyear"
                        id="schoolyear"
                        class="form-select @error('schoolyear') is-invalid @enderror">
                        <option value="">-- Select School Year --</option>
                        @foreach(['2023-2024', '2024-2025', '2025-2026'] as $year)
                            <option value="{{ $year }}" {{ old('schoolyear') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                    @error('schoolyear')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="semester" class="form-label"><strong>Semester:</strong></label>
                    <select
                        name="semester"
                        id="semester"
                        class="form-select @error('semester') is-invalid @enderror">
                        <option value="">-- Select Semester --</option>
                        @foreach(['1st Semester', '2nd Semester', 'Summer'] as $sem)
                            <option value="{{ $sem }}" {{ old('semester') == $sem ? 'selected' : '' }}>
                                {{ $sem }}
                            </option>
                        @endforeach
                    </select>
                    @error('semester')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-floppy-disk"></i> Submit
                </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    {{-- Script to show modal on page load --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modalElement = document.getElementById('addSchoolYearModal');
            var modal = new bootstrap.Modal(modalElement);
            modal.show();
        });
    </script>
</x-app-layout>
