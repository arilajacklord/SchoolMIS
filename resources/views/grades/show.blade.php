@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Grade Details</h2>

    <table class="table table-bordered">
        <tr><th>ID</th><td>{{ $grade->grade_id }}</td></tr>
        <tr>
            <th>Student & Subject</th>
            <td>
                {{ $grade->enrollment->student->Fname ?? '' }} {{ $grade->enrollment->student->Lname ?? '' }}
                - {{ $grade->enrollment->subject->Course_Code ?? $grade->enrollment->subject->Course_Title ?? '' }}
            </td>
        </tr>
        <tr><th>Prelim</th><td>{{ $grade->prelim }}</td></tr>
        <tr><th>Midterm</th><td>{{ $grade->midterm }}</td></tr>
        <tr><th>Semifinal</th><td>{{ $grade->semifinal }}</td></tr>
        <tr><th>Final</th><td>{{ $grade->final }}</td></tr>
    </table>

    <a href="{{ route('grades.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
