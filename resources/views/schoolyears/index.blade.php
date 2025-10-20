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

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>School Year ID</th>
                            <th>School Year</th>
                            <th>Semester</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schoolyears as $index => $schoolyear)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $schoolyear->schoolyear_id }}</td>
                                <td>{{ $schoolyear->schoolyear }}</td>
                                <td>{{ $schoolyear->semester }}</td>
                                <td>
                                    <a href="{{ route('schoolyears.edit', $schoolyear->schoolyear_id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form action="{{ route('schoolyears.destroy', $schoolyear->schoolyear_id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this school year?');">
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
                                <td colspan="5" class="text-center">No school years found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
