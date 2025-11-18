<x-app-layout>
    <div id="page-content">
        <div class="card mt-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>Scholarship List</h2>
                <!-- Open Create Modal -->
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createScholarshipModal">
                    <i class="fa fa-plus"></i> Add Scholarship
                </button>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-hover text-center">
                    <thead class="table-white">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($scholarships as $index => $scholarship)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $scholarship->name }}</td>
                                <td>{{ $scholarship->description ?? 'N/A' }}</td>
                                <td>₱{{ number_format($scholarship->amount, 2) }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewScholarship{{ $scholarship->scholar_id }}">
                                        <i class="fa fa-eye"></i> View
                                    </button>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editScholarship{{ $scholarship->scholar_id }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('scholarships.destroy', $scholarship->scholar_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this scholarship?')">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No scholarships found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- === CREATE SCHOLARSHIP MODAL === --}}
        <div class="modal fade" id="createScholarshipModal" tabindex="-1" aria-labelledby="createScholarshipLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-3 shadow-lg">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title"><i class="fa fa-graduation-cap"></i> Add New Scholarship</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('scholarships.store') }}" method="POST" id="createScholarForm">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label"><strong>Name:</strong></label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><strong>Description:</strong></label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><strong>Amount (₱):</strong></label>
                                <input type="number" step="0.01" min="0" name="amount" class="form-control" required>
                            </div>
                        </div>

                        <div class="modal-footer d-flex gap-2">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fa fa-save"></i> Submit
                            </button>
                            <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- === VIEW / EDIT MODALS === --}}
        @foreach($scholarships as $scholarship)
            {{-- View Modal --}}
            <div class="modal fade" id="viewScholarship{{ $scholarship->scholar_id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content rounded-3 shadow-lg">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title"><i class="fa fa-eye"></i> Scholarship Details</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3"><label><strong>ID:</strong></label><input class="form-control" value="{{ $scholarship->scholar_id }}" readonly></div>
                            <div class="mb-3"><label><strong>Name:</strong></label><input class="form-control" value="{{ $scholarship->name }}" readonly></div>
                            <div class="mb-3"><label><strong>Description:</strong></label><textarea class="form-control" rows="3" readonly>{{ $scholarship->description }}</textarea></div>
                            <div class="mb-3"><label><strong>Amount:</strong></label><input class="form-control" value="₱{{ number_format($scholarship->amount, 2) }}" readonly></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Edit Modal --}}
            <div class="modal fade" id="editScholarship{{ $scholarship->scholar_id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content rounded-3 shadow-lg">
                        <div class="modal-header bg-warning text-dark">
                            <h5 class="modal-title"><i class="fa fa-edit"></i> Edit Scholarship</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{ route('scholarships.update', $scholarship->scholar_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">

                            <input type="hidden" name="scholar_id" value="{{ old('scholar_id', $scholarship->scholar_id) }}" class="form-control" >

                                <div class="mb-3">
                                    <label><strong>Name:</strong></label>
                                    <input type="text" name="name" value="{{ old('name', $scholarship->name) }}" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label><strong>Description:</strong></label>
                                    <textarea name="description" class="form-control" rows="3">{{ old('description', $scholarship->description) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label><strong>Amount (₱):</strong></label>
                                    <input type="number" step="0.01" min="0" name="amount" value="{{ old('amount', $scholarship->amount) }}" class="form-control" >
                                </div>
                            </div>
                            <div class="modal-footer d-flex gap-2">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Update</button>
                                <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
