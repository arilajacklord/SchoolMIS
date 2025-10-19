@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow border-0">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">📄 Grade Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="fw-bold">Student:</h5>
                    <p>{{ $grade->enrollment->user->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold">Subject:</h5>
                    <p>{{ $grade->enrollment->subject->descriptive_title ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold">School Year:</h5>
                    <p>{{ $grade->enrollment->schoolyear->schoolyear ?? '' }} ({{ $grade->enrollment->schoolyear->semester ?? '' }})</p>
                </div>
            </div>

            <hr>

            <h5 class="fw-bold">Grade Breakdown:</h5>
            <table class="table table-bordered w-50">
                <tr><th>Prelim</th><td>{{ $grade->prelim }}</td></tr>
                <tr><th>Midterm</th><td>{{ $grade->midterm }}</td></tr>
                <tr><th>Semifinal</th><td>{{ $grade->semifinal }}</td></tr>
                <tr><th>Final</th><td>{{ $grade->final }}</td></tr>
            </table>

            <div class="text-end">
                <a href="{{ route('grades.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
