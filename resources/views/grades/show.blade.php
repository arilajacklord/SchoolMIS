@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Grade Details</h4>
            <a href="{{ route('grades.index') }}" class="btn btn-light btn-sm">Back</a>
        </div>

        <div class="card-body">
            <p><b>Student:</b> {{ $grade->enrollment->registration->student_name ?? 'N/A' }}</p>
            <p><b>Subject:</b> {{ $grade->enrollment->subject->descriptive_title ?? 'N/A' }}</p>
            <p><b>School Year / Semester:</b> {{ $grade->enrollment->schoolyear->schoolyear ?? 'N/A' }} 
                {{ $grade->enrollment->schoolyear->semester ? ' - ' . $grade->enrollment->schoolyear->semester : '' }}
            </p>

            <hr>

            {{-- Edit Form --}}
            <form method="POST" action="{{ route('grades.update', $grade->grade_id) }}">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    @foreach (['prelim', 'midterm', 'semifinal', 'final'] as $term)
                        <div class="col-md-3 mb-3">
                            <label class="form-label"><b>{{ ucfirst($term) }}</b></label>
                            <input type="number" step="0.01" class="form-control" name="{{ $term }}" value="{{ $grade->$term }}">
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Update Grade</button>
            </form>

            {{-- Delete Form --}}
            <form method="POST" action="{{ route('grades.destroy', $grade->grade_id) }}" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Grade</button>
            </form>
        </div>
    </div>
</div>
@endsection
