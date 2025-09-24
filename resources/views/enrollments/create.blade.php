<x-app-layout>
    <div class="card mt-5">
        <h2 class="card-header">Add New Enrollment</h2>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                <a class="btn btn-primary btn-sm" href="{{ route('enrollments.index') }}">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>

            <form action="{{ route('enrollments.store') }}" method="POST">
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
                            <option value="{{ $user->id }}" {{ old('id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-floppy-disk"></i> Submit
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
