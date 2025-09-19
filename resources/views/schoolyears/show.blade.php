<x-app-layout>

    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>School Year Details</h2>
            <a href="{{ route('schoolyears.index') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <label class="form-label"><strong>School Year ID:</strong></label>
                <div class="form-control">{{ $schoolyear->schoolyear_id }}</div>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>School Year:</strong></label>
                <div class="form-control">{{ $schoolyear->schoolyear }}</div>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Semester:</strong></label>
                <div class="form-control">{{ $schoolyear->semester }}</div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('schoolyears.edit', $schoolyear->schoolyear_id) }}" class="btn btn-warning btn-sm me-2">
                    <i class="fa fa-edit"></i> Edit
                </a>

                <form action="{{ route('schoolyears.destroy', $schoolyear->schoolyear_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this school year?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
