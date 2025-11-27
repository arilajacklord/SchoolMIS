<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded-3">

                    <!-- Header -->
                    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #f1f1f1;">
                        <h4 class="card-title fw-bold text-dark">
                            <i class="bi bi-journal-text me-2 text-primary"></i> Borrow List
                        </h4>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addBorrowModal">
                            <i class="bi bi-plus-circle me-1"></i> Add Borrow
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Book Name</th>
                                        <th>User Name</th>
                                        <th>Date Borrowed</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($borrows as $borrow)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $borrow->book->title }}</td>
                                            <td>{{ $borrow->user->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($borrow->date_borrowed)->format('M d, Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($borrow->due_date)->format('M d, Y') }}</td>

                                            <td>
                                                @if(is_null($borrow->date_returned))
                                                    <span class="badge bg-warning text-dark">Borrowed</span>
                                                @else
                                                    <span class="badge bg-success">Returned</span>
                                                @endif
                                            </td>

                                            <td>
                                                <!-- RETURN BUTTON -->
                                                @if(is_null($borrow->date_returned))
                                                    <button 
                                                        class="btn btn-success btn-sm" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#confirmReturnModal{{ $borrow->borrow_id }}" 
                                                        title="Return Book">
                                                        <i class="bi bi-arrow-return-left"></i>
                                                    </button>
                                                @endif

                                                <!-- EDIT BUTTON -->
                                                <button 
                                                    class="btn btn-warning btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editBorrowModal{{ $borrow->borrow_id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>

                                                <!-- DELETE BUTTON -->
                                                <button 
                                                    class="btn btn-danger btn-sm" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#confirmDeleteModal{{ $borrow->borrow_id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">No borrowed books found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================= ADD BORROW MODAL ======================= -->
    <div class="modal fade" id="addBorrowModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="{{ route('borrow.store') }}" method="POST" class="modal-content border-0 shadow-lg rounded-3">
                @csrf
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-plus-circle me-2"></i> Add Borrow
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">User</label>
                            <select name="user_id" class="form-select" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Book</label>
                            <select name="book_id" class="form-select" required>
                                @foreach ($books as $book)
                                    <option value="{{ $book->book_id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Borrow Date</label>
                            <input type="date" name="date_borrowed" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Due Date</label>
                            <input type="date" name="due_date" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-end gap-2 px-4 py-3">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Borrow</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ======================= EDIT BORROW MODALS ======================= -->
    @foreach ($borrows as $borrow)
    <div class="modal fade" id="editBorrowModal{{ $borrow->borrow_id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="{{ route('borrow.update', $borrow->borrow_id) }}" method="POST" class="modal-content border-0 shadow-lg rounded-3">
                @csrf
                @method('PUT')
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-pencil-square me-2"></i> Edit Borrow
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">User</label>
                            <input type="text" class="form-control" value="{{ $borrow->user->name }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Book</label>
                            <input type="text" class="form-control" value="{{ $borrow->book->title }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Borrow Date</label>
                            <input type="date" name="date_borrowed" class="form-control" value="{{ $borrow->date_borrowed }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Due Date</label>
                            <input type="date" name="due_date" class="form-control" value="{{ $borrow->due_date }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-end gap-2 px-4 py-3">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Borrow</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ======================= DELETE CONFIRMATION MODALS ======================= -->
    <div class="modal fade" id="confirmDeleteModal{{ $borrow->borrow_id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-exclamation-triangle me-2"></i> Confirm Delete
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="fw-semibold mb-2">Do you really want to delete this borrow record?</p>
                    <p class="text-muted mb-0">
                        <strong>Book:</strong> {{ $borrow->book->title }} <br>
                        <strong>User:</strong> {{ $borrow->user->name }}
                    </p>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('borrow.destroy', $borrow->borrow_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================= RETURN CONFIRMATION MODALS ======================= -->
    <div class="modal fade" id="confirmReturnModal{{ $borrow->borrow_id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-question-circle me-2"></i> Confirm Return
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="fw-semibold mb-2">Are you sure you want to return this book?</p>
                    <p class="text-muted mb-0">
                        <strong>Book:</strong> {{ $borrow->book->title }} <br>
                        <strong>User:</strong> {{ $borrow->user->name }}
                    </p>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('borrow.return', $borrow->borrow_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">Return Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</x-app-layout>
