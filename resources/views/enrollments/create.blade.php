<x-app-layout>
 <div class="card mt-5">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Add New Enrollment</h2>
        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary btn-sm">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    <!-- Modal: Add New Enrollment - shown on page load -->
    <div class="modal fade show d-block"
         id="addEnrollmentModal"
         tabindex="-1"
         aria-labelledby="addEnrollmentModalLabel"
         aria-modal="true"
         role="dialog"
         style="background-color: rgba(0,0,0,0.5);"
    >
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="addEnrollmentModalLabel">Add New Enrollment</h5>
                    <a href="{{ route('enrollments.index') }}" class="btn-close" aria-label="Close"></a>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('enrollments.store') }}" method="POST" id="addEnrollmentForm">
                        @csrf

                        {{-- Subject Dropdown --}}
                        <div class="mb-3">
                            <label for="subject_id" class="form-label"><strong>Subject:</strong></label>
                            <select name="subject_id" id="subject_id" class="form-select @error('subject_id') is-invalid @enderror">
                                <option value="">-- Select Subject --</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->subject_id }}" {{ old('subject_id') == $subject->subject_id ? 'selected' : '' }}>
                                        {{ $subject->subject_id }} - {{ $subject->descriptive_title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- School Year Dropdown --}}
                        <div class="mb-3">
                            <label for="schoolyear_id" class="form-label"><strong>School Year:</strong></label>
                            <select name="schoolyear_id" id="schoolyear_id" class="form-select @error('schoolyear_id') is-invalid @enderror">
                                <option value="">-- Select School Year --</option>
                                @foreach($schoolyears as $schoolyear)
                                    <option value="{{ $schoolyear->schoolyear_id }}" {{ old('schoolyear_id') == $schoolyear->schoolyear_id ? 'selected' : '' }}>
                                        {{ $schoolyear->schoolyear }} - {{ $schoolyear->semester }}
                                    </option>
                                @endforeach
                            </select>
                            @error('schoolyear_id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- User Dropdown --}}
                        <div class="mb-3">
                            <label for="user_id" class="form-label"><strong>User:</strong></label>
                            <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                <option value="">-- Select User --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <button type="submit" form="addEnrollmentForm" class="btn btn-success">
                        <i class="fa fa-floppy-disk"></i> Submit
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
</x-app-layout>
