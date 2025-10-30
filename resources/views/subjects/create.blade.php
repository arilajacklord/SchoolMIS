<x-app-layout>
    <!-- Add New Subject Modal -->
    <div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="addSubjectModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addSubjectModalLabel">Add New Subject</h5>
                    <a href="{{ route('subjects.index') }}" class="btn-close" aria-label="Close"></a>
                </div>

                <div class="modal-body">
                    <form action="{{ route('subjects.store') }}" method="POST" id="addSubjectForm">
                        @csrf

                        {{-- Subject ID & Course Code --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="subject_id" class="form-label"><strong>Subject ID</strong></label>
                                <input type="text" name="subject_id" id="subject_id" 
                                       class="form-control @error('subject_id') is-invalid @enderror"
                                       value="{{ old('subject_id') }}" placeholder="Enter Subject ID">
                                @error('subject_id')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="course_code" class="form-label"><strong>Course Code</strong></label>
                                <input type="text" name="course_code" id="course_code" 
                                       class="form-control @error('course_code') is-invalid @enderror"
                                       value="{{ old('course_code') }}" placeholder="Enter Course Code">
                                @error('course_code')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Descriptive Title --}}
                        <div class="mb-3">
                            <label for="descriptive_title" class="form-label"><strong>Descriptive Title</strong></label>
                            <input type="text" name="descriptive_title" id="descriptive_title" 
                                   class="form-control @error('descriptive_title') is-invalid @enderror"
                                   value="{{ old('descriptive_title') }}" placeholder="Enter Descriptive Title">
                            @error('descriptive_title')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Units --}}
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="lec_units" class="form-label"><strong>Lecture Units</strong></label>
                                <input type="number" step="1" name="lec_units" id="lec_units" 
                                       class="form-control @error('lec_units') is-invalid @enderror"
                                       value="{{ old('lec_units') }}" placeholder="0">
                                @error('lec_units')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="lab_units" class="form-label"><strong>Lab Units</strong></label>
                                <input type="number" step="1" name="lab_units" id="lab_units" 
                                       class="form-control @error('lab_units') is-invalid @enderror"
                                       value="{{ old('lab_units') }}" placeholder="0">
                                @error('lab_units')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="total_units" class="form-label"><strong>Total Units</strong></label>
                                <input type="number" step="1" name="total_units" id="total_units" 
                                       class="form-control bg-light fw-bold text-center @error('total_units') is-invalid @enderror"
                                       value="{{ old('total_units', 0) }}" readonly>
                                @error('total_units')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Co-Requisite & Pre-Requisite --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="co_requisite" class="form-label"><strong>Co-Requisite</strong></label>
                                <input type="text" name="co_requisite" id="co_requisite" 
                                       class="form-control @error('co_requisite') is-invalid @enderror"
                                       value="{{ old('co_requisite') }}" placeholder="Enter Co-Requisite Subject ID">
                                @error('co_requisite')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="pre_requisite" class="form-label"><strong>Pre-Requisite</strong></label>
                                <input type="text" name="pre_requisite" id="pre_requisite" 
                                       class="form-control @error('pre_requisite') is-invalid @enderror"
                                       value="{{ old('pre_requisite') }}" placeholder="Enter Pre-Requisite Subject ID">
                                @error('pre_requisite')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('subjects.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-floppy-disk"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ Auto-show modal and auto-calculate total units --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Show modal automatically
        var modal = new bootstrap.Modal(document.getElementById('addSubjectModal'));
        modal.show();

        // Auto-calculate total units
        const lecInput = document.getElementById('lec_units');
        const labInput = document.getElementById('lab_units');
        const totalInput = document.getElementById('total_units');

        function updateTotal() {
            const lec = parseFloat(lecInput.value) || 0;
            const lab = parseFloat(labInput.value) || 0;
            totalInput.value = lec + lab;
        }

        lecInput.addEventListener('input', updateTotal);
        labInput.addEventListener('input', updateTotal);
    });
    </script>
</x-app-layout>
