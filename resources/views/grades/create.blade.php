@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">➕ Add Grade</h4>
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

            {{-- Add Grade Form --}}
            <form action="{{ route('grades.store') }}" method="POST">
                @csrf

                {{-- Enrollment Dropdown --}}
                <div class="mb-3">
                    <label for="enroll_id" class="form-label fw-bold">Enrollment</label>
                    <select name="enroll_id" id="enroll_id" class="form-select" required>
                        <option value="">Select Enrollment</option>
                        @foreach($enrollments as $enroll)
                            <option value="{{ $enroll->enroll_id }}">
                                {{-- ✅ Fixed "regestration" to "registration" --}}
                                {{ $enroll->registration->student_name ?? 'Unnamed Student' }} — 
                                {{ $enroll->subject->descriptive_title ?? 'No Subject' }} 
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
                        <input type="number" name="prelim" class="form-control" step="0.01" min="0" max="100"
                            placeholder="0-100" value="{{ old('prelim') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Midterm</label>
                        <input type="number" name="midterm" class="form-control" step="0.01" min="0" max="100"
                            placeholder="0-100" value="{{ old('midterm') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Semifinal</label>
                        <input type="number" name="semifinal" class="form-control" step="0.01" min="0" max="100"
                            placeholder="0-100" value="{{ old('semifinal') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Final</label>
                        <input type="number" name="final" class="form-control" step="0.01" min="0" max="100"
                            placeholder="0-100" value="{{ old('final') }}">
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save"></i> Save
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
