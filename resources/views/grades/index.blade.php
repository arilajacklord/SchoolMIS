@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Grade Management</h2>

    <a href="{{ route('grades.create') }}" class="btn btn-primary mb-3">Add Grade</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Enrollment</th>
                <th>Prelim</th>
                <th>Midterm</th>
                <th>Semifinal</th>
                <th>Final</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($grades as $grade)
            <tr>
                <td>{{ $grade->grade_id }}</td>
                <td>{{ $grade->enrollment?->id }}</td>
                <td>{{ $grade->prelim }}</td>
                <td>{{ $grade->midterm }}</td>
                <td>{{ $grade->semifinal }}</td>
                <td>{{ $grade->final }}</td>
                <td>
                    <a href="{{ route('grades.edit', $grade->grade_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('grades.destroy', $grade->grade_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this grade?')" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">No grades found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
