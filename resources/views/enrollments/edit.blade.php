<x-app-layout>
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Edit Enrollment</h2>
            <!-- Removed the button since modal will open automatically -->
        </div>

        <div class="card-body">
            {{-- You can place any content here if needed --}}
        </div>
    </div>

    <!-- Edit Enrollment Modal (always open on page load) -->
    <div class="modal fade show d-block" id="editEnrollmentModal" tabindex="-1" aria-labelledby="editEnrollmentModalLabel" aria-modal="true" role="dialog" style="background-color: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('enrollments.update', $enrollment->enroll_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="editEnrollmentModalLabel">Edit Enrollment</h5>
                        <a href="{{ route('enrollments.index') }}" class="btn-close" aria-label="Close"></a>
                    </div>

                    <div class="modal-body">
                        {{-- Subject --}}
                        <div class="mb-3">
                            <label for="subject_id" class="form-label"><strong>Subject:</strong></label>
                            <select name="subject_id" id="subject_id" class="form-select @error('subject_id') is-invalid @enderror">
                                <option value="">-- Select Subject --</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->subject_id }}" {{ $enrollment->subject_id == $subject->subject_id ? 'selected' : '' }}>
                                        {{ $subject->subject_id }} - {{ $subject->descriptive_title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- School Year --}}
                        <div class="mb-3">
                            <label for="schoolyear_id" class="form-label"><strong>School Year:</strong></label>
                            <select name="schoolyear_id" id="schoolyear_id" class="form-select @error('schoolyear_id') is-invalid @enderror">
                                <option value="">-- Select School Year --</option>
                                @foreach($schoolyears as $schoolyear)
                                    <option value="{{ $schoolyear->schoolyear_id }}" {{ $enrollment->schoolyear_id == $schoolyear->schoolyear_id ? 'selected' : '' }}>
                                        {{ $schoolyear->schoolyear }} - {{ $schoolyear->semester }}
                                    </option>
                                @endforeach
                            </select>
                            @error('schoolyear_id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- User --}}
                        <div class="mb-3">
                            <label for="user_id" class="form-label"><strong>User:</strong></label>
                            <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                <option value="">-- Select User --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $enrollment->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Update
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
