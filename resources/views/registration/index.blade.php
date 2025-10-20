<x-app-layout>
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Registration List</h2>
            <a href="{{ route('registration.create') }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i> New Registration
            </a>
        </div>

        <div class="card-body">
            {{-- Flash success message --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover text-center">
                <thead class="table-white">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Address</th>
                        <th>Citizenship</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $reg)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $reg->student_name }}</td>
                            <td>{{ ucfirst($reg->type ?? 'student') }}</td>
                            <td>
                                <span class="badge 
                                    @if($reg->student_status === 'active') bg-success 
                                    @elseif($reg->student_status === 'inactive') bg-danger 
                                    @else bg-warning @endif">
                                    {{ ucfirst($reg->student_status) }}
                                </span>
                            </td>
                            <td>{{ $reg->student_address }}</td>
                            <td>{{ $reg->student_citizenship }}</td>
                            <td>
                                <a href="{{ route('registration.show', $reg) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                <a href="{{ route('registration.edit', $reg) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('registration.destroy', $reg) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this registration?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No registrations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
