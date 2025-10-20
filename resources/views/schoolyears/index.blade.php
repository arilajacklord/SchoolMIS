<x-app-layout>
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>School Year List</h2>
            <a href="{{ route('schoolyears.create') }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i> Add School Year
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>School Year</th>
                        <th>Semester</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schoolyears as $schoolyear)
                        <tr>
                            <td>{{ $schoolyear->schoolyear ?? 'N/A' }}</td>
                            <td>{{ $schoolyear->semester ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('schoolyears.show', $schoolyear->schoolyear_id) }}" class="btn btn-info btn-sm" title="View">
                                    <i class="lni lni-eye"></i>
                                </a>
                                <a href="{{ route('schoolyears.edit', $schoolyear->schoolyear_id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="lni lni-pencil"></i>
                                </a>
                                <form action="{{ route('schoolyears.destroy', $schoolyear->schoolyear_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this school year?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="lni lni-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination if available --}}
            {{ $schoolyears->links() }}
        </div>
    </div>
</x-app-layout>
