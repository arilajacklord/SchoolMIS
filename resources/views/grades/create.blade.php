@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Grade</h2>
    <form method="POST" action="{{ route('grades.store') }}">
        @csrf

        <div class="mb-3">
            <label>Enrollment</label>
            <select name="enroll_id" class="form-control" required>
                @foreach($enrollments as $enroll)
                    <option value="{{ $enroll->enroll_id }}">
                        {{ $enroll->user->fname }} {{ $enroll->user->lname }} - {{ $enroll->subject->course_code }}
                    </option>
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

        <button type="submit" class="btn btn-primary">Save Grade</button>
    </form>
</div>
@endsection
