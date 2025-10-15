@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Grade</h2>

    <form action="{{ route('grades.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="enroll_id" class="form-label">Enrollment</label>
            <select name="enroll_id" class="form-control" required>
                <option value="">-- Select Enrollment --</option>
                @foreach($enrollments as $enroll)
                    <option value="{{ $enroll->id }}">{{ $enroll->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Prelim</label>
            <input type="number" step="0.01" name="prelim" class="form-control">
        </div>

        <div class="mb-3">
            <label>Midterm</label>
            <input type="number" step="0.01" name="midterm" class="form-control">
        </div>

        <div class="mb-3">
            <label>Semifinal</label>
            <input type="number" step="0.01" name="semifinal" class="form-control">
        </div>

        <div class="mb-3">
            <label>Final</label>
            <input type="number" step="0.01" name="final" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
