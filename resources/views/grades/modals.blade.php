<!-- Add Grade Modal -->
<div class="modal fade" id="addGradeModal{{ $enrollment->enroll_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('grades.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $enrollment->student->User_ID }}">
                <input type="hidden" name="subject_id" value="{{ $enrollment->subject_id }}">
                <input type="hidden" name="schoolyear_id" value="{{ $enrollment->schoolyear_id }}">

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Add Grade - {{ $enrollment->student->Fname }} {{ $enrollment->student->Lname }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Prelim</label>
                            <input type="number" step="0.01" name="prelim" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Midterm</label>
                            <input type="number" step="0.01" name="midterm" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Semifinal</label>
                            <input type="number" step="0.01" name="semifinal" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Final</label>
                            <input type="number" step="0.01" name="final" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" type="submit">Save Grade</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Grade Modal -->
@if($enrollment->grade)
<div class="modal fade" id="editGradeModal{{ $enrollment->grade->grade_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('grades.update', $enrollment->grade->grade_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit Grade - {{ $enrollment->student->Fname }} {{ $enrollment->student->Lname }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Prelim</label>
                            <input type="number" step="0.01" name="prelim" class="form-control" value="{{ $enrollment->grade->prelim }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Midterm</label>
                            <input type="number" step="0.01" name="midterm" class="form-control" value="{{ $enrollment->grade->midterm }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Semifinal</label>
                            <input type="number" step="0.01" name="semifinal" class="form-control" value="{{ $enrollment->grade->semifinal }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Final</label>
                            <input type="number" step="0.01" name="final" class="form-control" value="{{ $enrollment->grade->final }}">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Update Grade</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<!-- Show Grade Modal -->
@if($enrollment->grade)
<div class="modal fade" id="showGradeModal{{ $enrollment->grade->grade_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Grade Details - {{ $enrollment->student->Fname }} {{ $enrollment->student->Lname }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Prelim:</strong> {{ $enrollment->grade->prelim ?? '-' }}</li>
                    <li class="list-group-item"><strong>Midterm:</strong> {{ $enrollment->grade->midterm ?? '-' }}</li>
                    <li class="list-group-item"><strong>Semifinal:</strong> {{ $enrollment->grade->semifinal ?? '-' }}</li>
                    <li class="list-group-item"><strong>Final:</strong> {{ $enrollment->grade->final ?? '-' }}</li>
                </ul>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif
