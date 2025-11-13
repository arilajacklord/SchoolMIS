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

            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-white">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $reg)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $reg->student_Fname }} {{ $reg->student_Mname }} {{ $reg->student_Lname }}</td>
                            <td>{{ ucfirst($reg->user->type ?? 'N/A') }}</td>
                            <td>{{ $reg->user->email ?? 'N/A' }}</td>       
                            <td>
                                <a href="{{ route('registration.show', $reg) }}" class="btn btn-info btn-sm me-1">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                <a href="{{ route('registration.edit', $reg) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('registrations.studentinfo_index', ['id' => $reg->id]) }}" class="btn btn-primary btn-sm"> <i class="fa fa-user"></i> Student Info
                                </a>
                                <form action="{{ route('registration.destroy', $reg) }}" method="POST" class="d-inline me-1" onsubmit="return confirm('Delete this registration?');">
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
                            <td colspan="5" class="text-center">No registrations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
