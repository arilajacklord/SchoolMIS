<x-app-layout>
    <!-- Card Header with Modal Trigger -->
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">School Year List</h2>
            <!-- You can hide the button since modal opens directly -->
            {{-- <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addSchoolYearModal">
                <i class="fa fa-plus"></i> Add New School Year
            </button> --}}
        </div>

        <!-- Add Modal: forced visible -->
        <div class="modal fade show d-block"
             id="addSchoolYearModal"
             tabindex="-1"
             aria-labelledby="addSchoolYearModalLabel"
             aria-modal="true"
             role="dialog"
             style="background-color: rgba(0,0,0,0.5);"
        >
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSchoolYearModalLabel">Add New School Year</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                onclick="window.location='{{ route('schoolyears.index') }}'"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form action="{{ route('schoolyears.store') }}" method="POST" id="addSchoolYearForm">
                            @csrf

                            {{-- School Year ID --}}
                            <div class="mb-3">
                                <label for="schoolyear_id" class="form-label"><strong>School Year ID:</strong></label>
                                <input
                                    type="text"
                                    name="schoolyear_id"
                                    id="schoolyear_id"
                                    class="form-control @error('schoolyear_id') is-invalid @enderror"
                                    value="{{ old('schoolyear_id') }}"
                                    placeholder="Enter School Year ID">
                                @error('schoolyear_id')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
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
                                        <option value="{{ $year }}" {{ old('schoolyear') == $year ? 'selected' : '' }}>
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
                                    @foreach(['1st', '2nd', 'Summer'] as $sem)
                                        <option value="{{ $sem }}" {{ old('semester') == $sem ? 'selected' : '' }}>
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
                        <a href="{{ route('schoolyears.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" form="addSchoolYearForm" class="btn btn-success">
                            <i class="fa-solid fa-floppy-disk"></i> Submit
                        </button>
                    </div>

                </div>
            </div>
        </div>

        {{-- You can remove this JS because modal is forced visible --}}
        {{-- @if ($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const errorModal = new bootstrap.Modal(document.getElementById('addSchoolYearModal'));
                    errorModal.show();
                });
            </script>
        @endif --}}

    </div>
</x-app-layout>
