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

            {{-- ✅ Live Search Input --}}
            <div class="mb-3 d-flex justify-content-end">
                <input type="text" id="searchInput" class="form-control w-25" placeholder="Search...">
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle text-center" id="registrationTable">
                    <thead class="table-success">
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
                                <td>{{ $loop->iteration + ($registrations->currentPage() - 1) * $registrations->perPage() }}</td>
                                <td>{{ $reg->student_Fname }} {{ $reg->student_Mname }} {{ $reg->student_Lname }}</td>
                                <td>{{ $reg->user->type ?? 'N/A' }}</td>
                                <td>{{ $reg->user->email ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('registration.show', $reg->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('registration.edit', $reg->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>

                                    {{-- Student Info Button --}}
                                    <a href="{{ $reg->isInfoIncomplete() ? route('studentinfo.index', $reg->id) : '#' }}" 
                                       class="btn btn-success btn-sm {{ $reg->isInfoIncomplete() ? '' : 'disabled' }}" 
                                       {{ $reg->isInfoIncomplete() ? '' : 'aria-disabled=true tabindex=-1' }}>
                                        <i class="fa fa-info-circle"></i> Student Info
                                    </a>

                                    <form action="{{ route('registration.destroy', $reg->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this registration?');">
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
                                <td colspan="5" class="text-center text-muted">No registrations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination Links aligned to bottom right --}}
                <div class="d-flex justify-content-end mt-3">
                    {{ $registrations->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- 🔹 Live Search Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('#registrationTable tbody tr');

            searchInput.addEventListener('keyup', function() {
                const filter = this.value.toLowerCase();

                tableRows.forEach(row => {
                    const name = row.cells[1].textContent.toLowerCase();
                    const type = row.cells[2].textContent.toLowerCase();
                    const email = row.cells[3].textContent.toLowerCase();

                    row.style.display = (name.includes(filter) || type.includes(filter) || email.includes(filter)) ? '' : 'none';
                });
            });
        });
    </script>
</x-app-layout>
        