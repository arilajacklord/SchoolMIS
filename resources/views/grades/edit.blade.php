@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Grade</h2>
    <form method="POST" action="{{ route('grades.update', $grade->grade_id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Prelim</label>
            <input type="number" step="0.01" name="prelim" class="form-control" value="{{ $grade->prelim }}">
        </div>

        <div class="mb-3">
            <label>Midterm</label>
            <input type="number" step="0.01" name="midterm" class="form-control" value="{{ $grade->midterm }}">
        </div>

        <div class="mb-3">
            <label>Semifinal</label>
            <input type="number" step="0.01" name="semifinal" class="form-control" value="{{ $grade->semifinal }}">
        </div>

        <div class="mb-3">
            <label>Final</label>
            <input type="number" step="0.01" name="final" class="form-control" value="{{ $grade->final }}">
        </div>

        <button type="submit" class="btn btn-success">Update Grade</button>
    </form>
</div>
@endsection
