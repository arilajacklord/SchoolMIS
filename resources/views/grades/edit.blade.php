@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">✏️ Edit Grade</h4>
        </div>

        <div class="card-body">
            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>There were some problems with your input:</strong>
                    <ul class="mt-2 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Edit Grade Form --}}
            <form action="{{ route('grades.update', $grade->grade_id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Enrollment Dropdown --}}
                <div class="mb-3">
                    <label for="enroll_id" class="form-label fw-bold">Enrollment</label>
                    <select name="enroll_id" id="enroll_id" class="form-select" required>
                        <option value="">Select Enrollment</option>
                        @foreach($enrollments as $enroll)
                            <option value="{{ $enroll->enroll_id }}" 
                                {{ $grade->enroll_id == $enroll->enroll_id ? 'selected' : '' }}>
                                {{ $enroll->registration->student_name ?? 'Unnamed Student' }}
                                — {{ $enroll->subject->descriptive_title ?? 'No Subject' }}
                                ({{ $enroll->schoolyear->schoolyear ?? 'N/A' }}
                                {{ $enroll->schoolyear->semester ? ' - ' . $enroll->schoolyear->semester : '' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Grade Inputs --}}
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Prelim</label>
                        <input type="number" name="prelim" class="form-control"
                            step="0.01" min="0" max="100" placeholder="0-100"
                            value="{{ old('prelim', $grade->prelim) }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Midterm</label>
                        <input type="number" name="midterm" class="form-control"
                            step="0.01" min="0" max="100" placeholder="0-100"
                            value="{{ old('midterm', $grade->midterm) }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Semifinal</label>
                        <input type="number" name="semifinal" class="form-control"
                            step="0.01" min="0" max="100" placeholder="0-100"
                            value="{{ old('semifinal', $grade->semifinal) }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Final</label>
                        <input type="number" name="final" class="form-control"
                            step="0.01" min="0" max="100" placeholder="0-100"
                            value="{{ old('final', $grade->final) }}">
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-warning text-white px-4">
                        <i class="bi bi-pencil-square"></i> Update
                    </button>
                    <a href="{{ route('grades.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
