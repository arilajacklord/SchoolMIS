<x-app-layout>

    <div class="card mt-5">
        <h2 class="card-header">Add New School Year</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('schoolyears.index') }}">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>

            <form action="{{ route('schoolyears.store') }}" method="POST">
                @csrf

                {{-- Schoolyear ID --}}
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
                        <option value="2023-2024" {{ old('schoolyear') == '2023-2024' ? 'selected' : '' }}>2023-2024</option>
                        <option value="2024-2025" {{ old('schoolyear') == '2024-2025' ? 'selected' : '' }}>2024-2025</option>
                        <option value="2025-2026" {{ old('schoolyear') == '2025-2026' ? 'selected' : '' }}>2025-2026</option>
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
                        <option value="1st" {{ old('semester') == '1st' ? 'selected' : '' }}>1st Semester</option>
                        <option value="2nd" {{ old('semester') == '2nd' ? 'selected' : '' }}>2nd Semester</option>
                        <option value="Summer" {{ old('semester') == 'Summer' ? 'selected' : '' }}>Summer</option>
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

</x-app-layout>
