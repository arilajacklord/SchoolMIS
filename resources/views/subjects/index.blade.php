<x-app-layout>

<div class="card mt-5">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Course List</h2>
        <a href="{{ route('subjects.create') }}" class="btn btn-success btn-sm">
            <i class="fa fa-plus"></i> Add Subject
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
                        <th>Subject ID</th>
                        <th>Subject Code</th>
                        <th>Title</th>
                        <th>Lecture Units</th>
                        <th>Lab Units</th>
                        <th>Total Units</th>
                        <th>Co-Requisite</th>
                        <th>Pre-Requisite</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subjects as $index => $subject)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $subject->subject_id }}</td>
                            <td>{{ $subject->course_code }}</td>
                            <td>{{ $subject->descriptive_title }}</td>
                            <td>{{ $subject->led_units }}</td>
                            <td>{{ $subject->lab_units }}</td>
                            <td>{{ $subject->total_units }}</td>
                            <td>{{ $subject->co_requisite }}</td>
                            <td>{{ $subject->pre_requisite }}</td>
                            <td>

                             {{-- View Button --}}
                                <a href="{{ route('subjects.show', $subject->subject_id) }}" class="btn btn-info btn-sm" title="View">
                                    <i class="fa fa-eye">View</i>
                                </a>

                                {{-- Edit Button --}}
                                <a href="{{ route('subjects.edit', $subject->subject_id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit">Edit</i> 
                                </a>

                                {{-- Delete Form --}}
                                <form action="{{ route('subjects.destroy', $subject->subject_id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this subject?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash">Delete</i> 
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No subjects found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</x-app-layout>
