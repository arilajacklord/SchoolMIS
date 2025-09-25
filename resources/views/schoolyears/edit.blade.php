<x-app-layout>
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Schoolyear List</h2>
            {{-- Optional: Hide or remove the trigger button --}}
            {{--
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 me-3">
                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSchoolYearModal">
                    <i class="fa fa-pen"></i> Edit School Year
                </button>
            </div>
            --}}
        </div>

        <!-- Edit Modal (Directly Visible) -->
        <div class="modal show d-block"
             id="editSchoolYearModal"
             tabindex="-1"
             aria-labelledby="editSchoolYearModalLabel"
             aria-modal="true"
             role="dialog"
             style="background-color: rgba(0,0,0,0.5);"
        >
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSchoolYearModalLabel">Edit School Year</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                onclick="window.location='{{ route('schoolyears.index') }}'"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form action="{{ route('schoolyears.update', $schoolyear->schoolyear_id) }}"
                              method="POST"
                              id="editSchoolYearForm">
                            @csrf
                            @method('PUT')

                            {{-- School Year ID --}}
                            <div class="mb-3">
                                <label for="schoolyear_id" class="form-label"><strong>School Year ID:</strong></label>
                                <input type="text"
                                       name="schoolyear_id"
                                       id="schoolyear_id"
                                       class="form-control"
                                       value="{{ $schoolyear->schoolyear_id }}"
                                       readonly>
                            </div>

                            {{-- School Year Dropdown --}}
                            <div class="mb-3">
                                <label for="schoolyear" class="form-label"><strong>School Year:</strong></label>
                                <select name="schoolyear" id="schoolyear"
                                        class="form-select @error('schoolyear') is-invalid @enderror">
                                    <option value="">-- Select School Year --</option>
                                    @foreach(['2023-2024', '2024-2025', '2025-2026'] as $year)
                                        <option value="{{ $year }}"
                                                {{ old('schoolyear', $schoolyear->schoolyear) == $year ? 'selected' : '' }}>
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
                                <select name="semester" id="semester"
                                        class="form-select @error('semester') is-invalid @enderror">
                                    <option value="">-- Select Semester --</option>
                                    @foreach(['1st', '2nd', 'Summer'] as $sem)
                                        <option value="{{ $sem }}"
                                                {{ old('semester', $schoolyear->semester) == $sem ? 'selected' : '' }}>
                                            {{ $sem }} Semester
                                        </option>
                                    @endforeach
                                </select>
                                @error('semester')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </form>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <a href="{{ route('schoolyears.index') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" form="editSchoolYearForm" class="btn btn-success">
                            <i class="fa fa-save"></i> Update
                        </button>
                    </div>

                </div>
            </div>
        </div>

        {{-- Removed JS auto-show modal script as modal is directly visible --}}
    </div>
</x-app-layout>
