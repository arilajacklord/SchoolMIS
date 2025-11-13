<x-app-layout>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <div class="page-inner mt--5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-lg rounded-4">
          <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #f3f4f6;">
            <h4 class="card-title fw-bold text-secondary">
              <i class="bi bi-journal-text me-2 text-primary"></i> Borrow List
            </h4>
            <button class="btn text-white rounded-3" style="background-color: #a2cffe;" data-bs-toggle="modal" data-bs-target="#addBorrowModal">
              <i class="bi bi-plus-circle me-1"></i> Add Borrow
            </button>
          </div>

          <div class="card-body">
            @if (session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
              <table class="table table-hover align-middle">
                <thead style="background-color: #eaf4fc;">
                  <tr class="text-secondary">
                    <th>#</th>
                    <th>User</th>
                    <th>Book</th>
                    <th>Date Borrowed</th>
                    <th>Date Returned</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($borrows as $index => $borrow)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $borrow->user->name ?? 'Unknown User' }}</td>
                      <td>{{ $borrow->book->title ?? 'Unknown Book' }}</td>
                      <td>{{ \Carbon\Carbon::parse($borrow->date_borrowed)->format('M d, Y') }}</td>
                      <td>
                        @if ($borrow->date_returned)
                          {{ \Carbon\Carbon::parse($borrow->date_returned)->format('M d, Y') }}
                        @else
                          <span class="text-muted">Not returned</span>
                        @endif
                      </td>
                      <td>
                        @if ($borrow->date_returned)
                          <span class="badge bg-primary">Returned</span>
                        @else
                          <span class="badge bg-success">Borrowed</span>
                        @endif
                      </td>
                      <td>
                        <!-- View -->
                        <button class="btn btn-sm rounded-3 text-white" style="background-color: #cdb4db;"
                          data-bs-toggle="modal" data-bs-target="#viewBorrowModal{{ $borrow->borrow_id }}">
                          <i class="bi bi-eye me-1"></i> View
                        </button>

                        <!-- Edit -->
                        <button class="btn btn-sm rounded-3 text-white" style="background-color: #ffb5a7;"
                          data-bs-toggle="modal" data-bs-target="#editBorrowModal{{ $borrow->borrow_id }}">
                          <i class="bi bi-pencil-square me-1"></i> Edit
                        </button>

                        <!-- Delete -->
                        <form action="{{ route('borrow.destroy', $borrow->borrow_id) }}" method="POST" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm rounded-3 text-white" style="background-color: #ffadad;"
                            onclick="return confirm('Are you sure?')">
                            <i class="bi bi-trash me-1"></i> Delete
                          </button>
                        </form>

                        <!-- Return -->
                        @if (!$borrow->date_returned)
                          <form action="{{ route('borrow.return', $borrow->borrow_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm rounded-3 text-dark" style="background-color: #caffbf;">
                              <i class="bi bi-arrow-return-left me-1"></i> Return
                            </button>
                          </form>
                        @endif
                      </td>
                    </tr>

                    <!-- 🌸 View Modal -->
                    <div class="modal fade" id="viewBorrowModal{{ $borrow->borrow_id }}" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-4">
                          <div class="modal-header" style="background-color: #cdb4db; color: #4b0082;">
                            <h5 class="modal-title fw-bold">
                              <i class="bi bi-eye-fill me-2"></i> Borrow Details
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body py-4 px-4">
                            <div class="card border-0 shadow-sm rounded-4" style="background-color: #f8f6ff;">
                              <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                  <i class="bi bi-person-circle text-primary fs-4 me-2"></i>
                                  <div>
                                    <h6 class="mb-0 text-secondary">User</h6>
                                    <p class="fw-semibold">{{ $borrow->user->name ?? 'Unknown' }}</p>
                                  </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                  <i class="bi bi-book text-info fs-4 me-2"></i>
                                  <div>
                                    <h6 class="mb-0 text-secondary">Book</h6>
                                    <p class="fw-semibold">{{ $borrow->book->title ?? 'Unknown' }}</p>
                                  </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                  <i class="bi bi-calendar-date text-success fs-4 me-2"></i>
                                  <div>
                                    <h6 class="mb-0 text-secondary">Date Borrowed</h6>
                                    <p class="fw-semibold">{{ $borrow->date_borrowed }}</p>
                                  </div>
                                </div>
                                <div class="d-flex align-items-center">
                                  <i class="bi bi-calendar-check text-secondary fs-4 me-2"></i>
                                  <div>
                                    <h6 class="mb-0 text-secondary">Date Returned</h6>
                                    <p class="fw-semibold">{{ $borrow->date_returned ?? 'Not returned' }}</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- 🍑 Edit Modal -->
<div class="modal fade" id="editBorrowModal{{ $borrow->borrow_id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form action="{{ route('borrow.update', $borrow->borrow_id) }}" method="POST" class="modal-content border-0 shadow-lg rounded-4">
      @csrf
      @method('PUT')
      <div class="modal-header" style="background-color: #ffd6d6; color: #a10000;">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-pencil-fill me-2"></i> Edit Borrow
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body px-4 py-4" style="background-color: #fff5f5;">
        <div class="mb-3">
          <label class="form-label fw-semibold text-secondary">
            <i class="bi bi-person-fill me-1 text-primary"></i> User
          </label>
          <select name="user_id" class="form-select rounded-3 border-primary-subtle" required>
            @foreach ($users as $user)
              <option value="{{ $user->id }}" {{ $borrow->user_id == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold text-secondary">
            <i class="bi bi-book-fill me-1 text-info"></i> Book
          </label>
          <select name="book_id" class="form-select rounded-3 border-info-subtle" required>
            @foreach ($books as $book)
              <option value="{{ $book->book_id }}" {{ $borrow->book_id == $book->book_id ? 'selected' : '' }}>
                {{ $book->title }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold text-secondary">
            <i class="bi bi-calendar-date me-1 text-success"></i> Date Borrowed
          </label>
          <input type="date" name="date_borrowed" class="form-control rounded-3 border-success-subtle" value="{{ $borrow->date_borrowed }}" required>
        </div>
      </div>
      <div class="modal-footer border-0" style="background-color: #fff5f5;">
        <button type="button" class="btn btn-light border rounded-3 px-4" data-bs-dismiss="modal">
          <i class="bi bi-x-circle me-1"></i> Cancel
        </button>
        <button type="submit" class="btn text-white rounded-3 px-4" style="background-color: #ff7f7f;">
          <i class="bi bi-save2 me-1"></i> Update
        </button>
      </div>
    </form>
  </div>
</div>
                  @empty
                    <tr>
                      <td colspan="7" class="text-center text-muted">No borrows found.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
  <!-- 🌼 Add Modal (same as before but soft color palette) -->
  <div class="modal fade" id="addBorrowModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <form action="{{ route('borrow.store') }}" method="POST" class="modal-content border-0 shadow rounded-4">
        @csrf
        <div class="modal-header" style="background-color: #a2cffe; color: #003366;">
          <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle me-2"></i> Add Borrow</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body px-4 py-3">
          <div class="mb-3">
            <label class="form-label fw-semibold text-secondary"><i class="bi bi-person-fill me-1 text-primary"></i> User</label>
            <select name="user_id" class="form-select rounded-3 border-primary-subtle" required>
              <option value="">Select User</option>
              @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold text-secondary"><i class="bi bi-book-fill me-1 text-info"></i> Book</label>
            <select name="book_id" class="form-select rounded-3 border-info-subtle" required>
              <option value="">Select Book</option>
              @foreach ($books as $book)
                <option value="{{ $book->book_id }}">{{ $book->title }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold text-secondary"><i class="bi bi-calendar-date me-1 text-success"></i> Date Borrowed</label>
            <input type="date" name="date_borrowed" class="form-control rounded-3 border-success-subtle" required>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-light border rounded-3 px-4" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-1"></i> Cancel
          </button>
          <button type="submit" class="btn text-white rounded-3 px-4" style="background-color: #a2cffe;">
            <i class="bi bi-save2 me-1"></i> Save
          </button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
