@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Grade</h2>

    <form action="{{ route('grades.update', $grade->grade_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="enroll_id" class="form-label">Enrollment</label>
            <select name="enroll_id" class="form-control" required>
                @foreach($enrollments as $enroll)
                    <option value="{{ $enroll->id }}" {{ $grade->enroll_id == $enroll->id ? 'selected' : '' }}>
                        {{ $enroll->id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Prelim</label>
            <input type="number" step="0.01" name="prelim" value="{{ $grade->prelim }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Midterm</label>
            <input type="number" step="0.01" name="midterm" value="{{ $grade->midterm }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Semifinal</label>
            <input type="number" step="0.01" name="semifinal" value="{{ $grade->semifinal }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Final</label>
            <input type="number" step="0.01" name="final" value="{{ $grade->final }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
