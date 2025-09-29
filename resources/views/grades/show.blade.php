@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Grade Details</h2>

    <div class="card">
        <div class="card-body">
            <h5>Student: {{ $grade->enrollment->user->fname }} {{ $grade->enrollment->user->lname }}</h5>
            <p>Subject: {{ $grade->enrollment->subject->course_code }} - {{ $grade->enrollment->subject->descriptive_title }}</p>
            <p>School Year: {{ $grade->enrollment->schoolyear->schoolyear }} - {{ $grade->enrollment->schoolyear->semester }}</p>
            <hr>
            <p><strong>Prelim:</strong> {{ $grade->prelim }}</p>
            <p><strong>Midterm:</strong> {{ $grade->midterm }}</p>
            <p><strong>Semifinal:</strong> {{ $grade->semifinal }}</p>
            <p><strong>Final:</strong> {{ $grade->final }}</p>
        </div>
    </div>

    <a href="{{ route('grades.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
