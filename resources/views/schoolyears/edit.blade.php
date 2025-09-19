<x-app-layout>

    <div class="card mt-5">
        <h2 class="card-header">Edit School Year</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('schoolyears.index') }}">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>

            <form action="{{ route('schoolyears.update', $schoolyear->schoolyear_id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Schoolyear ID (Read-only) --}}
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
                        <option value="2023-2024" {{ $schoolyear->schoolyear == '2023-2024' ? 'selected' : '' }}>2023-2024</option>
                        <option value="2024-2025" {{ $schoolyear->schoolyear == '2024-2025' ? 'selected' : '' }}>2024-2025</option>
                        <option value="2025-2026" {{ $schoolyear->schoolyear == '2025-2026' ? 'selected' : '' }}>2025-2026</option>
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
                        <option value="1st" {{ $schoolyear->semester == '1st' ? 'selected' : '' }}>1st Semester</option>
                        <option value="2nd" {{ $schoolyear->semester == '2nd' ? 'selected' : '' }}>2nd Semester</option>
                        <option value="Summer" {{ $schoolyear->semester == 'Summer' ? 'selected' : '' }}>Summer</option>
                    </select>
                    @error('semester')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Update
                </button>
            </form>

        </div>
    </div>

</x-app-layout>
