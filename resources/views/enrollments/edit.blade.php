<x-app-layout>
    <!-- Modal shown directly on page load -->
    <div class="modal fade show d-block" id="editEnrollmentModal" tabindex="-1" aria-labelledby="editEnrollmentModalLabel" aria-modal="true" role="dialog" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Edit Enrollment</h5>
                    <a href="{{ route('enrollments.index') }}" class="btn-close" aria-label="Close"></a>
                </div>

                <!-- Body with form -->
                <div class="modal-body">
                    <form action="{{ route('enrollments.update', $enrollment->enroll_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                {{-- User --}}
                <div class="mb-3">
                    <label for="id" class="form-label"><strong>User:</strong></label>
                    <select name="id" id="id" class="form-select @error('id') is-invalid @enderror">
                        <option value="">-- Select User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $enrollment->id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id')
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

                        <!-- Footer -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('enrollments.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fa fa-save"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Prevent background scroll -->
    <style>
        body {
            overflow: hidden;
        }
    </style>
</x-app-layout>
