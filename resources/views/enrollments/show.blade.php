<x-app-layout>
    <!-- Modal shown directly -->
    <div class="modal fade show d-block" id="enrollmentDetailsModal" tabindex="-1" aria-labelledby="enrollmentDetailsModalLabel" aria-modal="true" role="dialog" style="background-color: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enrollmentDetailsModalLabel">Enrollment Details</h5>
                    <a href="{{ route('enrollments.index') }}" class="btn-close" aria-label="Close"></a>
                </div>

                <div class="modal-body">
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

                <div class="modal-footer">
                    <a href="{{ route('enrollments.index') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
