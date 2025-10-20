<x-app-layout>
    <!-- Directly visible modal -->
    <div class="modal fade show d-block" id="showEnrollmentModal" tabindex="-1" aria-labelledby="showEnrollmentModalLabel" aria-modal="true" role="dialog" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="showEnrollmentModalLabel">Enrollment Details</h5>
                    <a href="{{ route('enrollments.index') }}" class="btn-close" aria-label="Close"></a>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>Subject:</strong>
                        <p class="mb-0">{{ $enrollment->subject->descriptive_title ?? 'N/A' }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>School Year:</strong>
                        <p class="mb-0">
                            {{ $enrollment->schoolyear->schoolyear ?? 'N/A' }} - 
                            {{ $enrollment->schoolyear->semester ?? 'N/A' }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <strong>User:</strong>
                        <p class="mb-0">{{ $enrollment->user->name ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: prevent background scroll -->
    <style>
        body {
            overflow: hidden;
        }
    </style>
</x-app-layout>
