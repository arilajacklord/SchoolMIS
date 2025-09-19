<x-app-layout>
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Enrollment Details</h2>
            <a href="{{ route('enrollments.index') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>Subject:</strong>
                <p>{{ $enrollment->subject->descriptive_title ?? 'N/A' }}</p>
            </div>

            <div class="mb-3">
                <strong>School Year:</strong>
                <p>{{ $enrollment->schoolyear->schoolyear ?? 'N/A' }} - {{ $enrollment->schoolyear->semester ?? 'N/A' }}</p>
            </div>

            <div class="mb-3">
                <strong>User:</strong>
                <p>{{ $enrollment->user->name ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
