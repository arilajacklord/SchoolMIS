<x-app-layout>
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Enrollment List</h2>
            <a href="{{ route('enrollments.create') }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i> Add Enrollment
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>School Year</th>
                        <th>User</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enrollments as $index => $enrollment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $enrollment->subject->descriptive_title ?? 'N/A' }}</td>
                            <td>{{ $enrollment->schoolyear->schoolyear ?? 'N/A' }} - {{ $enrollment->schoolyear->semester ?? '' }}</td>
                            <td>{{ $enrollment->user->name ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('enrollments.show', $enrollment->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this enrollment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No enrollments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
