@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">🎓 Grade List</h4>
            <a href="{{ route('grades.create') }}" class="btn btn-light btn-sm fw-bold">
                <i class="bi bi-plus-circle"></i> Add Grade
            </a>
        </div>

        <div class="card-body">
            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Grades Table --}}
            <div class="table-responsive">
                <table class="table table-striped align-middle text-center">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Subject</th>
                            <th>School Year / Semester</th>
                            <th>Prelim</th>
                            <th>Midterm</th>
                            <th>Semifinal</th>
                            <th>Final</th>
                            <th>Average</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($grades as $index => $grade)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $grade->enrollment->registration->student_name ?? 'N/A' }}</td>
                                <td>{{ $grade->enrollment->subject->descriptive_title ?? 'N/A' }}</td>
                                <td>
                                    {{ $grade->enrollment->schoolyear->schoolyear ?? 'N/A' }}
                                    {{ $grade->enrollment->schoolyear->semester ? ' - ' . $grade->enrollment->schoolyear->semester : '' }}
                                </td>
                                <td>{{ $grade->prelim ?? '—' }}</td>
                                <td>{{ $grade->midterm ?? '—' }}</td>
                                <td>{{ $grade->semifinal ?? '—' }}</td>
                                <td>{{ $grade->final ?? '—' }}</td>
                                <td>
                                    @php
                                        $avg = collect([$grade->prelim, $grade->midterm, $grade->semifinal, $grade->final])
                                            ->filter()
                                            ->avg();
                                    @endphp
                                    {{ $avg ? number_format($avg, 2) : '—' }}
                                </td>
                                <td>
                                    <a href="{{ route('grades.edit', $grade->grade_id) }}" 
                                       class="btn btn-warning btn-sm text-white me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('grades.destroy', $grade->grade_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this grade?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-muted">No grades found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
