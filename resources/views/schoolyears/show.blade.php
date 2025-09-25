<x-app-layout>

    <!-- Modal Container -->
    <div class="modal fade show d-block"
         tabindex="-1"
         role="dialog"
         aria-modal="true"
         aria-labelledby="schoolYearDetailsModalLabel"
         style="background-color: rgba(0,0,0,0.5);"
    >
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="schoolYearDetailsModalLabel">School Year Details</h5>
                    <button type="button" class="btn-close" aria-label="Close"
                            onclick="window.location='{{ route('schoolyears.index') }}'"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
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
                </div>

               
                    <div class="modal-footer">
                    <a href="{{ route('schoolyears.index') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
