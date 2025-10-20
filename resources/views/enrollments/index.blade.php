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
                        
                        <th>Subject</th>
                        <th>School Year</th>
                        <th>User</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                 @foreach($enroll_list as $enrollment)
                        <tr>
                           
                            <td>{{ $enrollment->descriptive_title ?? 'N/A' }}</td>
                            <td>{{ $enrollment->schoolyear ?? 'N/A' }}</td>
                            <td>{{ $enrollment->name ?? 'N/A' }}</td>
                                   
                            <td>
                                
                                <a href="{{ route('enrollments.show', $enrollment->enroll_id) }}" class="btn btn-info btn-sm">
                                 <i class="lni lni-eye"></i>
                            </a>
                            <a href="{{ route('enrollments.edit', $enrollment->enroll_id) }}" class="btn btn-warning btn-sm">
                                <i class="lni lni-library"></i>
                            </a>
                            <form action="{{ route('enrollments.destroy', $enrollment->enroll_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this enrollment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="lni lni-trash-can"></i>
                                </button>
                            </form>

                            </td>
                        </tr>
                  
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
