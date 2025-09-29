@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Manage Student Grades</h2>

    <!-- Search & Subject Filter -->
    <form method="GET" action="{{ route('grades.index') }}" class="row mb-4">
        <div class="col-md-6">
            <select name="subject_id" class="form-control" required>
                <option value="">-- Select Subject --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->subject_id }}" {{ request('subject_id') == $subject->subject_id ? 'selected' : '' }}>
                        {{ $subject->course_code }} - {{ $subject->descriptive_title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search Student (Name/ID)" value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Go</button>
        </div>
    </form>

    <!-- Students Table -->
    <div class="card">
        <div class="card-body">
            @if($enrollments->count() > 0)
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Subject</th>
                            <th>School Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enrollments as $enroll)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $enroll->user->fname }} {{ $enroll->user->lname }}</td>
                                <td>{{ $enroll->subject->course_code }}</td>
                                <td>{{ $enroll->schoolyear->schoolyear }} - {{ $enroll->schoolyear->semester }}</td>
                                <td>
                                    <!-- Manage Grade Button -->
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#gradeModal{{ $enroll->enroll_id }}">
                                        Manage Grade
                                    </button>
                                </td>
                            </tr>

                            <!-- Grade Modal -->
                            <div class="modal fade" id="gradeModal{{ $enroll->enroll_id }}" tabindex="-1" aria-labelledby="gradeModalLabel{{ $enroll->enroll_id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('grades.store') }}">
                                        @csrf
                                        <input type="hidden" name="enroll_id" value="{{ $enroll->enroll_id }}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="gradeModalLabel{{ $enroll->enroll_id }}">
                                                    Manage Grade for {{ $enroll->user->fname }} {{ $enroll->user->lname }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label>Prelim</label>
                                                    <input type="number" step="0.01" name="prelim" class="form-control" value="{{ $enroll->grade->prelim ?? '' }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Midterm</label>
                                                    <input type="number" step="0.01" name="midterm" class="form-control" value="{{ $enroll->grade->midterm ?? '' }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Semifinal</label>
                                                    <input type="number" step="0.01" name="semifinal" class="form-control" value="{{ $enroll->grade->semifinal ?? '' }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Final</label>
                                                    <input type="number" step="0.01" name="final" class="form-control" value="{{ $enroll->grade->final ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- End Grade Modal -->
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">No students found for this subject.</p>
            @endif
        </div>
    </div>
</div>
@endsection
