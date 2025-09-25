<x-app-layout>
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Subject List</h2>
            {{-- Optional: Remove this button since modal is always visible --}}
            {{-- 
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 me-3">
                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSubjectModal">
                    <i class="fa fa-pen"></i> Edit Subject
                </button>
            </div>
            --}}
        </div>

        <!-- Modal always visible -->
        <div class="modal show d-block" 
             id="editSubjectModal" 
             tabindex="-1" 
             aria-labelledby="editSubjectModalLabel" 
             role="dialog" 
             aria-modal="true"
             style="background-color: rgba(0,0,0,0.5);">

            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSubjectModalLabel">Edit Subject</h5>
                        <button type="button" class="btn-close" aria-label="Close" 
                            onclick="window.location='{{ route('subjects.index') }}'"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form action="{{ route('subjects.update', $subject) }}" method="POST" id="editSubjectForm">
                            @csrf
                            @method('PUT')

                            {{-- Subject ID (readonly) --}}
                            <div class="mb-3">
                                <label for="subject_id" class="form-label"><strong>Subject ID:</strong></label>
                                <input type="text" name="subject_id" id="subject_id" class="form-control" value="{{ old('subject_id', $subject->subject_id) }}" readonly>
                            </div>

                           {{-- Course Code Input --}}
                            <div class="mb-3">
                                <label for="course_code" class="form-label"><strong>Course Code:</strong></label>
                                <input type="text" 
                                    name="course_code" 
                                    id="course_code" 
                                    class="form-control @error('course_code') is-invalid @enderror"
                                    value="{{ old('course_code', $subject->course_code) }}" 
                                    placeholder="Enter Course Code">
                                @error('course_code')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                           <div class="mb-3">
                                <label for="descriptive_title" class="form-label"><strong>Descriptive Title:</strong></label>
                                <input type="text" name="descriptive_title" id="descriptive_title" 
                                    class="form-control @error('descriptive_title') is-invalid @enderror"
                                    value="{{ old('descriptive_title', $subject->descriptive_title) }}" 
                                    placeholder="Enter Descriptive Title">
                                @error('descriptive_title')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- Lecture Units --}}
                            <div class="mb-3">
                                <label for="led_units" class="form-label"><strong>Lecture Units:</strong></label>
                                <input type="number" step="1" name="led_units" id="led_units" class="form-control @error('led_units') is-invalid @enderror"
                                    value="{{ old('led_units', $subject->led_units) }}" placeholder="Enter Lecture Units">
                                @error('led_units')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Lab Units --}}
                            <div class="mb-3">
                                <label for="lab_units" class="form-label"><strong>Lab Units:</strong></label>
                                <input type="number" step="1" name="lab_units" id="lab_units" class="form-control @error('lab_units') is-invalid @enderror"
                                    value="{{ old('lab_units', $subject->lab_units) }}" placeholder="Enter Lab Units">
                                @error('lab_units')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Total Units --}}
                            <div class="mb-3">
                                <label for="total_units" class="form-label"><strong>Total Units:</strong></label>
                                <input type="number" step="1" name="total_units" id="total_units" class="form-control @error('total_units') is-invalid @enderror"
                                    value="{{ old('total_units', $subject->total_units) }}" placeholder="Enter Total Units">
                                @error('total_units')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                          {{-- Co-Requisite Input --}}
                            <div class="mb-3">
                                <label for="co_requisite" class="form-label"><strong>Co-Requisite:</strong></label>
                                <input type="text" 
                                    name="co_requisite" 
                                    id="co_requisite" 
                                    class="form-control @error('co_requisite') is-invalid @enderror"
                                    value="{{ old('co_requisite', $subject->co_requisite) }}" 
                                    placeholder="Enter Co-Requisite Subject ID">
                                @error('co_requisite')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Pre-Requisite Input --}}
                            <div class="mb-3">
                                <label for="pre_requisite" class="form-label"><strong>Pre-Requisite:</strong></label>
                                <input type="text" 
                                    name="pre_requisite" 
                                    id="pre_requisite" 
                                    class="form-control @error('pre_requisite') is-invalid @enderror"
                                    value="{{ old('pre_requisite', $subject->pre_requisite) }}" 
                                    placeholder="Enter Pre-Requisite Subject ID">
                                @error('pre_requisite')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </form>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <a class="btn btn-primary btn-sm" href="{{ route('subjects.index') }}">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" form="editSubjectForm" class="btn btn-success">
                            <i class="fa fa-save"></i> Update
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</x-app-layout>
